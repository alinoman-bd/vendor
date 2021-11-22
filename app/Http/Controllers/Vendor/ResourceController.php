<?php

namespace App\Http\Controllers\Vendor;

use App\Resource;

use Helper;
use App\Room;
use App\City;
use App\Location;
use App\Lake;
use App\River;
use App\Sea;
use App\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public $city_id;
    public $location_id;
    public $lake_id;
    public $river_id;
    public $sea_id;
    public $type_id;

    public function index(Request $request, $p1 = null, $p2 = null, $p3 = null, $p4 = null, $p5 = null)
    {
        $var = [$p1, $p2, $p3, $p4, $p5];
        $items = $this->identifyVariable($var);

        $city_id     = @$items['city_id'];
        $location_id = @$items['location_id'];
        $lake_id     = @$items['lake_id'];
        $rive_id     = @$items['river_id'];
        $sea_id      = @$items['sea_id'];
        $type_id     = @$items['type_id'];

        //return @$items['sea_name'];
        $data['resources'] = Resource::with(['types' => function ($q) use ($type_id) {
            $q->where('type_id', $type_id);
        }])
            ->when($type_id, function ($q) use ($type_id) {
                return $q->WhereHas('types', function ($q1) use ($type_id) {
                    $q1->where('type_id', $type_id);
                });
            })
            ->when($city_id != null && $sea_id == null, function ($q) use ($city_id) {
                return $q->where('city_id', $city_id);
            })
            ->when($location_id != null && $sea_id == null, function ($q) use ($location_id) {
                return $q->where('location_id', $location_id);
            })
            ->when($lake_id != null && $sea_id == null, function ($q) use ($lake_id) {
                return $q->where('lake_id', $lake_id);
            })
            ->when($rive_id != null && $sea_id == null, function ($q) use ($rive_id) {
                return $q->where('river_id', $rive_id);
            })
            ->when($sea_id != null, function ($q) use ($sea_id) {
                return $q->where('sea_id', $sea_id);
            })
            ->where('is_active', 1)
            ->orderBy('package_id', 'asc')
            ->paginate(30);


        // dd($data['resources']->toArray());
        return view('vendor.search-result', $data, compact('items'));
    }

    public function identifyVariable($data)
    {
        $all_item = [];
        foreach ($data as $key => $var) {
            $item = $var;
            if ($var) {
                if (strpos($var, '-') !== false) {
                    $item = str_replace("-", " ", $var);
                }
            }

            $city = City::where('name', $item)->first();
            if ($city) {
                $all_item['city_id'] = $city->id;
                $all_item['city_name'] = $item;
                $all_item['city_name1'] = $var;
            }
            $location = Location::where('name', $item)->first();
            if ($location) {
                $all_item['location_id'] = $location->id;
                $all_item['location_name'] = $item;
                $all_item['location_name1'] = $var;
            }
            $lake = Lake::where('name', $item)->where('location_id', @$all_item['location_id'])->first();
            if ($lake) {
                $all_item['lake_id'] = $lake->id;
                $all_item['lake_name'] = $item;
                $all_item['lake_name1'] = $var;
            }
            $river = River::where('name', $item)->where('location_id', @$all_item['location_id'])->first();
            if ($river) {
                $all_item['river_id'] = $river->id;
                $all_item['river_name'] = $item;
                $all_item['river_name1'] = $var;
            }
            $type = Type::where('name', $item)->first();
            if ($type) {
                $all_item['type_id'] = $type->id;
                $all_item['type_name'] = $item;
                $all_item['type_name1'] = $var;
            }
            $sea = Sea::where('name', $item)->first();
            if ($sea) {
                $all_item['sea_id'] = $sea->id;
                $all_item['sea_name'] = $item;
                $all_item['sea_name1'] = $var;
            }
        }

        return $all_item;
    }
    public function resourceDetails($name, $id)
    {

        $data['resource'] = Resource::with('recourceImage', 'facilities', 'rooms.bedType', 'city', 'location')->where('id', $id)->first();
        $data['viewed'] = Helper::getViewed();
        if ($data['viewed']) {
            $data['viewed'] = $data['viewed']->toArray();
        } else {
            $data['viewed'] = [];
        }
        $data['vip1'] = Helper::sameLocationVip($data['resource'], 5, 1);
        $data['vip2'] = Helper::sameLocationVip($data['resource'], 6, 2);
        //dd($data['vip1']);

        return view('vendor.details', $data);
    }

    public function singleRoom(Request $request)
    {
        $room_id = $request->room_id;
        $rec_id = $request->rec_id;
        $room = Room::where('id', $room_id)->with('images', 'bedType')->first();

        $resource = Resource::where('id', $rec_id)->with('facilities')->first();
        return view('vendor.inc.modal.details-room-modal', compact('room', 'resource'))->render();
    }

    public function loadMenu(Request $request)
    {
        $location = Location::find($request->location_id);
        $data['colsize'] = $request->colsize;
        $data['location_slug'] = $location ? $location->slug . '/' : '';
        $view['city'] = view('vendor.inc.menu.city_location', $data)->render();
        $view['lake'] = view('vendor.inc.menu.location_lake', $data)->render();
        $view['river'] = view('vendor.inc.menu.location_river', $data)->render();
        return $view;
    }
}
