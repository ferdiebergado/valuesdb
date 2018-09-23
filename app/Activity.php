<?php

namespace App;

use App\Participant;
use App\BaseModel;

class Activity extends BaseModel
{
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
