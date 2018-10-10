<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'paxform',
            'App\Http\ViewComposers\JobtitleComposer'
        );
        View::composer(
            ['layouts.app', 'activities'],
            'App\Http\ViewComposers\CurrentEventComposer'
        );
        View::composer(
            'search',
            'App\Http\ViewComposers\CurrentEventPaxComposer'
        );
        // View::composer(
        //     'paxform',
        //     'App\Http\ViewComposers\CurrentEventPaxIdsComposer'
        // );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
