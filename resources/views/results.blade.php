@extends('layouts.app')

@section('content')

@if (count($participants) >= 1)
<p><h3>Search Results</h3></p>
<table class="table">
    <thead>
        <tr>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Gender</th>
            <th>Designation</th>
            <th>Mobile No.</th>
            <th>Email</th>
            <th>Tasks</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($participants as $pax)
        <tr>
            <td scope="row">{{ $pax->lastname }}</td>
            <td>{{ $pax->firstname }}</td>
            <td>{{ $pax->gender }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td><a href="{{ route('participants.edit', ['participant' => $pax->id]) }}"><i class="fa fa-edit"></i> Update</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $participants->links() }}

@else

<p>No records found.</p>

@endif

<a class="btn" href="{{ route('search') }}">Search again</a>
<a class="btn btn-success float-right" href="{{ route('participants.create') }}"><i class="fa fa-plus"></i> CREATE NEW</a>
</div>

@endsection
