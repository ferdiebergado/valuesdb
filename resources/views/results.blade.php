@extends('layouts.app')

@section('content')

@if (count($participants) >= 1)
<div class="table-responsive">
    <table class="table table-condensed table-hover table-striped">
        <thead>
            <tr>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Gender</th>
                <th>Job Title</th>
                <th>Region</th>
                <th>Division</th>
                <th>Station</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Task(s)</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($participants as $pax)
            <tr>
                <td scope="row">{{ $pax->lastname }}</td>
                <td>{{ $pax->firstname }}</td>
                <td>{{ $pax->gender }}</td>
                <td>{{ optional($pax->jobtitle)->name }}</td>
                <td>{{ optional($pax->region)->name }}</td>
                <td>{{ optional($pax->division)->name }}</td>
                <td>{{ $pax->station }}</td>
                <td>{{ $pax->mobile }}</td>
                <td>{{ $pax->email }}</td>
                <td><a href="{{ route('participants.edit', ['participant' => $pax->id]) }}"><i class="fa fa-edit"></i> Update</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $participants->links() }}
</div>

@else

<div class="row">
    <div class="col-12">
        <p>No records found.</p>
    </div>
</div>

@endif

<a class="btn" href="{{ route('search') }}">Search again</a>

</div>

@endsection

@section('boxtools')
<div><span class="float-left"><h3>Search Results &nbsp;&nbsp;</h3></span><span class="float-right"><a class="btn btn-success" href="{{ route('participants.create') }}"><i class="fa fa-user-plus"></i> CREATE NEW</a></span></div>
@endsection
