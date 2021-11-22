<?php

namespace App\Http\Controllers\Vendor;


use App\Image;
use Validator;
use App\Resource;
use App\ResourceImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use App\Http\Services\ResourceService;
use Illuminate\Support\Facades\Session;
use App\Search;
use App\Searchable;
use Str;
use Helper;
use Imager;
use App\Entertainment;
class ApartmentInfoController extends Controller
{
	public function apartmentForm()
	{
		$data['vip1'] = Helper::getVip1(5);
		return view('vendor.apartment-form',$data);
	}
	public function getLocations(Request $request)
	{
		$locations = view('vendor.inc.form.apartment-form.location')->render();
		$lakes = view('vendor.inc.form.apartment-form.lakes')->render();
		$rivers = view('vendor.inc.form.apartment-form.rivers')->render();
		return response()->json(['locations' => $locations, 'lakes' => $lakes, 'rivers' => $rivers]);
	}
	public function getLakes(Request $request)
	{
		return view('vendor.inc.form.apartment-form.lakes')->render();
	}
	public function getRivers(Request $request)
	{
		return view('vendor.inc.form.apartment-form.rivers')->render();
	}
	public function SaveApartmentForm(Request $request)
	{
		//Resource::create($request->all());
		$response = $this->saveApartment($request);
		//return redirect()->back()->with('success', 'Apartment successfully saved!');
		//return redirect(route('payment.index',['rec_or_ent'=>'rec','id'=>$response->id]));

		// $url = route('payment.index',['rec_or_ent'=>'rec','id'=>$response->id]);
  //       $url .='?done=done';
  //       return redirect($url);

		return redirect(route('rec_ent.upload',['rec_or_ent'=>'rec','id'=>$response->id]));

	}
	public function saveApartment($data)
	{
		$resource = new Resource;
		$resource->user_id = auth()->user()->id;
		$resource->name = $data->app_resource_name;
		$resource->email = $data->app_email;
		$resource->phone = $data->app_phone;
		$resource->short_title = $data->app_sort_title;
		$resource->nearest_locations = $data->nearest_location;
		$resource->address = $data->app_address;
		$resource->number_of_rooms = $data->app_total_room;
		$resource->number_of_people = $data->app_total_people;
		$resource->description = $data->app_description;
		if($data->check_type_value == 1){
			$resource->city_id = $data->app_city;
			$resource->location_id = $data->app_location;
			$resource->lake_id = $data->app_lake;
			$resource->river_id = $data->app_river;
		}else{
			$resource->sea_id = $data->app_sea;
		}
		$resource->min_price = $data->app_single_min_price;
		$resource->max_price = $data->app_single_max_price;
		$resource->total_min_price = $data->app_total_min_price;
		$resource->total_max_price = $data->app_total_max_price;
		$resource->price_type_id = $data->app_single_price_type;
		$resource->season_id = $data->app_seasion;
		$resource->payment_type_id = $data->app_payment_type;
		$resource->distance_from_lake = $data->app_d_from_lake;
		$resource->distance_from_river = $data->app_d_from_river;
		$resource->distance_from_sea = $data->app_d_from_sea;
		$resource->contact_person = $data->app_contact_person;
		$resource->note = $data->app_note;
		$resource->package_id = 3;


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
            $resource->image = $image_name;
		}
		$resource->save();
		$resource->types()->attach($data->app_type);
		$resource->facilities()->attach($data->facilities);

		$search = new Search;
		$search->title = $data->app_resource_name;
		$search->short_title = $data->app_sort_title;
		$search->save();


		$searchable = new Searchable;
		$searchable->search_id = $search->id;
		$searchable->searchable_id = $resource->id;
		$searchable->searchable_type = get_class($resource);
		$searchable->save();
		return $resource;

	}

	public function edit($id)
	{
		$data['vip1'] = Helper::getVip1(5);
		$resource = Resource::where('id', $id)->with('city', 'location', 'lake', 'river', 'sea', 'priceType', 'season', 'payment', 'types', 'recourceImage','facilities')->first();
		//dd($resource->toArray());
		return view('vendor.apartment-edit', compact('resource'), $data);
	}
	public function update(Request $request, $id)
	{
		// $validator = Validator::make($request->all(), [
		// 	'app_type' => 'required',
		// 	'app_city' => 'required',
		// 	'app_location' => 'required',
		// 	'app_lake' => 'required',
		// 	'app_river' => 'required',
		// 	'app_sea' => 'required',
		// 	'app_resource_name' => 'required',
		// 	'app_sort_title' => 'required',
		// 	'app_description' => 'required',
		// 	'app_address' => 'required',
		// 	'nearest_location' => 'required',
		// 	'app_phone' => 'required | unique:resources,phone,' . $id,
		// 	'app_email' => 'required | email | unique:resources,email,' . $id,
		// 	'app_single_min_price' => 'required',
		// 	'app_single_max_price' => 'required',
		// 	'app_single_price_type' => 'required',
		// 	'app_total_min_price' => 'required',
		// 	'app_total_max_price' => 'required',
		// 	'app_total_room' => 'required',
		// 	'app_total_people' => 'required',
		// 	'app_seasion' => 'required',
		// 	'app_payment_type' => 'required',
		// 	'app_note' => 'required',
		// 	'app_contact_person' => 'required',

		// ]);

		// if ($validator->fails()) {
		// 	return redirect()->back()->withErrors($validator)->withInput();
		// }
		$this->updateResource($request, $id);
		return redirect(route('rec_ent.upload',['rec_or_ent'=>'rec','id'=>$id]));
	}
	public function updateResource($data, $id)
	{
		$resource = Resource::find($id);
		$exist_title = $resource->name;
		$resource->name = $data->app_resource_name;
		$resource->email = $data->app_email;
		$resource->phone = $data->app_phone;
		$resource->short_title = $data->app_sort_title;
		$resource->nearest_locations = $data->nearest_location;
		$resource->address = $data->app_address;
		$resource->number_of_rooms = $data->app_total_room;
		$resource->number_of_people = $data->app_total_people;
		$resource->description = $data->app_description;
		if($data->check_type_value == 1){
			$resource->city_id = $data->app_city;
			$resource->location_id = $data->app_location;
			$resource->lake_id = $data->app_lake;
			$resource->river_id = $data->app_river;
		}else{
			$resource->sea_id = $data->app_sea;
		}

		$resource->min_price = $data->app_single_min_price;
		$resource->max_price = $data->app_single_max_price;
		$resource->total_min_price = $data->app_total_min_price;
		$resource->total_max_price = $data->app_total_max_price;
		$resource->price_type_id = $data->app_single_price_type;
		$resource->season_id = $data->app_seasion;
		$resource->payment_type_id = $data->app_payment_type;
		$resource->distance_from_lake = $data->app_d_from_lake;
		$resource->distance_from_river = $data->app_d_from_river;
		$resource->distance_from_sea = $data->app_d_from_sea;
		$resource->contact_person = $data->app_contact_person;
		$resource->note = $data->app_note;


		if (Session::has('main_image')) {

			Helper::removeAllImage($resource->image, 'resource');
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
			$resource->image = $image_name;


		}


		$resource->save();
		$resource->types()->detach();
		$resource->types()->attach($data->app_type);
		$resource->facilities()->detach();
		$resource->facilities()->attach($data->facilities);



		$search_delete = Search::where('title',$exist_title)->first();
		$searchable  = Searchable::where('search_id',$search_delete->id)->delete();
		$search_delete->delete();
		$search = new Search;
		$search->title = $data->app_resource_name;
		$search->short_title = $data->app_sort_title;
		$search->save();

		$searchable = new Searchable;
		$searchable->search_id = $search->id;
		$searchable->searchable_id = $resource->id;
		$searchable->searchable_type = get_class($resource);
		$searchable->save();


		// $main_image = Image::create([
		// 	'title' => 'resource title ',
		// 	'image_path' => "images/rooms/" . $main_file_name,
		// 	'is_main' => 1
		// ]);

		// $resource->images()->attach($main_image);
	}
	public function delete(Request $request)
	{
		if($request->status == 1){
			$rec = Resource::where('id', $request->rec_id)->with('recourceImage')->first();
			Search::where('title',$rec->name)->delete();
			Helper::removeAllImage($rec->image, 'resource');
			if(count($rec->recourceImage) > 0){
				foreach ($rec->recourceImage as $img) {
					Helper::removeAllImage($img->path, 'resource');
				}
			}
			Resource::where('id', $request->rec_id)->delete();
			$data['resources'] = Resource::where('user_id', $request->user_id)->get();
			return view('vendor.inc.profile.listing-table', compact('data'))->render();
		}else{
			$ent = Entertainment::where('id', $request->rec_id)->with('recourceImage')->first();
			Search::where('title',$ent->name)->delete();
			Helper::removeAllImage($ent->image, 'resource');
			if(count($ent->recourceImage) > 0){
				foreach ($ent->recourceImage as $img) {
					Helper::removeAllImage($img->path, 'resource');
				}
			}
			Entertainment::where('id', $request->rec_id)->delete();
			$data['entertainments'] = Entertainment::where('user_id', $request->user_id)->get();
			return view('vendor.inc.profile.payment-table', compact('data'))->render();
		}

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
	        $rc = new ResourceImage;
			$rc->resource_id = $id;
			$rc->path = $image_name;
			$rc->save();
		}
		$resource = Resource::where('id', $id)->with('recourceImage')->first();
		$images = view('vendor.inc.form.apartment-form.resource-images', compact('resource'))->render();

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
		$current_image = ResourceImage::where('id', $img_id)->first();
		Helper::removeAllImage($current_image->path, 'resource');
		ResourceImage::where('id', $img_id)->delete();
		$resource = Resource::where('id', $rec_id)->with('recourceImage')->first();
		return view('vendor.inc.form.apartment-form.resource-images', compact('resource'))->render();
	}


}
