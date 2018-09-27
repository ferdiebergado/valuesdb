<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Participant;

class Jobtitle extends Model
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
