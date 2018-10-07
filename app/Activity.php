<?php

namespace App;

use App\BaseModel;
use App\Participant;
use App\ActivityParticipant;

class Activity extends BaseModel
{
    protected $fillable = [
        'activitytitle',
        'venue',
        'startdate',
        'enddate',
        'managedby'
    ];

    protected $searchable = [
        'activitytitle',
        'venue',
        'managedby'
    ];

    protected $appends = [
        'totalpax'
    ];

    public function participants()
    {
        return $this->belongsToMany(Participant::class)->withPivot('role_id')->using(ActivityParticipant::class);
    }

    public function getTotalpaxAttribute() {
        return $this->participants()->count();
    }
}
