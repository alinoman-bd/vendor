<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper;
use App\EntCategory;
use App\Entertainment;
use Session;
use App\Search;
use App\Searchable;
use Validator;
use App\EntertainmentImage;
use App\Location;

class EntertainmentController extends Controller
{
    public function entertainmentForm()
    {
    	$data['vip1'] = Helper::getVip1(3);
    	$data['ent_categories'] = EntCategory::with('ent_types')->get();
    	return view('vendor.entertainment-form',$data);
    }
    public function saveEentertainmentForm(Request $request)
    {
    	$ent = new Entertainment;
    	$ent->user_id = auth()->user()->id;
    	$ent->city_id = $request->app_city;
    	$ent->location_id =  $request->app_location;
    	$ent->name = $request->name;
    	$ent->short_title = $request->short_title;
    	$ent->min_price = $request->min_price;
    	$ent->description = $request->description;
    	$ent->address = $request->address;
    	$ent->email = $request->email;
    	$ent->phone = $request->phone;
    	$ent->season_id  = $request->app_seasion;
        $ent->package_id  = 3;
    	if (Session::has('main_image')) {
			$main_img = Session::get('main_image');
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

            $image_name = time().'-resource.webp';
            $large = public_path('images/resource/large/'.$image_name);
            $medium = public_path('images/resource/medium/'.$image_name);
            $ex_medium = public_path('images/resource/ex-medium/'.$image_name);
            $small = public_path('images/resource/small/'.$image_name);
            $ex_small = public_path('images/resource/ex-small/'.$image_name);
            Helper::resizeAndConpress($main_img, $width, $height,1,$large);
            Helper::resizeAndConpress($main_img, $width, $height,1.5,$medium);
            Helper::resizeAndConpress($main_img, $width, $height,2,$ex_medium);
            Helper::resizeAndConpress($main_img, $width, $height,3,$small);
            Helper::resizeAndConpress($main_img, $width, $height,3.5,$ex_small);
            $ent->image = $image_name;
		}
		$ent->save();
		$ent->EntTypes()->attach($request->types);

        $search = new Search;
        $search->title = $request->name;
        $search->short_title = $request->short_title;
        $search->save();

        // $search->resource->save([
        //  'search_id' => $search->id,
        //  'searchable_id' => $resource->id;   
        // ]); 
        $searchable = new Searchable;
        $searchable->search_id = $search->id;
        $searchable->searchable_id = $ent->id;
        $searchable->searchable_type = get_class($ent);
        $searchable->save();

        return redirect(route('rec_ent.upload',['rec_or_ent'=>'ent','id'=>$ent->id]));
        
        // $url = route('payment.index',['rec_or_ent'=>'ent','id'=>$ent->id]);
        // $url .='?done=done'; 
        // return redirect($url);
		//return redirect()->back()->with('success', 'Entertainment successfully saved!');


    }

    public function edit($id) 
    {
        $data['vip1'] = Helper::getVip1(3);
        $data['ent_categories'] = EntCategory::with('ent_types')->get();
        $resource = Entertainment::where('id', $id)->with('city','location','EntTypes','season','EntertainmentImages')->first();
        //dd($resource->toArray());
        return view('vendor.edit-entertainment', compact('resource'), $data);
    }

    public function update(Request $request, $id)
    {
        $ent = Entertainment::find($id);
        $exist_title = $ent->name;
        $ent->user_id = auth()->user()->id;
        $ent->city_id = $request->app_city;
        $ent->location_id =  $request->app_location;
        $ent->name = $request->name;
        $ent->short_title = $request->short_title;
        $ent->min_price = $request->min_price;
        $ent->description = $request->description;
        $ent->address = $request->address;
        $ent->email = $request->email;
        $ent->phone = $request->phone;
        $ent->season_id  = $request->app_seasion;

        if (Session::has('main_image')) {

            Helper::removeAllImage($ent->image, 'resource');
            $main_img = Session::get('main_image');
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

            $image_name = time().'-resource.webp';
            $large = public_path('images/resource/large/'.$image_name);
            $medium = public_path('images/resource/medium/'.$image_name);
            $ex_medium = public_path('images/resource/ex-medium/'.$image_name);
            $small = public_path('images/resource/small/'.$image_name);
            $ex_small = public_path('images/resource/ex-small/'.$image_name);
            Helper::resizeAndConpress($main_img, $width, $height,1,$large);
            Helper::resizeAndConpress($main_img, $width, $height,1.5,$medium);
            Helper::resizeAndConpress($main_img, $width, $height,2,$ex_medium);
            Helper::resizeAndConpress($main_img, $width, $height,3,$small);
            Helper::resizeAndConpress($main_img, $width, $height,3.5,$ex_small);
            $ent->image = $image_name;
        }

        $ent->save();
        $ent->EntTypes()->detach();
        $ent->EntTypes()->attach($request->types);

        $search_delete = Search::where('title',$exist_title)->first();
        $searchable  = Searchable::where('search_id',$search_delete->id)->delete();
        $search_delete->delete();

        $search = new Search;
        $search->title = $request->name;
        $search->short_title = $request->short_title;
        $search->save();

        $searchable = new Searchable;
        $searchable->search_id = $search->id;
        $searchable->searchable_id = $ent->id;
        $searchable->searchable_type = get_class($ent);
        $searchable->save();
        //return redirect()->back()->with('success', 'Entertainment successfully saved!');
        return redirect(route('rec_ent.upload',['rec_or_ent'=>'ent','id'=>$id]));

    }

    public function uploadImage(Request $request, $id)
    {
        $rules = array(
            'file' => 'required',
            'file.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
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
            $multiplyer = 1000;
            $width = imagesx($image) / $multiplyer;
            $height = imagesy($image) / $width;
            $width = $multiplyer;

            $image_name = time().rand().'-resource.webp';
            $large = public_path('images/resource/large/'.$image_name);
            $medium = public_path('images/resource/medium/'.$image_name);
            $ex_medium = public_path('images/resource/ex-medium/'.$image_name);
            $small = public_path('images/resource/small/'.$image_name);
            $ex_small = public_path('images/resource/ex-small/'.$image_name);
            Helper::resizeAndConpress($image_d, $width, $height,1,$large);
            Helper::resizeAndConpress($image_d, $width, $height,1.5,$medium);
            Helper::resizeAndConpress($image_d, $width, $height,2,$ex_medium);
            Helper::resizeAndConpress($image_d, $width, $height,3,$small);
            Helper::resizeAndConpress($image_d, $width, $height,3.5,$ex_small);
            $ent = new EntertainmentImage;
            $ent->entertainment_id = $id;
            $ent->path = $image_name;
            $ent->save();
        }
        $resource = Entertainment::where('id', $id)->with('recourceImage')->first();
        $images = view('vendor.inc.form.entertainment-form.resource-images', compact('resource'))->render();

        $output = array(
            'success' => 'Image uploaded successfully',
            'image'  => $images
        );
        return response()->json($output);
    }

    public function imageDelete(Request $request)
    {
        $rec_id = $request->rec_id;
        $img_id = $request->img_id;
        $current_image = EntertainmentImage::where('id', $img_id)->first();
        Helper::removeAllImage($current_image->path, 'resource');
        EntertainmentImage::where('id', $img_id)->delete();
        $resource = Entertainment::where('id', $rec_id)->with('recourceImage')->first();
        return view('vendor.inc.form.entertainment-form.resource-images', compact('resource'))->render();
    }

    public function entLocationSearch(Request $request)
    {
        return view('vendor.inc.ent-locations-content')->render();
    }

}
