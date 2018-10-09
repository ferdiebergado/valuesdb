<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\RequestParser;
use \Exception;
use App\Paxdata;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Helpers\RequestCriteria;
use App\Activity;

class ParticipantController extends Controller
{
    use RequestParser;
    use RequestCriteria;

    public function __construct()
    {
        // $this->middleware(['auth'])->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        $perPage = $this->getRequestLength($request);
        $participants = $this->apply(app()->make('App\Participant'), $request);
        $participants = $participants->with('activities')->paginate($perPage);
        if (request()->wantsJson()) {
            return response()->json([
                'draw' => $request->draw,
                'data' => $participants,
            ]);
        }
        $route = 'participants.index';
        return view('participants', compact('participants', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $participant = new Participant;
        $method = "POST";
        $route = route('participants.store');
        return view('paxform', compact('participant', 'method', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // foreach($request->activity as $activity) {
        //     $obj = json_decode($activity);
        //     $a = collect($obj->activity);
        //     dd($a->all());
        //     dd(array_keys($a));
        //     dd(extract($obj->activity));
        //     dd(array_merge($a, ['role_id' => $obj->role->id]));
        // }
        $this->validate($request, [
            'title' => [
                'required',
                'string',
                Rule::in(['Mr.', 'Ms.', 'Mrs.', 'Dr.', 'Prof.'])
            ],
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'middlename' => 'string|nullable',
            'gender' => [
                'required',
                Rule::in(['M', 'F', 'O'])
            ],
            'birthday' => 'date',
            'yearsAsTeacher' => 'integer|nullable',
            'yearsAsSupervisor' => 'integer|nullable',
            'yearsAsCoordinator' => 'integer|nullable',
            'photo' => 'string|nullable',
            'jobtitle_id' => 'integer|nullable',
            'region_id' => 'integer|nullable',
            'division_id' => 'integer|nullable',
            'station' => 'required|string',
            'landline' => 'string|nullable',
            'mobile' => 'required|string',
            'fax' => 'string|nullable',
            'email' => 'email|nullable',
            'facebookid' => 'string|nullable'
        ]);
        DB::beginTransaction();
        try {
            $participant = Participant::create($request->all());
            if ($request->filled('activity')) {
                foreach ($request->activity as $activity) {
                    $obj = json_decode($activity);
                    $activity = Activity::create(collect($obj->activity)->except('id')->all());
                    $participant->activities()->attach($activity, ['role_id' => $obj->role->id]);
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
        DB::commit();
        $request->session()->flash('status', 'New participant saved.');
        return redirect()->route('search');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        $method = "POST";
        $route = route('participants.update', ['participant' => $participant]);
        $participant = Participant::with(['jobtitle', 'activities'])->findOrFail($participant->id);
        return view('paxform', compact('participant', 'method', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        DB::beginTransaction();
        try {
            if ($participant->update($request->all())) {
                if ($request->filled('activities')) {
                    foreach ($request->activities as $a) {
                        $o = json_decode($a);
                        $participant->activities()->attach(Activity::findOrFail($o->activity->id), ['role_id' => $o->activity->role]);
                    }
                }
            }
        } catch(Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
        DB::commit();
        $request->session()->flash('status', 'Participant profile updated.');
        return redirect()->route('search');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        if ($participant->delete()) {
            session()->flash('status', 'Participant deleted.');
            return back();
        }
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'lastname' => 'required|string|min:2|max:150'
        ]);
        $search = "%" . $request->lastname . "%";
        $participants = Participant::with(['jobtitle', 'region', 'division'])->where('lastname', 'LIKE', $search)->orderBy('lastname')->paginate(10);
        return view('results', compact('participants'));
    }

    public function avatar(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|image|mimes:jpeg,jpg,png|max:512'
        ]);
        // $filename = $request->file('file')->store('/', 'avatars');
        $filename = Storage::disk('public')->putFile('/avatars', $request->file('file'));
        return response()->json(['fileid' => $filename]);
    }

    public function getData()
    {
        $model = Participant::searchPaginateAndOrder();
        $columns = Participant::$columns;

        return response()
        ->json([
            'model' => $model,
            'columns' => $columns
        ]);
    }

    public function byActivity(Request $request, Activity $activity)
    {
        // dd($activity);
        $request = app()->make('request');
        $this->validate($request, [
            'length' => [
                'integer',
                \Illuminate\Validation\Rule::in(config('app.perPageRange'))
            ],
            'sortBy' => 'string|nullable',
            'orderByMulti' => 'string|nullable'
        ]);
        $perPage = $this->getRequestLength($request);
        $participants = $this->apply(app()->make('App\Participant'), $request);
        $participants = $participants->whereHas('activities', function($q) use($activity) {
            $q->where('activity_id', $activity->id);
        })->paginate($perPage);
        if (request()->wantsJson()) {
            return response()->json([
                'draw' => $request->draw,
                'data' => $participants,
            ]);
        }
        $route = 'participants.byactivity';
        $params = ['activity' => $activity];
        $activityofpax = $activity;
        return view('participants', compact('route', 'params', 'activityofpax'));
    }
}
