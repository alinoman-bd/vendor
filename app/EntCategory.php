<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slugable;

class EntCategory extends Model
{
	use Slugable;
    protected $guarded = [];

    public function ent_types()
    {
        return $this->hasMany(EntType::class);
    }

}
