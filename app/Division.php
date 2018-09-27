<?php

namespace App;

use App\BaseModel;
use App\Region;
use App\Paxdata;

class Division extends BaseModel
{
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function paxdata()
    {
        return $this->hasMany(Paxdata::class);
    }
}
