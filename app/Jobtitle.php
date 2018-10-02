<?php

namespace App;

use App\BaseModel;
use App\Participant;

class Jobtitle extends BaseModel
{
    protected $fillable = [
        'name',
        'priority'
    ];

    public function participant()
    {
        return $this->hasMany(Participant::class);
    }
}
