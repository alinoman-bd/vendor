<?php

namespace App\Http\Controllers\Api;

use Auth;
use Mail;
use Cookie;
use Helper;
use App\Sea;
use App\City;
use App\Lake;
use App\Room;
use App\Slug;
use App\Type;
use App\User;
use App\River;
use App\Banner;
use App\Comment;
use App\EntType;
use App\Location;
use App\Resource;
use Faker\Factory;
use App\EntCategory;
use App\Entertainment;
use App\Mail\ContactMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class IndexController extends ApiController
{
    public function index(Request $request, $p1 = null, $p2 = null, $p3 = null)
    {
        $type = null;
        $locations = [];
        $lakes = [];
        $rivers = [];
        $seas = [];
        if ($p1 == null && $p2 == null) {
            $data['vip1'] = Helper::getVip1(6);
            $data['vip2'] = Helper::getVip2(6);
            $data['ent_vip1'] = Helper::entVip(4, 1);
            $data['ent_vip2'] = Helper::entVip(4, 2);
            $data['banner_top']  = Banner::where('position','top')->inRandomOrder()->first();
            $data['banner_bottom']  = Banner::where('position','bottom')->inRandomOrder()->first();
            return $this->sendResponse($data, 200);
        }
        if ($p1) {
            $p1_slug = Slug::where('slug', Str::slug($p1))->with('slugable')->first();
        }
        if (!$p1_slug) {
            return $this->sendError('no data found', 404);
        }
        if(class_basename($p1_slug->slugable_type) == 'Resource'){
            $data = $this->getResource($p1);
            return $this->sendResponse($data, 200);
        }
        if(class_basename($p1_slug->slugable_type) == 'Entertainment'){
            $data = $this->getEntertainment($p1);
            return $this->sendResponse($data, 200);
        }

        if ($p1) {
            $p1_slug = Slug::where('slug', Str::slug($p1))->with('slugable')->first();

            if(class_basename($p1_slug->slugable_type) == 'City'){
                $model_p1 = ($p1_slug->slugable_type)::where('id', $p1_slug->slugable_id)
                ->with(['locations.lakes', 'locations.rivers'])->first();
                $locations[] = $model_p1->locations->pluck('id')->toArray();
                $locations =  $locations[0];
                foreach ($model_p1->locations as  $location) {
                    $lakes[] = $location->lakes->pluck('id')->toArray();
                    $rivers[] = $location->rivers->pluck('id');
                }
                $lakes = collect($lakes)->collapse()->unique();
                $rivers = collect($rivers)->collapse()->unique();
            }elseif(class_basename($p1_slug->slugable_type) == 'Location'){
                $locations[] = $p1_slug->slugable_id;
                // dd($model_p1);
                $model_p1 = ($p1_slug->slugable_type)::where('id', $p1_slug->slugable_id)
                        ->with(['lakes', 'rivers'])->first();

                $lakes= $model_p1->lakes->pluck('id')->unique()->toArray();
                $rivers = $model_p1->rivers->pluck('id')->unique()->toArray();
            } else {
                if(class_basename($p1_slug->slugable_type) == 'Lake'){
                    $lakes[] = $p1_slug->slugable->id;
                }elseif(class_basename($p1_slug->slugable_type) == 'River'){
                    $rivers[] = $p1_slug->slugable->id;
                }elseif(class_basename($p1_slug->slugable_type) == 'Sea'){
                    $seas[] = $p1_slug->slugable->id;
                }elseif(class_basename($p1_slug->slugable_type) == 'Type'){
                    $type = $p1_slug->slugable->id;
                }
            }
        }
        if ($p2) {
            $p2_slug = Slug::where('slug', Str::slug($p2))->with('slugable')->first();

            if(class_basename($p2_slug->slugable_type) == 'Lake'){
                $lakes = $p2_slug->slugable->id;
            }elseif(class_basename($p2_slug->slugable_type) == 'River'){
                $rivers = $p2_slug->slugable->id;
            }elseif(class_basename($p2_slug->slugable_type) == 'Sea'){
                $seas = [$p2_slug->slugable->id];
            }
        }

        $resource_query = Resource::with(['comments','types']);
        if (count($locations)) {
            $resource_query = $resource_query->whereIn('location_id', $locations);
            if(gettype($lakes) == "integer"){
                $resource_query = $resource_query->where('lake_id', $lakes);
            }
            if(gettype($rivers) == 'integer'){
                $resource_query = $resource_query->where('river_id', $rivers);
            }
        }else {
            if (count($lakes)) {
                $resource_query = $resource_query->orWhereIn('lake_id', $lakes);
            }
            if (count($rivers)) {
                $resource_query = $resource_query->orWhereIn('river_id', $rivers);
            }
            if (count($seas)) {
                $resource_query = $resource_query->orWhereIn('sea_id', $seas);
            }
            if ($type) {
                $resource_ids = Type::find($type)->resources->pluck('id')->unique()->toArray();
                $resource_query = $resource_query->whereIn('id', $resource_ids);
            }
        }

        $data['resources'] = $resource_query->where('is_active', 1)
            ->orderBy('package_id', 'asc')
            ->paginate(30);

        $ent_cat = EntCategory::where('slug',$p1)->first();
        if($ent_cat){
            $ent_cat_id = $ent_cat->id;
            $ent_type_id = '';
            $ent_location_id = '';
            if($p2){
                $ent_type = EntType::where('slug',$p2)->first();
                if($ent_type){
                    $ent_type_id = $ent_type->id;
                    $items['ent_type'] = $ent_type;
                }else{
                     $get_location = Location::where('slug',$p2)->first();
                    if($get_location){
                        $ent_location_id = $get_location->id;
                        $items['ent_exist_location'] = $get_location;
                    }
                }
            }
            $ent_query = Entertainment::query();
            if ($ent_type_id != '') {
                $ent_query->entertainmentByType($ent_type_id);
            } else {
                $ent_query->entertainmentByCategory($ent_cat_id);
            }
            if($ent_location_id){
                $ent_query->where('location_id',$ent_location_id);
            }
            if($p3){
                $get_location = Location::where('slug',$p3)->first();
                if($get_location){
                    $ent_query->where('location_id',$get_location->id);
                    $items['ent_exist_location'] = $get_location;
                }
            }

            $data['resources'] = $ent_query->where('is_active', 1)->orderBy('package_id')->paginate(30);
            $items['ent_cat'] = $ent_cat;
            $data['banner_top']  = Banner::where('position','top')->inRandomOrder()->first();
            $data['banner_bottom']  = Banner::where('position','bottom')->inRandomOrder()->first();
            return $this->sendResponse([
                'data' => $data,
                'items' => $items
            ], 200);
        }


        $var = [$p1, $p2];
        $items = $this->identifyVariable($var);
        // $data['resources'] = $this->searchData($items);

        $data['banner_top']  = Banner::where('position','top')->inRandomOrder()->first();
        $data['banner_bottom']  = Banner::where('position','bottom')->inRandomOrder()->first();
        return $this->sendResponse([
            'data' => $data,
            'items' => $items
        ], 200);
    }
    public function getEntertainment($slug)
    {
        $data['resource'] = Entertainment::with('recourceImage','city','location','videos','user','comments.replay')    ->where('slug', $slug)->first();
        $data['viewed'] = Helper::getViewed();
        if ($data['viewed']) {
            if(!is_array($data['viewed'])){
                $data['viewed'] = $data['viewed']->toArray();
            }
        } else {
            $data['viewed'] = [];
        }
        $data['vip1'] = Helper::getVip1(3);
        $data['vip2'] = Helper::getVip2(6);
        $data['rec_type'] = 'ent';
        return $data;
    }
    public function getResource($slug)
    {
        $data['resource'] = Resource::with([
                'recourceImage',
                'facilities',
                'rooms.bedType',
                'city',
                'location',
                'videos',
                'user',
                'comments.replay'
        ])->where('slug', $slug)->first();
        $data['viewed'] = Helper::getViewed();
        if ($data['viewed']) {
            if(!is_array($data['viewed'])){
                $data['viewed'] = $data['viewed']->toArray();
            }
        } else {
            $data['viewed'] = [];
        }
        $data['vip1'] = Helper::sameLocationVip($data['resource'], 4, 1);
        $data['vip2'] = Helper::sameLocationVip($data['resource'], 6, 2);
        $data['rec_type'] = 'rec';
        return $data;
    }
    public function identifyVariable($vars)
    {
        $items = [];
        foreach ($vars as $item) {
            if ($item) {
                $city = City::where('slug', $item)->first();
                if ($city) {
                    $items['city'] = $city;
                }
                $location = Location::where('slug', $item)->first();
                if ($location) {
                    $items['location'] = $location;
                }
                $lake = Lake::where('slug', $item)->first();
                if ($lake) {
                    $items['lake'] = $lake;
                }
                $river = River::where('slug', $item)->first();
                if ($river) {
                    $items['river'] = $river;
                }
                $type = Type::where('slug', $item)->first();
                if ($type) {
                    $items['type'] = $type;
                }
                $sea = Sea::where('slug', $item)->first();
                if ($sea) {
                    $items['sea'] = $sea;
                }
            }
        }
        return $items;
    }
    //TODO: it will be nice if make this by some filters and join with pipeline.
    public function searchData($item)
    {
        $city_id     = @$item['city']->id;
        $location_id = @$item['location']->id;
        $lake_id     = @$item['lake']->id;
        $rive_id     = @$item['river']->id;
        $sea_id      = @$item['sea']->id;
        $type_id     = @$item['type']->id;

        return Resource::with(['comments','types' => function ($q) use ($type_id) {
            $q->where('type_id', $type_id);
        }])
            ->when($type_id, function ($q) use ($type_id) {
                return $q->WhereHas('types', function ($q1) use ($type_id) {
                    $q1->where('type_id', $type_id);
                });
            })
            ->when($city_id, function ($q) use ($city_id) {
                return $q->where('city_id', $city_id);
            })
            ->when($location_id, function ($q) use ($location_id) {
                return $q->where('location_id', $location_id);
            })
            ->when($lake_id, function ($q) use ($lake_id) {
                return $q->where('lake_id', $lake_id);
            })
            ->when($rive_id, function ($q) use ($rive_id) {
                return $q->where('river_id', $rive_id);
            })
            ->when($sea_id, function ($q) use ($sea_id) {
                return $q->where('sea_id', $sea_id);
            })
            ->where('is_active', 1)
            ->orderBy('package_id', 'asc')
            ->paginate(30);
    }
}