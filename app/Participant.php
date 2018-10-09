<?php

namespace App;

use App\BaseModel;
use App\Activity;
use App\Jobtitle;
use App\Region;
use App\Division;
// use App\Helpers\DataViewer;

class Participant extends BaseModel
{
    // use DataViewer;

    // public static $columns = [
    //     'id',
    //     'lastname',
    //     'firstname',
    //     'middlename',
    //     'gender',
    //     'station',
    //     'mobile',
    //     'email',
    //     'birthday'
    // ];
    protected $fillable = [
        'title',
        'lastname',
        'firstname',
        'middlename',
        'gender',
        'jobtitle_id',
        'region_id',
        'division_id',
        'station',
        'landline',
        'mobile',
        'fax',
        'email',
        'facebookid',
        'birthday',
        'yearsAsTeacher',
        'yearsAsSupervisor',
        'yearsAsCoordinator',
        'photo'
    ];

    protected $searchable = [
        'id',
        'lastname',
        'firstname',
        'gender',
        'station',
        'mobile',
        'email',
    ];

    protected $appends = [
        'total_activities'
    ];

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucfirst($value);
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucfirst($value);
    }

    public function setMiddlenameAttribute($value)
    {
        $this->attributes['middlename'] = ucfirst($value);
    }

    public function getTotalActivitiesAttribute()
    {
        return $this->activities()->count();
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class)->withPivot('role_id')->using(ActivityParticipant::class)->withTimestamps();
    }

    public function jobtitle()
    {
        return $this->belongsTo(Jobtitle::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

}
