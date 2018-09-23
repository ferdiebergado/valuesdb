<?php

namespace App;

use App\Participant;
use App\Region;
use App\Division;
use App\Role;
use App\BaseModel;

class Paxdata extends BaseModel
{
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
