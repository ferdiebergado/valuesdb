<?php

namespace App\Http\ViewComposers;

use App\Participant;
use \Illuminate\View\View;
use App\Http\Controllers\ActivityController;

class CurrentEventPaxComposer
{
    /**
     * The participant model.
     *
     * @var Participant
     */
    protected $participants;

    /**
     * Create a new current event participants composer.
     *
     * @param  Participant  $participants
     * @return void
     */
    public function __construct(Participant $participants)
    {
        // Dependencies automatically resolved by service container...
        $this->participants = $participants;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cid = ActivityController::getCurrent()->id;
        $view->with('currentpax', $this->participants->with(['jobtitle', 'region', 'division', 'activities'])->whereHas('activities', function ($q) use ($cid) {
            $q->where('activity_id', $cid);
        })->orderBy('lastname')->get());
    }
}
