<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EntCategory;

class EntCategoryController extends Controller
{
    public function index()
    {
    	$data['ent_categories'] = EntCategory::all();
    	return view('superadmin.ent_category.index',$data);
    } 
    public function getEntCategoryById(Request $request){
    	$ent_category = EntCategory::find($request->id);
    	return view('superadmin.ent_category.edit-ent-category',compact('ent_category'))->render();
    }
    public function updateEntCategory(Request $request)
    {
    	$ent_category = EntCategory::find($request->id);
    	$ent_category->name = $request->name;
    	$ent_category->slug = $request->slug;
    	$ent_category->seo_title = $request->seo_title;
    	$ent_category->seo_tag = $request->seo_tag;
    	$ent_category->seo_keyword = $request->seo_keyword;
    	$ent_category->seo_description = $request->seo_description;
        $ent_category->page_description = $request->page_description;
    	$ent_category->save();
    	$ent_categories = EntCategory::all();
    	return view('superadmin.include.ent-category-table',compact('ent_categories'))->render();
    }
}
