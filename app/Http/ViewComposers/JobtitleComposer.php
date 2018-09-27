<?php

namespace App\Http\ViewComposers;

use App\Jobtitle;
use \Illuminate\View\View;

class JobtitleComposer
{
    /**
     * The jobtitle model.
     *
     * @var Jobtitle
     */
    protected $jobtitles;

    /**
     * Create a new profile composer.
     *
     * @param  Jobtitle  $jobtitles
     * @return void
     */
    public function __construct(Jobtitle $jobtitles)
    {
        // Dependencies automatically resolved by service container...
        $this->jobtitles = $jobtitles;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('jobtitles', $this->jobtitles->orderBy('name')->get());
    }
}
