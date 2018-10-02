<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RegionDivisionController extends Controller
{
    public function index() {
        return Cache::remember('regions_divisions_' . config('app.year'), 60, function() {
            return DB::table('regions_divisions')
            ->join('regions', 'regions.id', '=', 'regions_divisions.region_id')
            ->select('regions.*')
            ->where('year', config('app.year'))
            ->distinct()
            ->orderBy('regions.id')
            ->get();
        });
    }
}
