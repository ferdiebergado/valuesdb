<?php

namespace App\Http\ViewComposers;

use App\Participant;
use \Illuminate\View\View;
use App\Http\Controllers\ActivityController;

class CurrentEventPaxIdsComposer
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
        $cid = optional(ActivityController::getCurrent())->id;
        if ($cid) {
            $view->with('currentpaxids', $this->participants->whereHas('activities', function ($q) use ($cid) {
                $q->where('activity_id', $cid);
            })->pluck('id')->all());
        } else {
            $view->with('currentpaxids', null);
        }
    }
}
