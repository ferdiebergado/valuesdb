<?php

namespace App;

use App\BaseModel;
use App\Division;

class Region extends BaseModel
{
    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}
