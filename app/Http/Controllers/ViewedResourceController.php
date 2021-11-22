<?php

namespace App\Http\Controllers;

use Cookie;
use App\Resource;
use Illuminate\Http\Request;

class ViewedResourceController extends Controller
{
    public $time = 2147483647;
    
    public function makeViewed(Request $request)
    {
        $this->setViewed($request->rec_id, $request->status);
    }

    public function setViewed($rec_id, $status)
    {
        if($status == 1){
            $name = 'rec_viewed';
        }else{
            $name = 'ent_rec_viewed';
        }
        if(Cookie::has($name)){
            $rec_viewed = Cookie::get($name);
            $rec_viewed = json_decode($rec_viewed, true);
            if(!in_array($rec_id, $rec_viewed)){
                array_unshift($rec_viewed , $rec_id);
                $json = json_encode($rec_viewed);
                Cookie::queue($name, $json, $this->time);
            }
        }else{
            $rec_viewed = [];
            $rec_viewed[] = $rec_id;
            $json = json_encode($rec_viewed);
            Cookie::queue($name, $json, $this->time);
        }
    }
}
