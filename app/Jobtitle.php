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

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
