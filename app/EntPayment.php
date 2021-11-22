<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntPayment extends Model
{
    public function entertainment()
    {
    	return $this->belongsTo(Entertainment::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
