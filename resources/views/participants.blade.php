@extends('layouts.app')

@section('content')

@isset($activityofpax)
<div class="row">
    <div class="col-12">
        <h4>{{ $activityofpax->activitytitle }}</h4>
        <h5>{{ $activityofpax->venue }} <small>{{ $activityofpax->startdate }} {{$activityofpax->enddate}}</small></h5>
    </div>    
</div>
<hr mb-5>
@endisset

{{-- <data-viewer source="/values/api/participants" title="Participant Data" /> --}}
<table id="participants-table" class="table-hover table-striped dataTable js-exportable"></table>

@endsection

@push('scripts')

@php
$url = route($route, $params ?? array())
@endphp

@component('components.datatablejs')

@slot('datatableid')
participants-table
@endslot

@slot('datatableroute')
{!! $url !!}
@endslot

@slot('datatablewith')
{{-- jobtitle,region,division --}}
@endslot

@slot('ellipsiscol')
[1, 2]
@endslot

@slot('columns')
{ name: 'id', title: 'ID', data: 'id', width: '5%' },
{ name: 'lastname', title: 'Lastname', data: 'lastname', width: '15%' },
{ name: 'firstname', title: 'Firstname', data: 'firstname', width: '15%' },
{ name: 'gender', title: 'Sex', data: 'gender', width: '2%' },
{ name: 'station', title: 'Office/School', data: 'station', width: '20%' },
{ name: 'mobile', title: 'Mobile', data: 'mobile', width: '10%' },
{ name: 'email', title: 'Email', data: 'email', width: '15%' },
{ name: 'total_activities', title: 'No. of Activities', data: 'total_activities', width: '5%' },
{ title: 'Task(s)', data: 'id', searchable: false, orderable: false, width: '10%' }
@endslot

{ targets: 0,
    render: function (data, type, row) {
        return `<span class=\"badge badge-info\">${data}</span>`;
    }
},

{ targets: 7,
    render: function (data, type, row) {
        return `<span class=\"badge badge-success text-center\">${data}</span>`;
    }
},

{ targets: 8,
    render: function(data, type, row) {
        const btnclass = "btn btn-sm btn-flat";
        const baseurl = "/values/participants";
        let editurl = `<a class="${btnclass} btn-primary" href="${baseurl}/${data}/edit" title="Edit"><i class="fa fa-edit"></i></a> `;
        let delurl = `<form id="del-form-${data}" method="POST" action="${baseurl}/${data}" style="display: inline;">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <a href="#" class="${btnclass} btn-warning" title="Delete" onclick="if (confirm('Are your sure?')) { document.querySelector('#del-form-${data}').submit(); }"><i class="fa fa-trash-alt"></i></a>
        </form>`;
        return editurl + delurl;
    },
    className: "text-center"
}

@section('boxtools')
<div class="row">
    <div class="col-4">
        <h3>Participants</h3>
    </div>
    <div class="col-8">
        <span><a class="btn btn-sm btn-success float-right" href="{{ route('participants.create') }}"><i class="fa fa-user-plus"></i> CREATE NEW</a></span>
        <span><a class="btn btn-sm btn-info float-right mr-3" href="{{ route('activities.index') }}"><i class="fa fa-list"></i> ACTIVITIES</a></span>                
        <span><a class="btn btn-sm btn-default float-right mr-3" href="{{ route('search') }}"><i class="fa fa-search"></i> Back to Search</a></span>          
    </div>
</div>
@endsection

@slot('toolbar')
@endslot

@endcomponent

@endpush
