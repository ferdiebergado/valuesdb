<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Participant;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = app()->make('request');
        if ($request->filled('participantid')) {
            $participant = Participant::with('activities')->where('id', $request->participantid)->first();
            $activities = $participant->activities->pluck('id');
            return Activity::whereNotIn('id', $activities)->orderBy('enddate', 'DESC')->orderBy('id', 'DESC')->get();
        }
        return Activity::orderBy('enddate', 'DESC')->orderBy('id', 'DESC')->get();
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
        $this->validate($request, [
            'activitytitle' => 'required|string',
            'venue' => 'required|string',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'managedby' => 'string',
        ]);
        $activity = Activity::create($request->all());
        if ($activity) {
            if ($request->wantsJson()) {
                return response()->json([
                    'data' => $activity
                ]);
            }
            $request->session()->flash('status', 'Activity saved.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }


}
