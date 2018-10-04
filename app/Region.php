<?php

namespace App;

use App\BaseModel;
use App\Participant;
use App\Division;

class Region extends BaseModel
{
    public function participants() {
        return $this->hasMany(Participant::class);
    }

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}
