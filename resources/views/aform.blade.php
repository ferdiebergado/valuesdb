@extends('layouts.app')

@section('content')

<form method="{{ $method }}" action="{{ $route }}">
    @csrf

    @if (Route::is('activities.edit'))
    {{ method_field('PUT') }}
    @endif

    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label>ID &nbsp;<span class="badge badge-info">{{ $activity->id ?? '(New)' }}</span></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="activitytitle">Title</label>
                <textarea name="activitytitle" id="activitytitle" class="form-control" placeholder="Title" rows="5" required>{{ old('activitytitle', optional($activity)->activitytitle) }}</textarea>
                @if ($errors->has('activitytitle'))
                <small class="form-text text-danger">{{ $errors->activitytitle }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="venue">Venue</label>
                <textarea name="venue" id="venue" class="form-control" placeholder="Venue" rows="2" required>{{ old('venue') ?? $activity->venue}}</textarea>
                @if ($errors->has('venue'))
                <small class="form-text text-danger">{{ $errors->venue }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="startdate">Start Date:</label>
                <input type="date" name="startdate" id="startdate" class="form-control" placeholder="Start Date" value="{{ old('startdate', optional($activity)->startdate) }}" required>
                @if ($errors->has('startdate'))
                <small class="form-text text-danger">{{ $errors->startdate }}</small>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="enddate">End Date</label>
                <input type="date" name="enddate" id="enddate" class="form-control" placeholder="End Date" value="{{ old('enddate', optional($activity)->enddate) }}" required>
                @if ($errors->has('enddate'))
                <small class="form-text text-danger">{{ $errors->enddate }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">Managed By</label>
                <input type="text" name="managedby" id="managedby" class="form-control" placeholder="Managed By" value="{{ old('managedby') ?? $activity->managedby}}">
                @if ($errors->has('managedby'))
                <small class="form-text text-danger">{{ $errors->managedby }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="form-group">
                <span class="float-right">
                    <a class="btn" href="javascript:void();" onclick="window.history.back();">Back</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SAVE</button>
                </span>
            </div>
        </div>
    </div>
</div>
</form>

@endsection

@section('boxtools')
    <h3>{{ Route::is('*.create') ? 'New' : 'Edit' }} Activity</h3>
@endsection

@push('scripts')
<script type="text/javascript">
    flatpickrhtml('#startdate', {allowInput: true});
    flatpickrhtml('#enddate', {allowInput: true});
</script>
@endpush
