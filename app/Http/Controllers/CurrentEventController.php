<?php

namespace App\Http\Controllers;

use App\CurrentEvent;
use Illuminate\Http\Request;
use App\Activity;

class CurrentEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CurrentEvent  $currentEvent
     * @return \Illuminate\Http\Response
     */
    public function show(CurrentEvent $currentEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CurrentEvent  $currentEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(CurrentEvent $currentEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CurrentEvent  $currentEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        if (CurrentEvent::firstOrFail()->update(['id' => $activity->id])) {
            $request->session()->flash('status', 'Current event updated.');
        }
        return redirect()->route('activities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CurrentEvent  $currentEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurrentEvent $currentEvent)
    {
        //
    }

    public static function current() {
        return Activity::findOrFail(CurrentEvent::firstOrFail()->id);
    }
}
