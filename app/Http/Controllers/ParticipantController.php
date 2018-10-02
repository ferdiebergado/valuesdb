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

class ParticipantController extends Controller
{
    use RequestParser;

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
        // $this->pushCriteria(app('\Modules\Documents\Criteria\DocumentRequestCriteria'));
        // $this->repository->with(['doctype', 'creator'])->getByOffice(auth()->user()->office_id);
        // Sort fields based on request orderBy (nested sorting)
        // $this->repository->pushCriteria(new MultiSortCriteria($request));
        $participants = Participant::orderBy('lastname')->paginate($perPage);
        // $documents = $this->repository->paginate($perPage);
        // $documents = $this->sortFields($request, $model)->paginate($perPage);
        if (request()->wantsJson()) {
            return response()->json([
                'draw' => $request->draw,
                'data' => $participants,
            ]);
        }

        return view('participants_index', compact('participants'));
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
        $participant = Participant::create($request->all());
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
        $participant = Participant::with('jobtitle')->findOrFail($participant->id);
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
        if ($participant->update($request->all())) {
            $request->session()->flash('status', 'Participant profile updated.');
            return redirect()->route('participants.index');
        }
        return back()->withErrors('Update failed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'lastname' => 'required|string|min:2|max:150'
        ]);
        $search = "%" . $request->lastname . "%";
        $participants = Participant::where('lastname', 'LIKE', $search)->orderBy('lastname')->paginate(10);
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

}
