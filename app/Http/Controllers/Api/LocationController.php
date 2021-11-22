<?php

namespace App\Http\Controllers\Api;

use App\Sea;
use App\City;
use App\Lake;
use App\Type;
use App\River;
use App\Season;
use App\Facility;
use App\Location;
use App\PriceType;
use App\PaymentType;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class LocationController extends ApiController
{
    public function index()
    {
        $locatins = Location::with('lakes', 'rivers')->get()->toArray();

        return $this->sendResponse($locatins, 200);
    }
    public function city()
    {
        $cities = City::all();
        return $this->sendResponse($cities, 200);
    }
    public function location($location)
    {
        $location = Location::where('id', $location)->with('lakes', 'rivers')->first();
        if (!$location) {
            return $this->sendError('Location does not exists', 404);
        }
        return $this->sendResponse($location, 200);
    }
    public function cityShow($city)
    {
        $city = City::where('id', $city)->with('locations')->first();
        if (!$city) {
            return $this->sendError('City does not exists', 404);
        }
        return $this->sendResponse($city, 200);
    }
    public function oneLake($lake)
    {
        $lake = Lake::where('id', $lake)->with('locations')->first();
        if (!$lake) {
            return $this->sendError('lake does not exists', 404);
        }
        return $this->sendResponse($lake, 200);
    }
    public function facility($facility)
    {
        $facility = Facility::find($facility);
        if (!$facility) {
            return $this->sendError('facility does not exists', 404);
        }
        return $this->sendResponse($facility, 200);
    }
    public function priceTypes()
    {
        $priceType = PriceType::all();
        return $this->sendResponse($priceType, 200);
    }
    public function paymentTypes()
    {
        $paymentType = PaymentType::all();
        return $this->sendResponse($paymentType, 200);
    }
    public function seasons()
    {
        $season = Season::all();
        return $this->sendResponse($season, 200);
    }
    public function oneRiver($river)
    {
        $river = River::where('id', $river)->with('locations')->first();
        if (!$river) {
            return $this->sendError('river does not exists', 404);
        }
        return $this->sendResponse($river, 200);
    }
    public function lakes($location_id)
    {
        $location = Location::find($location_id);
        if ($location) {
            $lakes = $location->lakes;
            return $this->sendResponse($lakes, 200);
        } else {
            return $this->sendError('location is not exists',404);
        }
    }
    public function rivers($location_id)
    {
        $location = Location::find($location_id);
        if ($location) {
            $rivers = $location->rivers;
            return $this->sendResponse($rivers, 200);
        } else {
            return $this->sendError('location is not exists',404);
        }
    }
    public function seas()
    {
        $seas = Sea::all();
        if ($seas) {
            return $this->sendResponse($seas, 200);
        } else {
            return $this->sendError('no sea available',404);
        }
    }
    public function types()
    {
        $types = Type::all();
        if ($types) {
            return $this->sendResponse($types, 200);
        } else {
            return $this->sendError('no sea available',404);
        }
    }
    public function facilities()
    {
        $facilities = Facility::all();
        if ($facilities) {
            return $this->sendResponse($facilities, 200);
        } else {
            return $this->sendError('no facilities available',404);
        }
    }
    public function allLakes()
    {
        $allLakes = Lake::all();
        if ($facilities) {
            return $this->sendResponse($allLakes, 200);
        } else {
            return $this->sendError('no Lakes available',404);
        }
    }
    public function allRivers()
    {
        $allRivers = River::all();
        if ($facilities) {
            return $this->sendResponse($allRivers, 200);
        } else {
            return $this->sendError('no Rivers available',404);
        }
    }
}
