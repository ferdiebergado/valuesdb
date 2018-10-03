<?php

namespace App;

use App\BaseModel;
use App\Activity;

class Role extends BaseModel
{
    public function activities() {
        return $this->hasMany(Activity::class);
    }
}
