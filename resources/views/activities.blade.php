@extends('layouts.app')

@section('content')
<table id="activities-table" class="table-hover table-striped dataTable js-exportable"></table>
@endsection

@push('scripts')

@php
$url = route('activities.index')
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
{ name: 'activitytitle', title: 'Title', data: 'activitytitle', width: '25%' },
{ name: 'venue', title: 'Venue', data: 'venue', width: '15%' },
{ name: 'startdate', title: 'Start Date', data: 'startdate', width: '15%' },
{ name: 'enddate', title: 'End Date', data: 'enddate', width: '15%' },
{ name: 'managedby', title: 'Managed By', data: 'managedby', width: '15%' },
{ title: 'Task(s)', data: 'id', searchable: false, orderable: false, width: '10%' }
@endslot

{ targets: 0,
    render: function (data, type, row) {
    return `<span class=\ "label bg-gray\">${data}</span>`;
}
},

{ targets: 6,
    render: function(data, type, row) {
    const btnclass = "btn btn-sm btn-flat";
    const baseurl = "{!! $url !!}";
    let editurl = `<a class="${btnclass} btn-primary" href="${baseurl}/${data}/edit" title="{{ __('Edit') }}"><i class="fa fa-edit"></i></a> `;
    let delurl = `<form id="del-form-${data}" method="POST" action="${baseurl}/${data}" style="display: inline;">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <a href="#" class="${btnclass} btn-warning" title="{{ __('messages.delete') }}" onclick="if (confirm('Are your sure?')) { document.querySelector('#del-form-${data}').submit(); }"><i class="fa fa-trash"></i></a>
    </form>`;
    return editurl + delurl;
},
className: "text-center"
}

@section('boxtools')
<div class="row">
    <div class="col-4">
        <h3>Activities</h3>
    </div>
    <div class="col-8">
        <span><a class="btn btn-sm btn-success float-right" href="{{ route('activities.create') }}"><i class="fa fa-plus"></i> CREATE NEW</a></span>
    </div>
</div>
@endsection

@slot('toolbar')
@endslot

@endcomponent

@endpush
