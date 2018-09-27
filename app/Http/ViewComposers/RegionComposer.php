<?php

namespace App\Http\ViewComposers;

use App\Region;
use \Illuminate\View\View;

class RegionComposer
{
    /**
     * The Region model.
     *
     * @var Region
     */
    protected $regions;

    /**
     * Create a new profile composer.
     *
     * @param  Region  $regions
     * @return void
     */
    public function __construct(Region $regions)
    {
        // Dependencies automatically resolved by service container...
        $this->regions = $regions;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('regions', $this->regions->orderBy('id')->get());
    }
}
