<?php

namespace App\Http\Views\Composer\Vendor;

use Illuminate\View\View;
use App\EntCategory;
class EntCategoryComposer
{
	public function compose(View $view)
	{ 
		$ent_categories_types = EntCategory::with('ent_types')->get();
		$view->with('ent_categories_types', $ent_categories_types); 
	}

}
