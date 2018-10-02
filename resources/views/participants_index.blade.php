@extends('layouts.app')

@section('content')

{{-- <data-viewer source="/values/api/participants" title="Participant Data" /> --}}
<table id="participants-table" class="table-hover table-striped dataTable js-exportable"></table>

@endsection

@push('scripts')

@php
$url = route('participants.index')
@endphp

@component('components.datatablejs')

@slot('datatableid')
participants-table
@endslot

@slot('datatableroute')
{!! $url !!}
@endslot

@slot('datatablewith')

@endslot

@slot('ellipsiscol')
[1, 2]
@endslot

@slot('columns')
{ name: 'id', title: 'ID', data: 'id', width: '5%' },
{ name: 'lastname', title: 'Lastname', data: 'lastname', width: '25%' },
{ name: 'firstname', title: 'Firstname', data: 'firstname', width: '20%' },
{ name: 'gender', title: 'Sex', data: 'gender', width: '5%' },
{ title: 'Task(s)', data: 'id', searchable: false, orderable: false, width: '15%' }
@endslot

{ targets: 0,
    render: function (data, type, row) {
        return `<span class=\ "label bg-gray\">${data}</span>`;
    }
},

{ targets: 4,
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

<a class="btn btn-success float-right" href="{{ route('participants.create') }}"><i class="fa fa-plus"></i> CREATE NEW</a>

@endsection

@slot('toolbar')
@endslot

@endcomponent

@endpush
