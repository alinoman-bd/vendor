<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slugable;
class Entertainment extends Model
{
    use Slugable;
    public function EntTypes()
    {
        return $this->belongsToMany(EntType::class);
    }
    public function city()
    { 
    	return $this->belongsTo(City::class);
    }
    public function location()
    {
    	return $this->belongsTo(Location::class);
    }
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
    public function EntertainmentImages()
    {
        return $this->hasMany(EntertainmentImage::class)->orderBy('id','DESC');
    }
    public function recourceImage()
    {
        return $this->hasMany(EntertainmentImage::class)->orderBy('id','DESC');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function searches()
    {
        return $this->morphToMany(Search::class, 'searchable');
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    
    public function scopeEntertainmentByType($q, $id)
    {
        return $q->whereHas('EntTypes' , function($que) use($id){
           return $que->where('ent_type_id', $id);
        });
    }
    public function scopeEntertainmentByCategory($q, $id)
    {
        return $q->whereHas('EntTypes.entCategory' , function($que) use($id){
           return $que->where('id', $id);
        });
    }
    public function videos()
    {
        return $this->hasMany(EntVideo::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'rec_ent_id','id')->where('status',2)->orderBy('id','DESC');
    }
}
