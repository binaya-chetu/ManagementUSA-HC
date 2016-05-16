{{ Form::open(array('url' => '/appointment/addappointment', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'addAppointment')) }}  
{!! csrf_field() !!}
<div id="docApptSchedule" class="modal-block modal-block-primary mfp-hide">
                <section class="panel">
                                <button title="Close (Esc)" type="button" class="mfp-close" style="color: #333!important;">×</button>
                                <div class="panel-body">

                                </div>
                </section>
</div>

<section class="panel panel-primary">
    <header class="panel-heading">
        <h2 class="panel-title">Create  Appointment</h2>
    </header>
    <div class="panel-body">
        <div class="form-group">
            {{ Form::label('doctor_id', 'Doctor', array('class' => 'col-sm-4 control-label')) }}
            <div class="col-md-6 commentdiv">
                <select  class="form-control chosen" name="doctor_id" id="doctor_id">
                    <option value="">Choose Doctor</option>
                    @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                    @endforeach
                </select>    
                
            </div>
            <div class="showDocScheddulerLInk"></div>
        </div>

        <div class="form-group{{ $errors->has('appDate') ? ' has-error' : '' }}">
            {{ Form::label('appDate', 'Choose Date & Time', array('class' => 'col-sm-4 control-label mandatory')) }}

            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    {{ Form::text('appDate', old('appDate'), ['class' => 'form-control required selectDate', 'data-plugin-datepicker']) }}
                </div>
                @if ($errors->has('appDate'))
                <span class="help-block">
                    <strong>{{ $errors->first('appDate') }}</strong>
                </span>
                @endif
            </div>

            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </span>
                    {{ Form::text('appTime', old('appTime'), ['class' => 'form-control required', 'data-plugin-timepicker']) }}
                </div>
            </div>
            {{ Form::hidden('marketer', 1) }}
            {{ Form::hidden('createdBy', Auth::user()->id) }}
            {{ Form::hidden('lastUpdatedBy', Auth::user()->id) }}
            {{ Form::hidden('apptSlotDuration', config('constants.DEFAULT_APPOINTMENT_TIME_SPAN')) }}
            {{ Form::hidden('clinicOpeningTime', config('constants.CLINIC_OPEN_TIME')) }}
            {{ Form::hidden('clinicClosingTime', config('constants.CLINIC_CLOSE_TIME')) }}
        </div>   

        <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">        
            {{ Form::label('patient_id', 'Patient', array('class' => 'col-sm-4 control-label mandatory')) }}
            <div class="col-md-5 patient_id commentdiv" id="patientMainDiv">
                <select  class="form-control chosen" name="patient_id" id="patient_id">
                    <option value="">Choose Patient</option>
                    @foreach ($patients as $patient)
                         @if(isset($id))     
                            @if($id == $patient->id)
                                <option  selected value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                            @endif
                             
                            @else
                                <option  value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>  
                        @endif
                   @endforeach
                   
                </select>  
                @if ($errors->has('patient_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('patient_id') }}</strong>
                </span>
                @endif
                {{ Form::hidden('clinic', Auth::user()->id) }}
            </div>
            <div class="col-sm-3">
                <div class="mb-md">
                    {{ Form::button(
                                    '<i class="fa fa-plus"></i>Add Patient',
                                        ['class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'id' => 'addAppPatient', 'data-token' => csrf_token() ]) 
                    }}
                </div>
            </div>
        </div>
        <div id="patient_come"  style="display:none;">
            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}"> 
                {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-4 control-label mandatory')) }}
                <div class="col-sm-6"> 
                    {{ Form::hidden('id') }}
                    {{ Form::text('first_name', old('first_name'), ['class' => 'form-control required', 'id' => 'first_name', 'placeholder' => 'First Name']) }}
                    @if ($errors->has('patient_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                    @endif 
                </div> 
            </div> 

            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}"> 
                {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-4 control-label mandatory')) }}
                <div class="col-sm-6"> 
                    {{ Form::text('last_name', old('last_name'), ['class' => 'form-control required', 'id' => 'last_name', 'placeholder' => 'Last Name']) }}
                    @if ($errors->has('patient_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                    @endif
                </div> 
            </div> 

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> 
                {{ Form::label('email', 'Email', array('class' => 'col-sm-4 control-label mandatory')) }}
                <div class="col-sm-6">   
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        {{ Form::email('email', old('email'), ['class' => 'form-control required', 'id' => 'email', 'placeholder' => 'Email']) }}
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div> 
            </div> 

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}"> 
                {{ Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label mandatory')) }}
                <div class="col-sm-6"> 
                    {{ Form::text('phone', old('phone'), ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14']) }}
                </div> 
                @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div> 

            <div class="form-group"> 
                {{ Form::label('dob', 'Date of birth', ['class' => 'col-sm-4 control-label']) }}
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        {{ Form::text('dob', old('dob'), ['class' => 'form-control', 'data-plugin-datepicker']) }}
                    </div>
                </div>
                @if ($errors->has('dob')) 

                <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> 
                </span> @endif 
            </div> 

            <div class="form-group"> 
                {{ Form::label('gender', 'Gender', ['class' => 'col-sm-4 control-label']) }}

                <div class="col-sm-6"> 
                    <div class="col-sm-3"> 

                        <div class="radio-custom radio-primary"> 
                            {{ Form::radio('gender', 'Male', true, ['id' => 'optionsRadios1', 'id' => "awsome"]) }} 
                            <label for="awesome">Male
                            </label> 
                        </div> 
                    </div> 

                    <div class="col-sm-3"> 
                        <div class="radio-custom radio-primary"> 
                            {{ Form::radio('gender', 'Female', true, ['id' => 'optionsRadios1', 'id' => "very-awsome"]) }} 
                            <label for="very-awesome">Female
                            </label> 
                        </div> 
                    </div> 
                </div> 
            </div> 

            <div class="form-group"> 
                {{ Form::label('address1', 'Primary Address', ['class' => 'col-sm-4 control-label']) }}
                <div class="col-sm-6"> 
                    {{ Form::textarea('address1', null, ['class' => 'form-control', 'placeholder' => 'Primary Address', 'id' => 'address1', 'rows' => 3]) }}
                </div> 
            </div>

        </div><br/>
        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
            {{ Form::label('comment', 'Comment', ['class' => 'col-sm-4 control-label mandatory']) }}
            <div class="col-md-6">
                {{ Form::textarea('comment', old('comment'), ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'id' => 'comment', 'rows' => 3]) }}

                @if ($errors->has('comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('comment') }}</strong>
                </span>
                @endif
            </div>
        </div>


    </div>
    <footer class="panel-footer">
        <div class="row">
            @if(Request::segment(2) === 'newAppointment')
            <div class="col-md-12 col-md-offset-4">
                {{ Form::button(
                                    '<i class="fa fa-btn fa-user"></i>  Add Appointment',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                }}  
            </div>

            @else
            <div class="col-md-12 text-right">
                {{ Form::button(
                                    '<i class="fa fa-btn fa-user"></i>  Add Appointment',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                }}
                <button class="btn btn-default closePop">Cancel</button>
            </div>
            @endif


        </div>
    </footer>
</section>
{{ Form::close() }}
