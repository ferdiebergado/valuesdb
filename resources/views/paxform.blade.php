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
            <h6>{{ $participant->jobtitle->name }}</h6>
            <h6>{{ $participant->station }}</h6>
        </div>
        <div class="col-4">
            <img src="{{ asset('storage/avatars/' . $participant->photo) }}" alt="avatar" height="160" width="160">
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
            </div>
        </div>
        <div class="col-9">
            <div class="form-group">
                <label for="">Lastname</label>
                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" aria-describedby="helpLastname" value="{{ old('lastname', optional($participant)->lastname) }}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Firstname</label>
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" aria-describedby="helpFirstname" value="{{ old('firstname') ?? $participant->firstname}}" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Middle Name</label>
                <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Middle Name" aria-describedby="helpMiddlename" value="{{ old('middlename') ?? $participant->middlename}}">
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
            </div>
        </div>
        <div class="col-9">
            <div class="form-group">
                <label for="">Job Title</label>
                <select class="form-control" name="jobtitle_id" id="jobtitle_id">
                    <option value="">Select</option>
                    @if (isset($jobtitles) && count($jobtitles) > 0)
                    @foreach ($jobtitles as $jobtitle)
                    <option value="{{ $jobtitle->id }}" {{ $jobtitle->id === old('jobtitle_id') ? 'selected' : ($jobtitle->id === optional($participant)->jobtitle_id) ? 'selected' : '' }}>{{ $jobtitle->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="">Region</label>
                <region-select regionid="{{ old('region_id', optional($participant)->region_id) }}"></region-select>
            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                <label for="division_id">Division</label>
                <p id="ajax-loader" v-if="loading">
                    Updating... &nbsp;<img src="{{ url('/storage') . '/' . 'ajax-loader-square.gif' }}">
                </p>
                <division-select divisionid="{{ old('division_id', optional($participant)->division_id) }}"></division-select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="">School/Office</label>
                <input type="text" name="station" id="station" class="form-control" placeholder="School/Office" aria-describedby="helpStation" value="{{ old('station') ?? $participant->station}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tel. No.</label>
                <input type="text" name="landline" id="landline" class="form-control" placeholder="Tel. No." aria-describedby="helpLandline" value="{{ !empty(old('landline')) ? old('landline') : !empty($participant->landline) ? $participant->landline : '' }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Fax. No.</label>
                <input type="text" name="fax" id="fax" class="form-control" placeholder="Fax. No." aria-describedby="helpFax" value="{{ old('fax') ?: isset($participant->fax) ? $participant->fax : '' }}">
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
                    {{ $errors->mobile }}
                </small>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" aria-describedby="helpEmail" value="{{ old('email') ?: isset($participant->email) ? $participant->email : '' }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="email">Facebook ID</label>
                <input type="text" name="facebookid" id="facebookid" class="form-control" placeholder="Facebook ID" aria-describedby="helpFacebookId" value="{{ old('facebookid') ?: isset($participant->facebookid) ? $participant->facebookid : '' }}">
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
            </div>
            <div class="col-4">
                <label for="yearsAsSupervisor">Supervisor</label>
                <input type="number" class="form-control" name="yearsAsSupervisor" id="yearsAsSupervisor" aria-describedby="helpYearsAsSupervisor" value="{{ old('yearsAsSupervisor', optional($participant)->yearsAsSupervisor) }}">
            </div>
            <div class="col-4">
                <label for="yearsAsCoordinator">Coordinator</label>
                <input type="number" class="form-control" name="yearsAsCoordinator" id="yearsAsCoordinator" aria-describedby="helpYearsAsCoordinator" value="{{ old('yearsAsCoordinator', optional($participant)->yearsAsCoordinator) }}">
            </div>
        </div>
    </div>
    <div class="card-title mt-4">
        <h3>SEMINAR WORKSHOPS/TRAININGS ATTENDED</h3>
        <hr>
    </div>
    <div class="row">
        <div class="col-12">
            <p>Attended Seminar/Workshop/Training related to Values Education/EsP for the last two (2) years:</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title of the Activity</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Managed By</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @if (Route::is('participants.create') || Route::is('participants.edit'))
    <div class="row">
        <image-upload defaultvalue="{{ old('photo', optional($participant)->photo) }}"></image-upload>
    </div>
    @endif
    <div class="col-12">
        <div class="form-group">
            <span class="float-right">
                <a class="btn" href="javascript:void();" onclick="window.history.back();">Back to Search</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SAVE</button>
            </span>
        </div>
    </div>
</form>

@endsection
