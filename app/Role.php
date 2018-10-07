<?php

namespace App;

use App\BaseModel;
use App\Activity;
use App\ActivityParticipant;

class Role extends BaseModel
{
    protected $fillable = [
        'name',
        'priority'
    ];

    public function activities() {
        return $this->hasMany(Activity::class);
    }

    public function activity_participants() {
        return $this->hasMany(ActivityParticipant::class);
    }
}
