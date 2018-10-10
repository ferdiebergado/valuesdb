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

@php
$totalpax = optional($currentpax)->total();
@endphp

@if ($totalpax >= 1)
<br><br>
<div class="container">
  <div class="row">    
    <div class="col-12">
      <h3 class="text-white">{{ $totalpax }} Registered Participants</h3>
    </div>
  </div>

  @php
  $i = 1 + ($currentpax->perPage() * ($currentpax->currentPage() - 1));
  @endphp

  @foreach ($currentpax as $pax)
  <div class="card-deck mt-3">
    <div class="card">
      <div class="card-body">
        <div class="row">        
          <div class="col-3">
            <img class="card-img-top" src="{{ asset('storage/avatars/' . $pax->photo) }}" width="72px" height="72px" alt="Card image cap">
          </div>
          <div class="col-9">
            <h6 class="card-title"><strong>{{ $pax->lastname . ', ' . $pax->firstname . ' ' . $pax->middlename }}</strong></h6>
            <h6 class="card-text">{{ optional($pax->jobtitle)->name }}</h6>
            <p class="card-text">{{ optional($pax->division)->name }}, Region {{ optional($pax->region)->name }}</p>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-3">
            <span class="badge badge-info float-left">{{ $i }}</span></h3>
          </div>
          <div class="col-9">
            <small class="text-muted float-right">Registered {{ $pax->updated_at->diffForHumans() }}</small>
          </div>          
        </div>               
      </div>
    </div>
  </div>
  @php
  $i++
  @endphp
  @endforeach
  <div class="row mt-5 float-right">
    <div class="col-12">
      {!! $currentpax->links() !!}    
    </div>
  </div>
</div>    
@endif

@endsection
