<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slugable;

class EntType extends Model
{
    use Slugable;
    protected $guarded = [];

    public function entCategory()
    {
    	return $this->belongsTo(EntCategory::class);
    }
}
