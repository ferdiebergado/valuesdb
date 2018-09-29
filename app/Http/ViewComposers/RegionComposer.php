<?php

namespace App\Http\ViewComposers;

use App\Region;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;

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
        $regions = DB::table('regions_divisions')
            ->join('regions', 'regions.id', '=', 'regions_divisions.region_id')
            ->select('regions.*')
            ->where('year', config('app.year'))
            ->distinct()
            ->orderBy('regions.id')
            ->get();
        $view->with('regions', $regions);
    }
}
