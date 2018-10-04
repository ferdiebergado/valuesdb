<?php

namespace App;

use App\BaseModel;
use App\Region;
use App\Participant;

class Division extends BaseModel
{
    public function participants() {
        return $this->hasMany(Participant::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
