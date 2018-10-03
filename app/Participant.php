<?php

namespace App;

use App\BaseModel;
use App\Activity;
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

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function jobtitle() {
        return $this->belongsTo(Jobtitle::class);
    }
}
