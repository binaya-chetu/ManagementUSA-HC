@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ URL::asset('vendor/jquery-timepicker/jquery.timepicker.css') }}" />
<script src="{{ URL::asset('vendor/jquery-timepicker/jquery.timepicker.js') }}"></script>
<section role="main" class="content-body">
    <header class="page-header">
        <?php if($value == 'marketingCall'){                                    
                $type = 'Tele-Marketing Call';
            }else if($value == 'walkin'){
                $type = 'Direct Walkin ';
            }
        ?>
        <h2>Create Appointment From {{ $type }}</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('apptsetting.index') !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">
            {{ Form::open(array('url' => '/apptsetting/saveApptFollowup', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'addApptRequest')) }}
            {!! csrf_field() !!}            
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Create  Appointment</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        @if(Session::has('flash_message'))
                            <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                        @endif
                        @if(Session::has('error_message'))
                            <div class="col-sm-12"><div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><em> {!! session('error_message') !!}</em></div></div>
                        @endif
                    </div>
                    @if($type == 'Tele-Marketing Call')
                    <div class="form-group">
                        {{ Form::label('phone', 'Marketing Phone', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::text('marketing_phone', old('phone'), ['class' => 'form-control phone required', 'placeholder' => 'Tele-marketing Phone', 'maxlength' => '14']) }}
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <?php $time = $type.' Time'; ?>
                        {{ Form::label('callTime', $time, array('class' => 'col-sm-3 control-label')) }}

                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                {{ Form::text('created', date('m/d/Y'), ['class' => 'form-control', 'readonly' => true]) }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                {{ Form::text('created_time', date('h:i A'), ['class' => 'form-control', 'readonly' => true]) }}
                            </div>
                        </div>
                        {{ Form::hidden('created_by', Auth::user()->id) }}
                        <?php if($value == 'marketingCall'){                                    
                                        $appt_type = '2';
                                    }else if($value == 'walkin'){
                                        $appt_type = '3';
                                    }
                                ?>
                        {{ Form::hidden('appt_source', $appt_type)}}
                    </div>
                  
                    <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">
                        {{ Form::label('patient_id', 'Patient', array('class' => 'col-sm-3 control-label mandatory')) }}
<!--                        <div class="col-md-5 patient_id commentdiv" id="patientMainDiv">
  
                            <select  class="form-control chosen" name="patient_id" id="patient_id">
                                <option value="">Choose Any</option>
                                @foreach ($patients as $patient)
                                <option {{ old('patient_id') == $patient->id ? 'selected="selected"' :'' }} value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }} ({{ $patient->email }})</option>
                                @endforeach

                            </select>
                            @if ($errors->has('patient_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('patient_id') }}</strong>
                            </span>
                            @endif
                        </div>-->
                        
  
                            <div class="col-md-3 patient_id" id="patientMainDiv">
                                <select  class="form-control" name="patient_id" id="patient_id">
                                    <option value="">Choose Any</option>
                                    @foreach ($patients as $patient)
                                        <option {{ old('patient_id') == $patient->id ? 'selected="selected"' :'' }} value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }} </option>
                                    @endforeach
                                </select>
                                
                            </div>
                            @if ($errors->has('patient_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('patient_id') }}</strong>
                            </span>
                            @endif
                       
                        <div class="col-sm-3">
                            <div class="mb-md">
                                {{ Form::button(
                                    '<i class="fa fa-plus"></i> Add Patient',
                                        ['class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'id' => 'addAppPatient', 'data-token' => csrf_token() ])
                                }}
                            </div>
                        </div>
                    </div>
                  
                    <div id="patient_come"  style="display:none;">
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-6">
                                {{ Form::text('first_name', old('first_name'), ['class' => 'form-control required', 'id' => 'first_name', 'placeholder' => 'First Name']) }}
                                @if ($errors->has('patient_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Last Name']) }}
                                @if ($errors->has('patient_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" id='emailParent'>
                            {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    {{ Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
                                </div>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email_invitation', 'Allow to send invitation', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-6">
                                <div class="input-group">                                   

                                    {{ Form::checkbox('email_invitation', null, false, ['class' => '']) }}                                

                                </div>
                            </div>                            
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            {{ Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14']) }}
                            </div>
                            @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('dob', 'Date of Birth', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    {{ Form::text('dob', old('dob'), ['class' => 'form-control', 'data-plugin-datepicker', 'placeholder' => 'Date of Birth']) }}
                                </div>
                            </div>
                        </div>

                    </div><br/>
<!--                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        {{ Form::label('comment', 'Comment', ['class' => 'col-sm-3 control-label mandatory']) }}
                        <div class="col-md-6">
                            {{ Form::textarea('comment', old('comment'), ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'id' => 'comment', 'rows' => 3]) }}

                            @if ($errors->has('comment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>-->
                    <div class="form-group">
                        {{ Form::label('status', 'Status', array('class' => 'col-sm-3 control-label call_label mandatory')) }}
                        <div class="col-sm-8">
                            <div class="col-sm-3">
                                <div class="radio-custom radio-primary">
                                    {{ Form::radio('status', '0', false, ['id' => 'awesome', 'class' => 'callStatus required']) }}
                                    <label for="awesome">Set
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
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
                            <div class="col-md-6">
                                {{ Form::select('reason_id', ['' => 'Choose the Reason Code'] + $noSetReasonCode, null, ['class' => 'form-control required']) }}

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
                            <div class="col-md-4">
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
                            <div class="col-md-6">
                                {{ Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3']) }}

                            </div>
                        </div>
                    </div>
                    <div  id="setAppointment">
                        <div class="form-group">
                            {{ Form::label('reason_id', 'Reason for Visit', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-md-6">
                                {{ Form::select('reason_id', ['' => 'Choose the Reason'] + $setReasonCode, null, ['class' => 'form-control required']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('appDate', 'Appointment Time', array('class' => 'col-sm-3 control-label mandatory')) }}

                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    {{ Form::text('appDate', old('appDate'), ['class' => 'form-control required selectDate', 'data-plugin-datepicker', 'placeholder' => 'Choose Date', 'id' =>'calendarDate']) }}
                                </div>
                                @if ($errors->has('appDate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('appDate') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-3">
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
                            <div class="col-md-6">
                                {{ Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3']) }}

                            </div>
                        </div>
                    </div>


                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4">
                            {{ Form::button(
                                    '<i class="fa fa-btn fa-user"></i>  Save Details',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit'))
                            }}
                        </div>
                    </div>
                </footer>
            </section>
            {{ Form::close() }}

        </div>
    </div>
</section>
<script>
    $('document').ready(function() {
        $('#nosetAppointment').hide();
        $('#setAppointment').hide();
    })
    $('.callStatus').on('click', function() {
        var call_value = $(this).val();
        if (call_value == 0) {
            $('#nosetAppointment').hide();
            $('#setAppointment').show();
        } else {
            $('#setAppointment').hide();
            $('#nosetAppointment').show();
        }
    });
    
   
     $('#durationExample').timepicker({
        'minTime': '09:00am',
        'maxTime': '05:00pm',
        'showDuration': true
    });
    


    /*
     * Code for the Checking the followup
     */

    $('#followupWeek').on('click', function(){
        if($(this).is(':checked')){
            var date = new Date();
            date.setDate(date.getDate() + 7);
            var dateMsg = ("0" + (date.getMonth() + 1)).slice(-2) +'/'+("0" + date.getDate()).slice(-2)+'/'+date.getFullYear();
            $('#followupDate').val(dateMsg);
            $('#followupDate').attr('disabled', true);
        }else{
            $('#followupDate').removeAttr('disabled');            
        }
    });

    
</script>
@endsection
