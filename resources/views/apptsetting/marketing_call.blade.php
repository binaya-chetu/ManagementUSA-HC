@extends('layouts.common')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Create Appointment From Tele-Marketing Call</h2>

        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('apptsetting.marketingCall') !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">
            {{ Form::open(array('url' => '/apptsetting/saveRequestFollowUp', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'addAppointment')) }}
            {!! csrf_field() !!}
            <div id="docApptSchedule" class="modal-block modal-block-primary mfp-hide">
                <section class="panel">
                    <button title="Close (Esc)" type="button" class="mfp-close" >×</button>
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
                        {{ Form::label('callTime', 'Call Time', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                {{ Form::text('created', date('m-d-Y'), ['class' => 'form-control', 'readonly' => true]) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                {{ Form::text('created_time', date('H:i:s'), ['class' => 'form-control', 'readonly' => true]) }}
                            </div>
                        </div>
                        {{ Form::hidden('createdBy', Auth::user()->id) }}
                        {{ Form::hidden('lastUpdatedBy', Auth::user()->id) }}
                    </div>
                    <div class="form-group">
                            {{ Form::label('appt_type', 'Appointment Type', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-md-6">
                                {{ Form::select('reason_id', null, ['' => 'Choose the Reason Code'] + $reasonCode, ['class' => 'form-control required']) }}

                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">
                        {{ Form::label('patient_id', 'Patient', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-md-5 patient_id commentdiv" id="patientMainDiv">

                            <select  class="form-control chosen" name="patient_id" id="patient_id">
                                <option value="">Choose Patient</option>
                                @foreach ($patients as $patient)
                                <option {{ old('patient_id') == $patient->id ? 'selected="selected"' :'' }} value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }} ({{ $patient->email }})</option>
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
                            {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label mandatory')) }}
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
                            {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label mandatory')) }}
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
                            {{ Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label mandatory')) }}
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
                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        {{ Form::label('comment', 'Comment', ['class' => 'col-sm-3 control-label mandatory']) }}
                        <div class="col-md-6">
                            {{ Form::textarea('comment', old('comment'), ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'id' => 'comment', 'rows' => 3]) }}

                            @if ($errors->has('comment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('status', 'Status', array('class' => 'col-sm-3 control-label call_label mandatory')) }}
                        <div class="col-sm-8">
                            <div class="col-sm-3">
                                <div class="radio-custom radio-primary">
                                    {{ Form::radio('status', '1', false, ['id' => 'awesome', 'class' => 'callStatus required']) }}
                                    <label for="awesome" style=" text-overflow: ellipsis;">Set
                                    </label>
                                     {{ Form::radio('status', '2', false, ['id' => 'very-awesome', 'class' => 'callStatus required']) }}
                                    <label for="very-awesome">No Set
                                    </label>
                                    {{ Form::hidden('appt_id', null, ['id' => 'apptId']) }}
                                    {{ Form::hidden('appt_type', 1) }}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="radio-custom radio-primary">
                                    {{ Form::radio('status', '2', false, ['id' => 'very-awesome', 'class' => 'callStatus required']) }}
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
                                {{ Form::select('reason_id', null, ['' => 'Choose the Reason Code'] + $reasonCode, ['class' => 'form-control required']) }}

                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('dob', 'Follow-Up Later', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    {{ Form::text('dob', null, ['class' => 'form-control selectDate', 'data-plugin-datepicker', 'placeholder' => 'Follow-Up Date']) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('comment', 'Reason', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-md-6">
                                {{ Form::textarea('reason', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3']) }}

                            </div>
                        </div>
                    </div>
                    <div  id="setAppointment">

                        <div class="form-group">
                            {{ Form::label('appDate', 'Choose Date & Time', array('class' => 'col-sm-3 control-label mandatory')) }}

                            <div class="col-md-4">
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

                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    {{ Form::text('appTime', old('appTime'), ['class' => 'form-control required', 'data-plugin-timepicker', 'placeholder' => 'Choose Date']) }}
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4">
                            {{ Form::button(
                                    '<i class="fa fa-btn fa-user"></i>  Add Appointment',
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
        if (call_value == 1) {
            $('#nosetAppointment').hide();
            $('#setAppointment').show();
        } else {
            $('#setAppointment').hide();
            $('#nosetAppointment').show();
        }
    });

</script>
@endsection
