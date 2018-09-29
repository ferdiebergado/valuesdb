<?php

namespace App;

use App\BaseModel;
use App\Activity;
use App\Paxdata;

class Participant extends BaseModel
{
    protected $fillable = [
        'title',
        'lastname',
        'firstname',
        'middlename',
        'gender',
        'birthday',
        'yearsAsTeacher',
        'yearsAsSupervisor',
        'yearsAsCoordinator',
        'photo'
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function paxdata()
    {
        return $this->hasMany(Paxdata::class);
    }
}
