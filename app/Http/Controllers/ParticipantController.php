<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $participant = new Participant();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        $method = "PUT";
        $route = route('participants.update', ['participant' => $participant]);
        return view('paxform', compact('participant', 'method', 'route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
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
        //
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
        $search = $this->validate($request, [
            'lastname' => 'required|string|min:2|max:150'
        ]);

        $search = "%" . $search['lastname'] . "%";

        $participants = Participant::where('lastname', 'LIKE', $search)->orderBy('lastname')->get();

        return view('participants', compact('participants'));
    }

    public function avatar(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'avatar' => 'required|file|image|mimes:jpeg,jpg,png|max:512'
            ]);
            // $file = $request->file('avatar')->store('/', 'avatars');
            $file = Storage::disk('avatars')->putFile('/', $request->file('avatar'));
            $avatar = $this->repository->find($id, ['avatar']);
            if (!empty($avatar)) {
                Storage::disk('avatars')->delete($avatar);
            }
            $user = $this->repository->update(['avatar' => $file], $id);
            // Cache::forget('user_by_id'.$id);
            Cache::forget('avatar_user_' . $id);
            $message = 'Avatar changed.';
            if (request()->wantsJson()) {
                return response()->json([
                    'message' => $message,
                    'user' => $user,
                ]);
            }
            return redirect()->back()->with(compact('message'));
        } catch (ValidationException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->errors()
                ]);
            }
            return redirect()->back()->withErrors($e->errors());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
