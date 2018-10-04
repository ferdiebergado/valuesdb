<?php

namespace App\Http\Controllers;

use App\ActivityParticipant;
use Illuminate\Http\Request;

class ActivityParticipantController extends Controller
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
            $participantid = $request->participantid;
            return ActivityParticipant::with(['activity' => function($q) {
                $q->orderBy('enddate', 'DESC');
            }, 'role'])->where('participant_id', $participantid)->get();
        }
        return ActivityParticipant::with(['activity', 'role'])->orderBy('enddate', 'DESC')->orderBy('id', 'DESC')->get();
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
     * @param  \App\ActivityParticipant  $activityParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityParticipant $activityParticipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActivityParticipant  $activityParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityParticipant $activityParticipant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActivityParticipant  $activityParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityParticipant $activityParticipant)
    {
        //
    }
}
