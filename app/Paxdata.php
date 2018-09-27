<?php

namespace App;

use App\Participant;
use App\Region;
use App\Division;
use App\Role;
use App\BaseModel;
use App\Jobtitle;

class Paxdata extends BaseModel
{
    protected $fillable = [
        'jobtitle_id',
        'region_id',
        'division_id',
        'station',
        'landline',
        'mobile',
        'fax',
        'email',
        'facebookid',
        'year'
    ];

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

    public function jobtitle()
    {
        return $this->belongsTo(Jobtitle::class);
    }
}
