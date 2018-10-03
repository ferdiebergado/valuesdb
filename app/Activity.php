<?php

namespace App;

use App\Participant;
use App\BaseModel;
use App\Role;

class Activity extends BaseModel
{
    protected $fillable = [
        'participant_id',
        'activitytitle',
        'venue',
        'startdate',
        'enddate',
        'managedby',
        'role_id'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
