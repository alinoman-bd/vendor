<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function replay()
    {
    	return $this->hasOne(CommentReplay::class); 
    }
}
