<link rel="stylesheet" href="{{ URL::asset('vendor/jquery-timepicker/jquery.timepicker.css') }}" />
<script src="{{ URL::asset('vendor/jquery-timepicker/jquery.timepicker.js') }}"></script>

{{ Form::open(array('url' => '/apptsetting/anotherAppointment', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'saveAppointmentAfterReport')) }}  
{!! csrf_field() !!}
<section class="panel panel-primary">
    <header class="panel-heading">
        <h2 class="panel-title">Create Appointment</h2>
    </header>
    <div class="panel-body">        
        @if(@$type == 'Tele-Marketing Call')
        <div class="form-group">
            {{ Form::label('phone', 'Marketing Phone', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-6">
                {{ Form::text('marketing_phone', old('phone'), ['class' => 'form-control phone required', 'placeholder' => 'Tele-marketing Phone', 'maxlength' => '14']) }}
            </div>
        </div>
        @endif
        
            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                {{ Form::hidden('patient_id') }}
                {{ Form::hidden('appointment_request_id') }}
                {{ Form::hidden('appointment_id') }}
                {{ Form::label('name', 'Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                <div class="col-sm-4">
                    {{ Form::text('first_name', old('first_name'), ['class' => 'form-control required', 'id' => 'first_name', 'placeholder' => 'First Name']) }}
                </div>
                <div class="col-sm-4">
                    {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Last Name']) }}                    
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('patient_status', 'Patient Status', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-md-8">
                    <?php $patientStatus = patientStatus(); ?>
                    {{ Form::select('patient_status', ['' => 'Select the Patient Status'] + $patientStatus , 1, ['class' => 'form-control', 'id' => 'patientSaleStatus', 'disabled' => 'disabled']) }}
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" id='emailParent'>
                {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        {{ Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
                    </div>                    
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('email_invitation', 'Send Invitation', ['class' => 'col-sm-3 control-label']) }}
                <div class="col-md-6">
                    <div class="input-group">                                   
                        {{ Form::checkbox('email_invitation', null, false, ['class' => '']) }}                                
                    </div>
                </div>                            
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                {{ Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14']) }}
                </div>                
            </div>

            <div class="form-group">
                {{ Form::label('dob', 'Date of Birth', ['class' => 'col-sm-3 control-label']) }}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        {{ Form::text('dob', old('dob'), ['class' => 'form-control', 'data-plugin-datepicker', 'placeholder' => 'Date of Birth']) }}
                    </div>
                </div>
            </div>

        <div class="form-group">
            {{ Form::label('status', 'Status', array('class' => 'col-sm-3 control-label call_label mandatory')) }}
            <div class="col-sm-9">
                <div class="col-sm-6">
                    <div class="radio-custom radio-primary">
                        {{ Form::radio('status', '0', false, ['id' => 'awesome', 'class' => 'callStatus required']) }}
                        <label for="awesome">Set
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="radio-custom radio-primary">
                        {{ Form::radio('status', '1', false, ['id' => 'very-awesome', 'class' => 'callStatus required']) }}
                        <label for="very-awesome">No Set
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div  id="nosetAppointment">
            <div class="form-group">
                {{ Form::label('reason_id', 'Reason Code', array('class' => 'col-sm-3 control-label mandatory')) }}
                <div class="col-md-8">
                    {{ Form::select('reason_id', ['' => 'Choose the Reason Code'] + $noSetReasonCode , null, ['class' => 'form-control required']) }}

                </div>
            </div>

            <div class="form-group">
                {{ Form::label('followup', 'Follow-Up After One Week', ['class' => 'col-sm-3 control-label']) }}
                <div class="col-md-1">
                    <div class="input-group">

                        {{ Form::checkbox('followup_status', null, false, ['class' => 'followup_check', 'id' => 'followupWeek']) }}

                    </div>
                </div>
                {{ Form::label('followup', 'OR', ['class' => 'col-sm-1 control-label']) }}
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        {{ Form::text('followup_date', null, ['class' => 'form-control selectDate', 'data-plugin-datepicker', 'placeholder' => 'Follow-Up Date', 'id' => 'followupDate']) }}
                    </div>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('comment', 'Comment for No Set', array('class' => 'col-sm-3 control-label mandatory')) }}
                <div class="col-md-8">
                    {{ Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '2']) }}

                </div>
            </div>
        </div>
        <div  id="setAppointment">
            <div class="form-group">
                {{ Form::label('appDate', 'Appointment Time', array('class' => 'col-sm-3 control-label mandatory')) }}

                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        {{ Form::text('appDate', old('appDate'), ['class' => 'form-control required selectDate', 'data-plugin-datepicker', 'placeholder' => 'Choose Date', 'id' =>'calendarDate']) }}
                    </div>                    
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </span>
                        {{ Form::text('appTime', null, ['class' => 'form-control required', 'placeholder' => 'Choose Time', 'id' => 'durationExample']) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('comment', 'Comment for Set', array('class' => 'col-sm-3 control-label mandatory')) }}
                <div class="col-md-8">
                    {{ Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '2']) }}
                </div>
            </div>
        </div>
    </div>
    <footer class="panel-footer">
        <div class="row">                  
            <div class="col-md-8 text-right">
                {{ Form::button( 'Submit', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit')) }}                
                <button class="btn btn-default closePop">Cancel</button>
            </div>
        </div>
    </footer>
</section>
</form> 
<script>
     $('#durationExample').timepicker({
        'minTime': '09:00am',
        'maxTime': '05:00pm',
        'showDuration': true
    });        

</script>