<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Mail;
use App\User;
use Response;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendVerificationCode;
use App\Http\Services\RegisterService;


class RegisterController extends Controller
{
    public function index()
    {
    	return view('auth.register');
    }
    public function register(Request $request)
    {

		$validator = Validator::make($request->all(), [
            'name' => 'required',
	        'phone' => 'required',
	        'email' => 'required | email | unique:users,email',
	        'password' => 'required| min:4| max:20 |confirmed',
	        'password_confirmation' => 'required| min:4'
        ]);

		if ($validator->fails()) {
			return Response::json(array(
        		'success' => false,
        		'errors' => $validator->getMessageBag()->toArray()
    		), 400);
	    }

        $registerService = new RegisterService();
        $url = $registerService->register($request);
	    return $url;
    }

    public function verificationEmail(Request $request, $email = null)
    {
    	$data['msg'] = 'Verification code has been sent to your email. please check your email and verifiy your email. if you not get any email please click resend button. verification code will expire after 1 hour.';
    	$data['email'] = $email;
    	return view('vendor.email-verification',$data);
    }
    public function reSendCode(Request $request)
    {
    	$email = $request->email;
    	$email = \Illuminate\Support\Facades\Crypt::decrypt($email);
    	$find  = User::where('email',$email)->first();
    	if($find){
    		$code = Str::random(10);
    		Mail::send( new SendVerificationCode($find, $code));
    		$user = User::find($find->id);
    		$user->verification_code = $code;
    		$user->verification_code_send_at = date('Y-m-d H:i:s');
    		$user->save();
    		return response()->json(['success'=>'Verification code has been sent!']);
    	}else{
    		return response()->json(['error'=>'Worng email address']);
    	}
    }
    public function verifiedEmail(Request $request)
    {
    	$email = $request->email;
    	$email = \Illuminate\Support\Facades\Crypt::decrypt($email);
    	$code = $request->v_code;
    	$find  = User::where('email',$email)->where('verification_code', $code)->first();
    	if($find){
    		$time = $find->verification_code_send_at;
    		$new_time= date('Y-m-d H:i:s', strtotime($time.'+ 1 hour'));
    		$c_time = date('Y-m-d H:i:s');
    		if(strtotime($new_time) >= strtotime($c_time)){
    			$user = User::find($find->id);
    			$user->email_verified_at = date('Y-m-d H:i:s');
    			$user->save();
    			Auth::loginUsingId($find->id);
                $url = route('vendors.all');
	            return \response()->json(['url' => $url]);
    		}else{
    			return response()->json(['error'=>'Verification code expired']);
    		}
    	}else{
    		return response()->json(['error'=>'Worng verification code']);
    	}
    }
}
