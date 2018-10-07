<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Participant;
use Illuminate\Http\Request;
use App\Helpers\RequestParser;
use App\Helpers\RequestCriteria;

class ActivityController extends Controller
{
    use RequestParser;
    use RequestCriteria;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = app()->make('request');
        $this->validate($request, [
            'length' => [
                'integer',
                \Illuminate\Validation\Rule::in(config('app.perPageRange'))
            ],
            'sortBy' => 'string|nullable',
            'orderByMulti' => 'string|nullable'
        ]);
        if ($request->wantsJson()) {
            if ($request->has('length')) {
                $perPage = $this->getRequestLength($request);
                $a = $this->apply(app()->make('App\Activity'), $request);
                $a = $a->paginate($perPage);
                return response()->json([
                    'draw' => $request->draw,
                    'data' => $a
                ]);
            }
            $a = Activity::orderBy('enddate', 'DESC')->get();
            if ($request->filled('participantid')) {
                $participant = Participant::with('activities')->where('id', $request->participantid)->first();
                $activities = $participant->activities->pluck('id');
                $a = Activity::whereNotIn('id', $activities)->orderBy('enddate', 'DESC')->get();
            }
            return $a;
        }
        return view('activities', compact('a'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activity = new Activity;
        $method = 'POST';
        $route = route('activities.store');
        return view('aform', compact('method', 'route', 'activity'));
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
        return redirect()->route('activities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        $route = 'participants.byactivity';
        return view('participants_index', compact('activity', 'route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $method = 'POST';
        $route = route('activities.update', ['activity' => $activity]);
        $activity = Activity::findOrFail($activity->id);
        return view('aform', compact('method', 'route', 'activity'));
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
        $this->validate($request, [
            'activitytitle' => 'required|string',
            'venue' => 'required|string',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'managedby' => 'string',
        ]);

        if ($activity->update($request->all())) {
            $request->session()->flash('status', 'Activity updated.');
        }
        return redirect()->route('activities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        if ($activity->delete()) {
            session()->flash('status', 'Activity deleted.');
        }
        return redirect()->back();
    }
}
