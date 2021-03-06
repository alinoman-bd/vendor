<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $guarded=[];
	

	public function resource()
	{
		return $this->morphedByMany(Resource::class,'imageable');
	}
	

}
