<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper;
use Validator;
//ResourceVideo
class UploadController extends Controller
{
    public function index(Request $request, $rec_or_ent = null, $id = null)
    {

    	$data['vip1'] = Helper::getVip1(3);
    	$data['rec_ent'] = $rec_or_ent;
    	$data['id'] = $id;
    	$model = 'App\Resource';
    	if($rec_or_ent == 'ent'){
    		$model = 'App\Entertainment';
    	}
    	$model::findOrFail($id);
    	$data['resource'] = $model::where('id',$id)->with('videos','recourceImage')->first();
    	//dd($data['resource']->toArray());
    	return view('vendor.video-image-upload.index',$data);
    }

    public function uploadMainVideo(Request $request, $rec_ent, $id)
    {

    	if($request->hasFile('video')){
    		$rules = array(
	    		'video'  => 'required|mimes:mp4,mov,ogg,qt'
			);
    	}
    	if($request->youtube_video){
    		$rules = array(
	    		'youtube_video'  => 'required'
			);
    	}

    	if($request->hasFile('image')){
    		$img_rules = array(
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
			);
			$error = Validator::make($request->all(), $img_rules);
			if ($error->fails()) {
				return response()->json(['error' => 'The Thumb Image must be a file of type: jpeg, png, jpg, gif,svg.']);
			}
    	} 

    	if(!isset($rules)){
    		return response()->json(['error'=>'Pleas chosse video or Youtube video link']);
    	}else{
    		$error = Validator::make($request->all(), $rules);
    	}
		if ($error->fails()) {
			return response()->json(['error' => 'The main video must be a file of type: mp4, mov, ogg, qt.']);
		}
		$model = '\App\Resource';
		if($rec_ent == 'ent'){
			$model = '\App\Entertainment';
		}

		$item = $model::find($id);
		if($request->hasFile('video')){
			$main_video = $request->file('video');
			$video_name = time().'-video.'.$main_video->getClientOriginalExtension();
			$destinationPath = public_path('videos');
			$main_video->move($destinationPath, $video_name);
			$item->video = $video_name;
			$item->video_status = 1;
		}
		if($request->youtube_video){
	        $video = $request->youtube_video;
	        $exp = explode('/', $video);
	        $url = $exp[0].'//'.$exp[2].'/embed/';
	        $exp1 = explode('=',$video);
	        $url .= end($exp1);
			$item->video = $url;
			$item->video_status = 2;
		}

		if($request->hasFile('image')){
			$image_d = $request->file('image');
			$image = false;
	        $image_data = file_get_contents($image_d);
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

            $image_name = time().rand().'-thumb.webp';
            $ex_medium = public_path('videos/'.$image_name);
	       	Helper::resizeAndConpress($image_d, $width, $height,2,$ex_medium);
	       	$item->video_thumb = $image_name;

		}
		$item->save();
		$resource = $model::where('id',$id)->first();
		$video = view('vendor.video-image-upload.main-video',compact('resource','rec_ent'))->render();
		return response()->json(['success'=>'Video successfully uploaded','video'=>$video]);
    }

    public function uploadAditionalVideo(Request $request, $rec_ent, $id)
    {
    	
    	if($request->hasFile('video')){
    		$rules = array(
	    		'video'  => 'required|mimes:mp4,mov,ogg,qt'
			);
    	}
    	if($request->youtube_video){
    		$rules = array(
	    		'youtube_video'  => 'required'
			);
    	}
    	if($request->hasFile('image')){
    		$img_rules = array(
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
			);
			$error = Validator::make($request->all(), $img_rules);
			if ($error->fails()) {
				return response()->json(['error' => 'The Thumb Image must be a file of type: jpeg, png, jpg, gif,svg.']);
			}
    	} 

    	if(!isset($rules)){
    		return response()->json(['error'=>'Pleas chosse video or youtube video link']);
    	}else{
    		$error = Validator::make($request->all(), $rules);
    	}
		if ($error->fails()) {
			return response()->json(['error' => 'The main video must be a file of type: mp4, mov, ogg, qt.']);
		}
		$model = '\App\ResourceVideo';
		$model1 = '\App\Resource';
		$column = 'resource_id';
		if($rec_ent == 'ent'){
			$model = '\App\EntVideo';
			$model1 = '\App\Entertainment';
			$column = 'entertainment_id';
		}
		$total = $model::where($column,$id)->count();
		if($total >= 4){
    		return response()->json(['error' => 'You can upload maximum 4 videos']);
    	}
		$item = new $model;
		$item->$column = $id;
		if($request->hasFile('video')){
			$main_video = $request->file('video');
			$video_name = time().'-video.'.$main_video->getClientOriginalExtension();
			$destinationPath = public_path('videos');
			$main_video->move($destinationPath, $video_name);
			$item->video = $video_name;
			$item->video_status = 1;
		}
		if($request->youtube_video){
			$video = $request->youtube_video;
	        $exp = explode('/', $video);
	        $url = $exp[0].'//'.$exp[2].'/embed/';
	        $exp1 = explode('=',$video);
	        $url .= end($exp1);
			$item->video = $url;
			$item->video_status = 2;
		}

		if($request->hasFile('image')){
			$image_d = $request->file('image');
			$image = false;
	        $image_data = file_get_contents($image_d);
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

            $image_name = time().rand().'-thumb.webp';
            $ex_medium = public_path('videos/'.$image_name);
	       	Helper::resizeAndConpress($image_d, $width, $height,2,$ex_medium);
	       	$item->video_thumb = $image_name;

		}

		$item->save();
		$resource = $model1::where('id',$id)->with('videos')->first();
		$video = view('vendor.video-image-upload.multi-video',compact('resource','rec_ent'))->render();
		return response()->json(['success'=>'Video successfully uploaded','video'=>$video]);
    }
    public function deleteVideo(Request $request)
    {
    	$rc_id  = $request->rc_id;
    	$video_id = $request->video_id;
    	$type = $request->type;
    	$model = '\App\ResourceVideo';
    	$model1 = '\App\Resource';
    	if($type == 'ent'){
    		$model = '\App\EntVideo';
    		$model1 = '\App\Entertainment';
    	}
    	$item = $model::find($video_id);
    	if($item->video_status == 1){
	    	$video_path = public_path('videos/'.$item->video);
	    	unlink($video_path);
    	}
    	$img_path = public_path('videos/'.$item->video_thumb);
    	unlink($img_path);
    	$item->delete();
    	$resource = $model1::where('id',$rc_id)->with('videos')->first();
    	$rec_ent = $type;
		$video = view('vendor.video-image-upload.multi-video',compact('resource','rec_ent'))->render();
		return response()->json(['success'=>'Video successfully deleted','video'=>$video]);
    }
}
