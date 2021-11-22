<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper;
use App\Banner;
use Validator;
use Redirect;
class BannerController extends Controller
{
    public function index()
    {
    	$data['banner_top'] = Banner::where('position','top')->orderBy('id','desc')->get();
    	$data['banner_bottom'] = Banner::where('position','bottom')->orderBy('id','desc')->get();
    	return view('superadmin.banner.index',$data);
    }
    public function save(Request $request)
    {
    	$rules = array(
			'file' => 'required',
			'file.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
		);

		$error = Validator::make($request->all(), $rules);

		if ($error->fails()) {
			 return Redirect::back()->with('error','The file must be a file of type: jpeg, png, jpg, gif, svg.')->withInput($request->input());;
		}
		$images = $request->file('file');
		foreach ($images as  $image_d) {
			$image = false;
	        $image_data = file_get_contents($image_d);
	        try {
	            $image = imagecreatefromstring($image_data);
	        } catch (Exception $ex) {
	            $image = false;
	        }
	        if ($image !== false){
	        }

			$width = imagesx($image);
   			$height = imagesy($image);
            $image_name = time().rand().'-banner.webp';
            $large = public_path('images/banner/'.$image_name);
	       	Helper::resizeAndConpress($image_d, $width, $height,1,$large);
	        $banner = new Banner;
			$banner->link = $request->link;
			$banner->position = $request->position;
			$banner->image = $image_name;
			$banner->save();
		}
		return redirect()->back()->with('success','Saved');
    }

    public function editBanner(Request $request)
    {
    	$banner = Banner::where('id',$request->id)->first();
    	return view('superadmin.banner.edit-banner',compact('banner'))->render();
    }

    public function updateBanner(Request $request)
    {
    	$rules = array(
			'file' => 'image|mimes:jpeg,png,jpg,gif,svg'
		);

		$error = Validator::make($request->all(), $rules);

		if ($error->fails()) {
			return response()->json(['error'=>'The file must be a file of type: jpeg, png, jpg, gif, svg.']);
		}

		$item = Banner::find($request->id);
		if($request->hasFile('file')){
			$remove_path = public_path('images/banner/'.$item->image);
			unlink($remove_path);
			$image_d = $request->file;
			$image = false;
	        $image_data = file_get_contents($image_d);
	        try {
	            $image = imagecreatefromstring($image_data);
	        } catch (Exception $ex) {
	            $image = false;
	        }
	        if ($image !== false){
	        }

			$width = imagesx($image);
   			$height = imagesy($image);
            $image_name = time().rand().'-banner.webp';
            $large = public_path('images/banner/'.$image_name);
	       	Helper::resizeAndConpress($image_d, $width, $height,1,$large);
	       	$item->image = $image_name;

		}
		$item->link = $request->link;
		$item->position = $request->position;
		$item->save();

		$banner_top = Banner::where('position','top')->orderBy('id','desc')->get();
    	$banner_bottom = Banner::where('position','bottom')->orderBy('id','desc')->get();
    	$top = view('superadmin.banner.top-banner',compact('banner_top'))->render();
    	$bottom = view('superadmin.banner.bottom-banner',compact('banner_bottom'))->render();

		return response()->json(['success'=>'Updated','top'=>$top, 'bottom'=>$bottom]);
    }
    public function deleteBanner(Request $request)
    {
    	$banner = Banner::where('id',$request->id)->first();
    	$remove_path = public_path('images/banner/'.$banner->image);
		unlink($remove_path);
		Banner::where('id',$request->id)->delete();
		$banner_top = Banner::where('position','top')->orderBy('id','desc')->get();
    	$banner_bottom = Banner::where('position','bottom')->orderBy('id','desc')->get();
    	$top = view('superadmin.banner.top-banner',compact('banner_top'))->render();
    	$bottom = view('superadmin.banner.bottom-banner',compact('banner_bottom'))->render();
    	return response()->json(['success'=>'Deleted','top'=>$top, 'bottom'=>$bottom]);
    }
}
