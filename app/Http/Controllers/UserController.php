<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use App\User;
use App\Resource;
use App\Entertainment;
use Illuminate\Http\Request;
use Validator;
use Response;
use Helper;
use Redirect;
use Hash;

class UserController extends Controller
{
    public function index(User $user)
    {
        $id = Auth::user()->id;
    	$data['resources'] = Resource::where('user_id',$id)->orderBy('id','desc')->get();
        $data['entertainments'] = Entertainment::where('user_id',$id)->orderBy('id','desc')->get();
        $data['total_rec'] = Resource::where('user_id',auth()->user()->id)->count();
        $data['total_ent'] = Entertainment::where('user_id',auth()->user()->id)->count();
        //return $data['total_ent'];
    	//dd($data['resources']->toArray());
        return view('profile', compact('data'));
    }

    public function superAdminLogout()
    {
    	$id = Session::get('superadmin');
    	Auth::loginUsingId($id);
    	Session::forget('superadmin');
        return redirect(route('superadmin'));
    }

    public function resourceStatus(Request $request)
    {
        if($request->indentifier == 1){
            $rc = Resource::find($request->resource);
            $rc->is_active = $request->status;
            $rc->save();
            $data['resources'] = Resource::where('user_id', auth()->user()->id)->get();
            return view('vendor.inc.profile.listing-table', compact('data'))->render();
        }else{
            $rc = Entertainment::find($request->resource);
            $rc->is_active = $request->status;
            $rc->save();
            $data['entertainments'] = Entertainment::where('user_id', auth()->user()->id)->get();
            return view('vendor.inc.profile.payment-table', compact('data'))->render();
            
        }
        
    }
    public function setting()
    {
        $data['user'] = User::where('id',auth()->user()->id)->first();
        return view('vendor.setting',$data);
    }
    public function updateUser(Request $request, $id){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required | email | unique:users,email,'.$id
        ]);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->surname = $request->last_name; 
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->adderss;
        $user->code = $request->code;
        $user->pvm_code = $request->pvm_code;
        $user->save();
        $username = $request->name;
        if($request->last_name){
             $username .=' '.$request->last_name;
        }
        return response()->json(['username'=>$username,'success'=>'updated!']);
    }

    public function uploadProfileImage(Request $request){
        $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg']);
        if($request->hasFile('file')){
            $main_img = $request->file('file');
            $image = false;
            $image_data = file_get_contents($main_img);
            try {
                $image = imagecreatefromstring($image_data);
            } catch (Exception $ex) {
                $image = false;
            }
            if ($image !== false){
            }
            $multiplyer = 1000;
            $width = imagesx($image) / $multiplyer;
            $height = imagesy($image) / $width;
            $width = $multiplyer;
            $image_name = time().'-profile.webp';
            $ex_small = public_path('images/profile/'.$image_name);
            Helper::resizeAndConpress($main_img, $width, $height,3,$ex_small);
            $user = User::where('id',auth()->user()->id)->first();
            if($user->image){
                $link = public_path('images/profile/'.$user->image);
                unlink($link);
            }
            $usr = User::find(auth()->user()->id);
            $usr->image = $image_name;
            $usr->save();
            return redirect()->back();

        }
    }
    public function changePassword()
    {
        return view('vendor.change-password');
    }
    public function passwordChanged(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'password' => 'required| min:4| max:8 |confirmed',
            'password_confirmation' => 'required| min:4'
        ]);
        if ($validator->fails()) {
           return Redirect::back()->withErrors($validator);
        }
        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success','Passowrd has been changed!');
    }
}
