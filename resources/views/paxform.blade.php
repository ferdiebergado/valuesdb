@extends('layouts.app')

@section('content')

<form method="{{ $method }}" action="{{ $route }}">
    @csrf
    
    <div class="card-title">
        <h3>Participant Profile</h3>
        <hr>
    </div>
    
    @if (Route::is('participants.edit'))
    
    {{ method_field('PUT') }}
    
    <div class="row">
        <div class="col-8">
            <h4>{{ ucfirst($participant->lastname) }}, {{ ucfirst($participant->firstname) }} {{ ucfirst($participant->middlename) }}</h4>
            <h6>{{ optional($participant->jobtitle)->name }}</h6>
            <h6>{{ $participant->station }}</h6>
        </div>
        <div class="col-4">
            <img src="{{ asset('storage/avatars/' . $participant->photo ?? 'default.png') }}" alt="avatar" height="160" width="160">
        </div>
    </div>
    <hr>
    @endif
    
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label>ID &nbsp;<span class="badge badge-info">{{ $participant->id ?? '(New)' }}</span></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="">Title</label>
                <select class="form-control" name="title" id="title" required autofocus>
                    @php
                    $titles = ['Mr.', 'Ms.', 'Mrs.', 'Dr.', 'Prof.'];
                    @endphp
                    <option value="">Select</option>
                    @foreach ($titles as $title)
                    <option value="{{ $title }}" {{ $title === old('title') ? 'selected' : ($title === optional($participant)->title) ? 'selected' : '' }}>{{ $title }}</option>
                    @endforeach
                </select>
                @if ($errors->has('title'))
                <small class="form-text text-danger">{{ $errors->first('title') }}</small>
                @endif
            </div>
        </div>
        <div class="col-9">
            <div class="form-group">
                <label for="">Lastname</label>
                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" aria-describedby="helpLastname" value="{{ old('lastname', optional($participant)->lastname) }}" required>
                @if ($errors->has('lastname'))
                <small class="form-text text-danger">{{ $errors->first('lastname') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Firstname</label>
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" aria-describedby="helpFirstname" value="{{ old('firstname') ?? $participant->firstname}}" required>
                @if ($errors->has('firstname'))
                <small class="form-text text-danger">{{ $errors->first('firstname') }}</small>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Middle Name</label>
                <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Middle Name" aria-describedby="helpMiddlename" value="{{ old('middlename') ?? $participant->middlename}}">
                @if ($errors->has('middlename'))
                <small class="form-text text-danger">{{ $errors->first('middlename') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="">Sex</label>
                @php
                $genders = [
                'M' => 'Male',
                'F' => 'Female',
                'O' => 'Other'
                ]
                @endphp
                <select class="form-control" name="gender" id="gender" required>
                    <option value="">Select</option>
                    @foreach ($genders as $key => $value)
                    <option value="{{ $key }}" {{ $key === old('gender') ? 'selected' : ($key === optional($participant)->gender) ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('gender'))
                <small class="form-text text-danger">{{ $errors->first('gender') }}</small>
                @endif
            </div>
        </div>
        <div class="col-9">
            <div class="form-group">
                <label for="">Job Title</label>
                <select class="form-control" name="jobtitle_id" id="jobtitle_id">
                    <option value="">Select Jobtitle</option>
                    @if (isset($jobtitles) && count($jobtitles) > 0)
                    @foreach ($jobtitles as $jobtitle)
                    <option value="{{ $jobtitle->id }}" {{ $jobtitle->id === old('jobtitle_id') ? 'selected' : ($jobtitle->id === optional($participant)->jobtitle_id) ? 'selected' : '' }}>{{ $jobtitle->name }}</option>
                    @endforeach
                    @endif
                </select>
                @if ($errors->has('jobtitle'))
                <small class="form-text text-danger">{{ $errors->first('jobtitle') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="">Region</label>
                <region-select regionid="{{ old('region_id', optional($participant)->region_id) }}"></region-select>
                @if ($errors->has('region_id'))
                <small class="form-text text-danger">{{ $errors->first('region_id') }}</small>
                @endif
            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                <label for="division_id">Division</label>
                <p id="ajax-loader" v-if="loading">
                    Updating... &nbsp;<img src="{{ url('/storage') . '/' . 'ajax-loader-square.gif' }}">
                </p>
                <division-select divisionid="{{ old('division_id', optional($participant)->division_id) }}"></division-select>
                @if ($errors->has('division_id'))
                <small class="form-text text-danger">{{ $errors->first('division_id') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">School/Office</label>
                <input type="text" name="station" id="station" class="form-control" placeholder="School/Office" aria-describedby="helpStation" value="{{ old('station') ?? $participant->station}}">
                @if ($errors->has('station'))
                <small class="form-text text-danger">{{ $errors->first('station') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tel. No.</label>
                <input type="text" name="landline" id="landline" class="form-control" placeholder="Tel. No." aria-describedby="helpLandline" value="{{ !empty(old('landline')) ? old('landline') : !empty($participant->landline) ? $participant->landline : '' }}">
                @if ($errors->has('landline'))
                <small class="form-text text-danger">{{ $errors->first('landline') }}</small>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Fax. No.</label>
                <input type="text" name="fax" id="fax" class="form-control" placeholder="Fax. No." aria-describedby="helpFax" value="{{ old('fax') ?: isset($participant->fax) ? $participant->fax : '' }}">
                @if ($errors->has('fax'))
                <small class="form-text text-danger">{{ $errors->first('fax') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="mobile">Mobile No.</label>
                <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No." aria-describedby="helpMobile" value="{!! old('mobile', optional($participant)->mobile) !!}">
                @if ($errors->has('mobile'))
                <small id="passwordHelpBlock" class="form-text text-danger">
                    {{ $errors->first('mobile') }}
                </small>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" aria-describedby="helpEmail" value="{{ old('email') ?: isset($participant->email) ? $participant->email : '' }}">
                @if ($errors->has('email'))
                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="email">Facebook ID</label>
                <input type="text" name="facebookid" id="facebookid" class="form-control" placeholder="Facebook ID" aria-describedby="helpFacebookId" value="{{ old('facebookid') ?: isset($participant->facebookid) ? $participant->facebookid : '' }}">
                @if ($errors->has('facebookid'))
                <small class="form-text text-danger">{{ $errors->first('facebookid') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="card-title mt-4">
        <h3>INVOLVEMENT IN VALUES EDUCATION/EsP</h3>
        <hr>
    </div>
    <div class="row">
        <div class="col-12">
            <p>Number of years in EsP/Values Education as:</p>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-4">
                <label for="yearsAsTeacher">Teacher</label>
                <input type="number" class="form-control" name="yearsAsTeacher" id="yearsAsTeacher" aria-describedby="helpYearsAsTeacher" value="{{ old('yearsAsTeacher', optional($participant)->yearsAsTeacher) }}">
                @if ($errors->has('yearsAsTeacher'))
                <small class="form-text text-danger">{{ $errors->first('yearsAsTeacher') }}</small>
                @endif
            </div>
            <div class="col-4">
                <label for="yearsAsSupervisor">Supervisor</label>
                <input type="number" class="form-control" name="yearsAsSupervisor" id="yearsAsSupervisor" aria-describedby="helpYearsAsSupervisor" value="{{ old('yearsAsSupervisor', optional($participant)->yearsAsSupervisor) }}">
                @if ($errors->has('yearsAsSupervisor'))
                <small class="form-text text-danger">{{ $errors->first('yearsAsSupervisor') }}</small>
                @endif
            </div>
            <div class="col-4">
                <label for="yearsAsCoordinator">Coordinator</label>
                <input type="number" class="form-control" name="yearsAsCoordinator" id="yearsAsCoordinator" aria-describedby="helpYearsAsCoordinator" value="{{ old('yearsAsCoordinator', optional($participant)->yearsAsCoordinator) }}">
                @if ($errors->has('yearsAsCoordinator'))
                <small class="form-text text-danger">{{ $errors->first('yearsAsCoordinator') }}</small>
                @endif
            </div>
        </div>
    </div>
    <div class="card-title mt-4">
        <h3>SEMINAR WORKSHOPS/TRAININGS ATTENDED</h3>
        <hr>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <p>Attended Seminar/Workshop/Training related to Values Education/EsP for the last two (2) years:</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <activity-list participantid="{{ optional($participant)->id ?? '' }}"></activity-list>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        </div>
    </div>
    @if (Route::is('participants.create') || Route::is('participants.edit'))
    <div class="row">
        <div class="col-12">
            <image-upload defaultvalue="{{ old('photo', optional($participant)->photo) }}"></image-upload>
            @if ($errors->has('photo'))
            <small class="form-text text-danger">
                {{ $errors->first('photo') }}
            </small>
            @endif            
        </div>
        
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <span class="float-right">
                    <a class="btn" href="javascript:void();" onclick="window.history.back();">Back</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SAVE</button>
                </span>
            </div>
        </div>
    </div>
</form>

@endsection

@section('boxtools')
<h3><strong>{{ Route::is('*.create') ? 'New' : 'Edit' }} Participant</strong></h3>
@endsection
