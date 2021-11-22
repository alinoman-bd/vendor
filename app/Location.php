<?php

namespace App;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    use Slugable;
    protected $filable = ['name','slug','seo_title'];

    public function city()
    {
       return $this->belongsToMany(City::class);
    }

    public function lakes()
    {
        return $this->belongsToMany(Lake::class)->distinct('id');
    }

    public function rivers()
    {
        return $this->belongsToMany(River::class)->distinct('id');
    }
    public function slugs()
    {
        return $this->morphMany(Slug::class, 'slugable');
    }
}