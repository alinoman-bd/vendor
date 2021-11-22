<?php

namespace App;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;

class Lake extends Model
{
	use Slugable;
    protected $fillable = ['name','slug','seo_title'];

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
}