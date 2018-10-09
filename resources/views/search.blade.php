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

@if (count($currentpax) >= 1)
<br><br>
<div class="container">
  <h3 class="text-white mt-6">Registered Participants</h3>
  
  @foreach ($currentpax as $pax)
  
  <div class="card-deck mt-3">
    <div class="card">
      <div class="card-body">
        <div class="row">        
          <div class="col-3">
            <img class="card-img-top" src="{{ asset('storage/avatars/' . $pax->photo) }}" width="96px" height="96px" alt="Card image cap">
          </div>
          <div class="col-9">
            <h5 class="card-title">{{ $pax->lastname . ', ' . $pax->firstname . ' ' . $pax->middlename }}</h5>
            <h6 class="card-text">{{ $pax->jobtitle->name }}</h6>
            <p><small class="card-text">{{ $pax->division->name }}, Region {{ $pax->region->name }}</small></p>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <small class="text-muted float-right">Registered {{ $pax->updated_at->diffForHumans() }}</small>
      </div>
    </div>
  </div>
  @endforeach
</div>    
@endif

@endsection
