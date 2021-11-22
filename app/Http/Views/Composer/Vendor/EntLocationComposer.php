<?php

namespace App\Http\Views\Composer\Vendor;

use Illuminate\View\View;
use App\Location;
class EntLocationComposer
{
	public function compose(View $view)
	{
		$keyword = request('keyword');
		if($keyword){
			$locations = Location::where('name', 'like', '%' . $keyword . '%')->get();
		}else{
			$locations = Location::all();
		}
		$view->with('ent_locations', $locations);
	}

}
