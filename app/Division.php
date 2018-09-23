<?php

namespace App;

use App\BaseModel;
use App\Region;

class Division extends BaseModel
{
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
