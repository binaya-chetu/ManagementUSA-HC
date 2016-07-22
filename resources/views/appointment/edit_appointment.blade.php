{{ Form::open(array('url' => '/appointment/saveappointment', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'editAppointment')) }}  
{!! csrf_field() !!}
<section class="panel panel-primary">
    <header class="panel-heading">
        <h2 class="panel-title">Edit Appointment</h2>
    </header>
    <div class="panel-body">
<!--        <div class="form-group">
            {{ Form::label('Doctor', 'Doctor', array('class' => 'col-sm-4 control-label')) }}
            <div class="col-md-6">
                <select  class="form-control chosen" name="doctor_id" id="doctor_id">
                    <option value="">Choose Doctor</option>
                    @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                    @endforeach
                </select>    
            </div>
            <div class="showDocScheddulerLInk"></div>
        </div>-->
        <div class="form-group">
            {{ Form::label('appointment_time', 'Choose Date & Time', array('class' => 'col-sm-4 control-label mandatory')) }}
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    {{ Form::text('appDate', old('appDate'), ['class' => 'form-control required selectDate', 'data-plugin-datepicker']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </span>
                    {{ Form::text('appTime', old('appTime'), ['class' => 'form-control required','id' => 'durationExample']) }}
                </div>
            </div>
            {{ Form::hidden('appointment_id', 1,['id' => 'appointment_id']) }}   
            {{ Form::hidden('lastUpdatedBy', Auth::user()->id) }}
        </div>   
        
<!--        <div class="form-group">
            {{ Form::label('patient', 'Patient', array('class' => 'col-sm-4 control-label')) }}

            <div class="col-md-6">
                <select  class="form-control chosen" name="patient_id" id="patient_id" disabled="true">
                    <option value="" disabled>Choose Patient</option>
                    @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                    @endforeach                 
                </select>    
                {{ Form::hidden('clinic', Auth::user()->id) }}
                {{ Form::hidden('patient_id') }}               
            </div>
        </div>-->
        
        <!-- Patient Edited Details -->
        <div class="form-group"> 
            {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-4 control-label mandatory')) }}
            <div class="col-sm-4"> 
                {{ Form::hidden('id') }}      
                {{ Form::text('first_name', old('first_name'), ['class' => 'form-control required', 'id' => 'first-name', 'placeholder' => 'First Name']) }}
                <span class="help-block firstName">
                </span> 
            </div> 
            <div class="col-sm-4">
                {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'id' => 'last-name', 'placeholder' => 'Last Name']) }}
                <span class="help-block firstName">
                </span> 
            </div> 
        </div> 
        <div class="form-group"> 
            {{ Form::label('email', 'Email', array('class' => 'col-sm-4 control-label')) }}
            <div class="col-sm-6">
                {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
                <span class="help-block email">
                </span> 
            </div> 
        </div> 
        <div class="form-group">             
            {{ Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label')) }}
            <div class="col-sm-6"> 
                {{ Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14']) }}
            </div> 
        </div> 
        <div class="form-group"> 
            {{ Form::label('dob', 'DOB', array('class' => 'col-sm-4 control-label')) }}
            <div class="col-md-6"> 
                <div class="input-group"> 
                    <span class="input-group-addon"> <i class="fa fa-calendar"></i> 
                    </span> 
                    {{ Form::text('dob', old('dob'), ['class' => 'form-control', 'data-plugin-datepicker', 'id' => 'dob']) }}
                </div> 
                @if ($errors->has('dob')) 
                <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> 
                </span>
                @endif 
            </div> 
        </div> 
<!--        <div class="form-group"> 
            {{ Form::label('gender', 'Gender', array('class' => 'col-sm-4 control-label')) }}
            <div class="col-sm-6"> 
                <div class="col-sm-3"> 
                    <div class="radio-custom radio-primary"> 
                        {{ Form::radio('gender', 'Male', true, ['id' => 'awesome']) }}
                        <label for="awesome">Male
                        </label> 
                    </div> 
                </div> 
                <div class="col-sm-3"> 
                    <div class="radio-custom radio-primary"> 
                        {{ Form::radio('gender', 'Female', false, ['id' => 'very-awesome']) }}
                        <label for="very-awesome">Female
                        </label> 
                    </div> 
                </div> 
            </div> 
        </div> -->
        <div class="form-group"> 
            {{ Form::label('address', 'Address line 1', array('class' => 'col-sm-4 control-label')) }}
            <div class="col-sm-6"> 
                {{ Form::text('address1', old('dob'), ['class' => 'form-control', 'placeholder' => 'Primary Address', 'id' => 'address1']) }}
            </div> 
        </div> 
        <!-- End -->
        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
            {{ Form::label('comment', 'Comment', array('class' => 'col-sm-4 control-label mandatory')) }}
            <div class="col-md-6">
                {{ Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Enter Comment', 'id' => 'appointmentComment', 'rows' => '2']) }}
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
            @if(isset($type) && $type == 'upcoming')
            <div class="col-md-4 followButton">
                {{ Form::button('Follow Up', [ 'class' => 'btn btn-primary followUp' ]) }}
            </div>
            @endif            
            <div class="col-md-8 text-right">
                {{ Form::button( 'Submit', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit')) }}
                <a href="javascript:void(0)" class="btn btn-default remove-row confirmation-callback" id = "deleteAppointmentFromCalendar"><i class="fa fa-trash-o"></i> Delete</a> 
                <button class="btn btn-default closePop">Cancel</button>
            </div>
        </div>
    </footer>
</section>
</form> 
<script>
    $(function() {
        $('.confirmation-callback').confirmation({
            onConfirm: function() {
                var link = $('.confirmation-callback').data('href');
                window.location = ajax_url + link;
            }
        });
    });   
</script>
