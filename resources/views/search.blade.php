@extends('layouts.app')

@section('content')

{{-- <div class="card-title">
    <h4>Search</h4>
</div>   --}}

<form class="form-horizontal" method="POST" action="{{ route('participants.search') }}">
    @csrf
    <div class="input-group">
        {{-- <label for="lastname">Enter Lastname</label> --}}
        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Type a Lastname and then press Enter or click Search." aria-describedby="lastnameHelp" required autofocus>
        <div class="input-group-append">
            {{-- <span class="input-group-text"><i class="fa fa-search"></i>Search</span> --}}
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> SEARCH</button>
        </div>
        {{-- <small id="lastnameHelp" class="text-muted">Type a lastname to search.</small> --}}
    </div>
</form>
    
@endsection
