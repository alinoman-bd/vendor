<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EntType;
class EntTypeController extends Controller
{
    public $item_per_page = 30;  

    public function index(Request $request)
    {
    	$data['ent_types'] = EntType::paginate($this->item_per_page);
        $data['page'] = $request->page;
        $data['item'] = $this->item_per_page;
        if($request->ajax()){
            return view('superadmin.include.ent-type-table',$data);
        }
    	return view('superadmin.ent_type.index',$data);
    }
    public function getEntTypeById(Request $request){
    	$ent_type = EntType::find($request->id);
    	return view('superadmin.ent_type.edit-ent-type',compact('ent_type'))->render();
    }
    public function updateEntType(Request $request)
    {
    	$ent_type = EntType::find($request->id);
    	$ent_type->name = $request->name;
    	$ent_type->slug = $request->slug;
    	$ent_type->seo_title = $request->seo_title;
    	$ent_type->seo_tag = $request->seo_tag;
    	$ent_type->seo_keyword = $request->seo_keyword;
    	$ent_type->seo_description = $request->seo_description;
        $ent_type->page_description = $request->page_description;
    	$ent_type->save();
    }
}
