<?php

namespace App\Http\Controllers\Superadmin;

use Auth;
use App\Package;
use App\Resource;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entertainment;

class EntController extends Controller
{
	public $item_per_page = 30;

    public function index(Request $request)
    {
    	$data['entertainments'] = Entertainment::with('user','package')->orderBy('id','DESC')->paginate($this->item_per_page);
    	if($data['entertainments']){
    		$data['entertainments']->toArray();
    	}
    	$data['page'] = $request->page;
    	$data['item'] = $this->item_per_page;
    	if($request->ajax()){
        	return view('superadmin.include.ent-table',$data);
        }

    	//dd($data['resources']->toArray());
    	return view('superadmin.ent.index',$data);
    }

    public function changeStatus(Request $request)
    {
    	$rc = Entertainment::find($request->rec_id);
    	$rc->is_active = $request->status;
    	$rc->save();
    }

    public function vipResource(Request $request)
    {
    	$data['entertainment'] = Entertainment::with('user','package')->where('id',$request->rec_id)->first()->toArray();
    	$data['packages'] = Package::all();
    	return view('superadmin.include.ent-modal-content',$data);
    }

    public function makeVip(Request $request)
    {
    	$rc = Entertainment::find($request->rec_id);
    	$rc->package_id = $request->vipId;
        $rc->end_date = date('Y-m-d H:i:s', strtotime('+1 years'));
    	$rc->save();
    }
}
