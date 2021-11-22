<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;


class SlugController extends Controller
{
    //TODO:  why this checkSlug here. may be it should be a trait
    public function checkSlug(Request $request)
    {
        $current_model = $request->model;
        $item = $request->item;
        $id = $request->id;
        $slug = Str::slug($item);
        $models = [
            'App\City',
            'App\Location',
            'App\Lake',
            'App\River',
            'App\Sea',
            'App\Type',
            'App\EntCategory',
            'App\EntType',
            'App\EntType',
            'App\EntCategory',
        ];
        $find = $current_model::where('slug', $slug)->where('id', '!=', $id)->first();
        if ($find) {
            return 'exist';
        } 
        $models = array_diff($models, [$current_model]);
        foreach ($models as $key => $model) {
            $find = $model::where('slug', $slug)->first();
            if ($find) {
                return 'exist';
            }
        }
        return $slug;
    }
}
