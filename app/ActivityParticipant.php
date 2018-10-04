<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Participant;
use App\Activity;
use App\Role;

class ActivityParticipant extends Pivot
{
    public function participant() {
        return $this->belongsTo(Participant::class);
    }

    public function activity() {
        return $this->belongsTo(Activity::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
