<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class AnyController extends ApiController
{
    public function postAny()
    {
        return $this->sendError(['No post route found'], 404);
    }
    public function getAny()
    {
        return $this->sendError(['No get route found'], 404);
    }
}
