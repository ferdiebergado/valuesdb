<?php

namespace App\Http\ViewComposers;

use App\Activity;
use \Illuminate\View\View;
use App\Http\Controllers\ActivityController;

class CurrentEventComposer
{
    /**
     * The jobtitle model.
     *
     * @var Jobtitle
     */
    protected $activities;

    /**
     * Create a new profile composer.
     *
     * @param  Activity  $activities
     * @return void
     */
    public function __construct(Activity $activities)
    {
        // Dependencies automatically resolved by service container...
        $this->activities = $activities;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('currentevent', ActivityController::getCurrent());
    }
}
