<?php

namespace App\Http\Views\Composer\Vendor;

use Illuminate\View\View;
use App\Location;
class LakeComposer
{
	public function compose(View $view)
	{
		$location_id = request('location_id');
		if ($location_id) {
			$lakes = Location::find($location_id)->lakes()->get();
		} else {
			$lakes = collect([]);
		}
		$view->with('lakes', $lakes);
	}

}