@extends('layouts.app')

@section('content')
<table id="activities-table" class="table-hover table-striped dataTable js-exportable"></table>
@endsection

@push('scripts')

@php
$url = route('activities.index');
@endphp

@component('components.datatablejs')

@slot('datatableid')
activities-table
@endslot

@slot('datatableroute')
{!! $url !!}
@endslot

@slot('datatablewith')
@endslot

@slot('ellipsiscol')
[1]
@endslot

@slot('columns')
{ name: 'id', title: 'ID', data: 'id', width: '5%' },
{ name: 'activitytitle', title: 'Title', data: 'activitytitle', width: '20%' },
{ name: 'venue', title: 'Venue', data: 'venue', width: '15%' },
{ name: 'startdate', title: 'Start Date', data: 'startdate', width: '10%' },
{ name: 'enddate', title: 'End Date', data: 'enddate', width: '10%' },
{ name: 'managedby', title: 'Managed By', data: 'managedby', width: '15%' },
{ name: 'totalpax', title: 'No. of Pax', data: 'totalpax', width: '5%' },
{ title: 'Task(s)', data: 'id', searchable: false, orderable: false, width: '25%' }
@endslot

{ targets: 0,
    render: function (data, type, row) {
        return `<span class=\ "badge badge-info\">${data}</span>`;
    }
},
{ targets: 6,
    render: function (data, type, row) {
        return `<span class=\ "badge badge-success\">${data}</span>`;
    }
},
{ targets: 7,
    render: function(data, type, row) {
        const btnclass = "btn btn-sm";
        const baseurl = "{!! $url !!}";
        let setcurrenturl = `<a class="${btnclass} btn-danger" href="${baseurl}/setascurrent/${data}" title="Set as Current Event"><i class="fa fa-thumbtack"></i></a> `;
        let viewurl = `<a class="${btnclass} btn-info" href="${baseurl}/participants/${data}" title="View"><i class="fa fa-eye"></i></a> `;
        let editurl = `<a class="${btnclass} btn-primary" href="${baseurl}/${data}/edit" title="Edit"><i class="fa fa-edit"></i></a> `;
        let delurl = `<form id="del-form-${data}" method="POST" action="${baseurl}/${data}" style="display: inline;">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <a href="#" class="${btnclass} btn-warning" title="Delete" onclick="if (confirm('Are your sure?')) { document.querySelector('#del-form-${data}').submit(); }"><i class="fa fa-trash-alt"></i></a>
        </form>`;
        return setcurrenturl + viewurl + editurl + delurl;
    },
    className: "text-center"
}

@section('boxtools')
<div class="row">
    <div class="col-3">
        <h3>Activities</h3>
    </div>
    <div class="col-9">
        <span><a class="btn btn-success float-right mr-3" href="{{ route('activities.create') }}"><i class="fa fa-plus-circle"></i> CREATE NEW</a></span>
        <span><a class="btn btn-danger float-right mr-3 {{ empty($currentevent) ? 'disabled' : '' }}" href="{{ route('activities.clearcurrent') }}"><i class="fa fa-calendar-times"></i> CLEAR CURRENT EVENT</a></span>   
        <span><a class="btn btn-info float-right mr-3" href="{{ route('participants.index') }}"><i class="fa fa-users"></i> PARTICIPANTS</a></span>                
        <span><a class="btn btn-default float-right mr-3" href="{{ route('search') }}"><i class="fa fa-search"></i> Back to Search</a></span>                
    </div>
</div>
@endsection

@slot('toolbar')
@endslot

@endcomponent

@endpush
