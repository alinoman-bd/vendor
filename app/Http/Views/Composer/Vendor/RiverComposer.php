<?php

namespace App\Http\Views\Composer\Vendor;

use Illuminate\View\View;
use App\Location;
class RiverComposer
{
	public function compose(View $view)
	{
		$location_id = request('location_id');
		if ($location_id) {
			$rivers = Location::find($location_id)->rivers()->get();;
		} else {
			$rivers = collect([]);
		}
		$view->with('rivers', $rivers);
	}

}