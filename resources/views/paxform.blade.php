@extends('layouts.app')

@section('content')

<form method="{{ $method }}" action="{{ $route }}">
    @csrf
    <fieldset>
        <div class="card-title">
            <h3>Participant Profile</h3>
            <hr>
        </div>
        
        @if (Route::is('participants.show'))
        
        {{ method_field('PUT') }}
        
        <div class="row">
            <div class="col-8">
                <h4>{{ $participant->lastname }}, {{ $participant->firstname }} . {{ $participant->middlename }}</h4>
                <p>{{ $participant->jobtitle }}</p>
                <p>{{ $participant->station }}</p>
            </div>
            <div class="col-4">
                <img src="{{ asset('storage/default.png') }}" alt="">
            </div>            
        </div>
        <hr>
        @endif
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label>ID &nbsp;<span class="badge badge-success">{{ $participant->id ?? '(New)' }}</span></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">Title</label>
                    <select class="form-control" name="title" id="title">
                        @php
                        $titles = ['Mr.', 'Ms.', 'Mrs.', 'Dr.', 'Prof.'];              
                        @endphp
                        <option value="">Select</option>
                        @foreach ($titles as $title)
                        <option value="{{ $title }}">{{ $title }}</option>
                        @endforeach
                    </select>
                </div>        
            </div>
            <div class="col-9">            
                <div class="form-group">
                    <label for="">Lastname</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" aria-describedby="helpLastname" value="{{ old('lastname') ?? $participant->lastname}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Firstname</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" aria-describedby="helpFirstname" value="{{ old('firstname') ?? $participant->firstname}}">
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
                    <select class="form-control" name="sex" id="sex">
                        <option value="">Select</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>    
            </div>
            <div class="col-9">            
                <div class="form-group">
                    <label for="">Job Title</label>
                    <select class="form-control" name="title" id="title">
                        @php
                        $titles = ['Mr.', 'Ms.', 'Mrs.', 'Dr.', 'Prof.'];              
                        @endphp
                        <option value="">Select</option>
                        @foreach ($titles as $title)
                        <option value="{{ $title }}">{{ $title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-4">    
                <div class="form-group">
                    <label for="">Region</label>
                    <select class="form-control" name="region" id="region">
                        <option value="">Select</option>
                    </select>
                </div>    
            </div>
            <div class="col-8">            
                <div class="form-group">
                    <label for="">Division</label>
                    <select class="form-control" name="division" id="division">
                        <option value="">Select</option>
                    </select>
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
                    <input type="text" name="landline" id="landline" class="form-control" placeholder="Tel. No." aria-describedby="helpLandline" value="{{ old('landline') ?? $participant->landline }}">
                </div>  
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Fax. No.</label>
                    <input type="text" name="fax" id="midfaxdlename" class="form-control" placeholder="Fax. No." aria-describedby="helpFax" value="{{ old('fax') ?? $participant->fax}}">
                </div>        
            </div>
        </div>    
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="mobile">Mobile No.</label>
                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No." aria-describedby="helpMobile" value="{{ old('mobile') ?? $participant->mobile}}">
                </div>  
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" aria-describedby="helpEmail" value="{{ old('email') ?? $participant->email}}">
                </div>        
            </div>
        </div>    
    </fieldset>
    <fieldset>
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
                    <input type="number" class="form-control" name="yearsAsTeacher" id="yearsAsTeacher" aria-describedby="helpYearsAsTeacher">
                </div> 
                <div class="col-4">
                    <label for="yearsAsSupervisor">Supervisor</label>
                    <input type="number" class="form-control" name="yearsAsSupervisor" id="yearsAsSupervisor" aria-describedby="helpYearsAsSupervisor">
                </div>             
                <div class="col-4">
                    <label for="yearsAsCoordinator">Coordinator</label>
                    <input type="number" class="form-control" name="yearsAsCoordinator" id="yearsAsCoordinator" aria-describedby="helpYearsAsCoordinator">
                </div>                  
            </div>
        </div>
    </fieldset>
    <fieldset>
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
        @if (Route::is('participants.create'))            
        <div class="row">
            <image-upload></image-upload>
        </div>
        @endif
    </div>      
</fieldset>        
<div class="col-12">    
    <div class="form-group">
        <a class="btn" href="javascript:void();" onclick="window.history.back();">Back to Search</a>        
        <span class="float-right">
            <a class="btn btn-primary" href="{{ route('participants.update', ['participant' => $participant->id]) }}"><i class="fa fa-save"></i> SAVE</a>
        </span>
    </div>  
</div>
</form>

@endsection
