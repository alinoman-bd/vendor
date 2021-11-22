<?php

namespace App\Http\Controllers;
use Cookie;
use App\Resource;
use Illuminate\Http\Request;
use Helper;
use App\Entertainment;

class FavoriteController extends Controller
{
    public $time = 2147483647;
    public $item_per_page = 30;
    public function index(Request $request)
    {
        $data['resources'] = $this->getFavorite(1);
        if($request->ajax()){
            if($request->status == 1){
                $data['resources'] = $this->getFavorite(1);
                $data['page'] = $request->page;
                return view('vendor.inc.favorite-content',$data)->render();
            }else{
                $data['resources'] = $this->getFavorite(2);
                $data['page'] = $request->page;
                return view('vendor.inc.ent-favorite-content',$data)->render();
            }

        }
        $data['vip1'] = Helper::getVip1(6);
        $data['page'] = $request->page;
        return view('favorite', $data);
    }
    public function makeFavrite(Request $request)
    {
        return $this->setFavorite($request->rec_id, $request->status);
    }

    public function setFavorite($rec_id, $status)
    {
        $status = trim($status);
        if($status == 1){
            $name = 'favorite';
        }else{
            $name = 'ent_favorite';
        }
        if (Cookie::has($name)) {
            $favorite = Cookie::get($name);
            $favorite = json_decode($favorite, true);
            if (!in_array($rec_id, $favorite)) {
                array_unshift($favorite, $rec_id);
                $json = json_encode($favorite);
                Cookie::queue($name, $json, $this->time);
            }
        } else {
            $favorite = [];
            $favorite[] = $rec_id;
            $json = json_encode($favorite);
            Cookie::queue($name, $json, $this->time);
        }
    }

    public function getFavorite($status)
    {
        if($status == 1){
            $name = 'favorite';
        }else{
            $name = 'ent_favorite';
        }
        $favorite = Cookie::get($name);
        if ($favorite) {
            $favorite = json_decode($favorite, true);
            if($status == 1){
                return Resource::whereIn('id', $favorite)->orderByRaw("field(id," . implode(',', $favorite) . ")")->paginate($this->item_per_page);
            }else{
                return Entertainment::whereIn('id', $favorite)->orderByRaw("field(id," . implode(',', $favorite) . ")")->paginate($this->item_per_page);
            }

        } else {
            return [];
        }
    }

    public function ajaxFavorites(Request $request)
    {
        $status = $request->status;
        if($status == 1){
            $name = 'favorite';
        }else{
            $name = 'ent_favorite';
        }
        $favorite = Cookie::get($name);
        if ($favorite) {
            $favorite = json_decode($favorite, true);
            if($status == 1){
                $data['resources'] = Resource::whereIn('id', $favorite)->orderByRaw("field(id," . implode(',', $favorite) . ")")->paginate($this->item_per_page);
                $data['page'] = $request->page;
                return view('vendor.inc.favorite-content',$data)->render();
            }else{
                $data['resources'] = Entertainment::whereIn('id', $favorite)->orderByRaw("field(id," . implode(',', $favorite) . ")")->paginate($this->item_per_page);
                $data['page'] = $request->page;
                return view('vendor.inc.ent-favorite-content',$data)->render();
            }
        } else {
            return [];
        }
    }

    public function entFavorites(Request $request)
    {
        $data['resources'] = $this->getFavorite(2);
        $data['vip1'] = Helper::getVip1(6);
        $data['page'] = $request->page;
        return view('ent-favorite', $data);
    }

    public function removeIitemFormFavorite($rec_id,$status)
    {
        if($status == 1){
            $name = 'favorite';
        }else{
            $name = 'ent_favorite';
        }
        $favorite = Cookie::get($name);
        $favorite = json_decode($favorite, true);
        $remove = array_diff($favorite, [$rec_id]);
        $json = json_encode($remove);
        Cookie::queue($name, $json, $this->time);
    }

    public function deleteFavrite(Request $request)
    {
        return $this->removeIitemFormFavorite($request->rec_id, $request->status);
    }
}
