<?php

namespace App\Http\Controllers\Api;

use App\Search;
use App\Resource;
use Carbon\Carbon;
use App\Searchable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\Vendor\Helper;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\ApiController;

class ResourceController extends ApiController
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'resource_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'sort_title' => 'required',
            'total_room' => 'required',
            'total_people' => 'required',
            'check_type_value' => 'required',
            'description' => 'required',
            'nearest_location' => 'required',
            'single_min_price' => 'required',
            'single_max_price' => 'required',
            'total_min_price' => 'required',
            'total_max_price' => 'required',
            'single_price_type' => 'required',
            'seasion' => 'required',
            'type' => 'required',
            'payment_type' => 'required',
            'contact_person' => 'required',
            'note' => 'required',
            'main_image' => 'required',
            'facilities' => 'required|array',
            'facilities.*' => 'required|integer|min:1'
        ]);
        $resource = new Resource;
		$resource->user_id = auth()->user()->id;
		$resource->name = $request->resource_name;
		$resource->email = $request->email;
		$resource->phone = $request->phone;
		$resource->short_title = $request->sort_title;
		$resource->nearest_locations = $request->nearest_location;
		$resource->address = $request->address;
		$resource->number_of_rooms = $request->total_room;
		$resource->number_of_people = $request->total_people;
		$resource->description = $request->description;
		if($request->check_type_value == 1){
            if (empty($request->city)) {
                $error['city'] = 'city is required';
            }
            if (empty($request->location)) {
                $error['location'] = 'location is required';
            }
            if (empty($request->lake)) {
                $error['lake'] = 'lake is required';
            }
            if (empty($request->river)) {
                $error['river'] = 'river is required';
            }
            if ($error) {
                return $this->sendError($error, 406);
            }
			$resource->city_id = $request->city;
			$resource->location_id = $request->location;
			$resource->lake_id = $request->lake;
			$resource->river_id = $request->river;
		}else{
			$resource->sea_id = $request->sea;
            if (empty($request->sea)) {
                $error['sea'] = 'sea is required';
            }
            if ($error) {
                return $this->sendError($error, 406);
            }
		}
		$resource->min_price = $request->single_min_price;
		$resource->max_price = $request->single_max_price;
		$resource->total_min_price = $request->total_min_price;
		$resource->total_max_price = $request->total_max_price;
		$resource->price_type_id = $request->single_price_type;
		$resource->season_id = $request->seasion;
		$resource->payment_type_id = $request->payment_type;
		$resource->distance_from_lake = $request->d_from_lake;
		$resource->distance_from_river = $request->d_from_river;
		$resource->distance_from_sea = $request->d_from_sea;
		$resource->contact_person = $request->contact_person;
		$resource->note = $request->note;
		$resource->package_id = 3;


		if ($request->main_image) {
            $image = Image::make($request->main_image);
            $name = Carbon::now()->timestamp .'_'. Str::random(20);
            $ext = str_replace('image/', '', $image->mime());
            $path = $name . '.' . $ext;
            $image->save(storage_path('app/public/images/'.$path));
			$image = false;
            $main_img = storage_path('app/public/images/'.$path);
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
		$resource->types()->attach($request->type);
		$resource->facilities()->attach($request->facilities);

		$search = new Search;
		$search->title = $request->resource_name;
		$search->short_title = $request->sort_title;
		$search->save();

		$searchable = new Searchable;
		$searchable->search_id = $search->id;
		$searchable->searchable_id = $resource->id;
		$searchable->searchable_type = get_class($resource);
		$searchable->save();
        return $this->sendResponse($resource, 201);
    }
    function base64ToImage($base64_string, $output_file) {
        $file = fopen($output_file, "wb");

        $data = explode(',', $base64_string);

        fwrite($file, base64_decode($data[1]));
        fclose($file);

        return $output_file;
    }
}