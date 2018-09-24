@extends('layouts.app')

@section('content')

<form class="form-horizontal" method="POST" action="{{ route('participants.search') }}">
    @csrf
    <div class="input-group">
        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Type a Lastname and then press Enter or click Search." aria-describedby="lastnameHelp" required autofocus>
        <div class="input-group-append">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> SEARCH</button>
        </div>
    </div>
</form>
    
@endsection
