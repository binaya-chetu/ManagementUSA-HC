@extends( (!empty(Request::segment(4)) || !empty(Request::segment(5))) ? 'layouts.medical' : 'layouts.common')

@section('content')
@if(empty(Request::segment(4)) || empty(Request::segment(5)))
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit patient :  {{ $patient->first_name }} {{ $patient->last_name }}</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
@endif
    <div class="row">
        <section class="panel form-wizard" id="w3">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">{{ $patient->first_name }} {{ $patient->last_name }}</h2>
            </header>
            <div class="panel-body">
                <div class="wizard-progress">
                    <div class="steps-progress">
                        <div class="progress-indicator"></div>
                    </div>
                    <ul>
                        <li class="active">
                            <a href="#w3-account" data-toggle="tab"><span>1</span>Profile Info</a>
                        </li>
                        <li>
                            <a href="#w3-billing" data-toggle="tab"><span>2</span>Adam Questionaires</a>
                        </li>
                        <li>
                            <a href="#w3-medical" data-toggle="tab"><span>3</span>Medical<br>History</a>
                        </li>
                    </ul>
                </div>
				
                @if(Session::has('flash_message'))
					<div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @elseif(Session::has('error_message'))
					<div class="col-sm-12"><div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span><em> {!! session('error_message') !!}</em></div></div>					
				@endif
				
                {!! Form::model($patient, ['method' => 'post','url' => ['/appointment/savePatientMedicalRecord', $patient->base64Id], 'id' => 'patientMedical', 'files' => true, 'class'=>'form-horizontal']) !!}
                {!! csrf_field() !!}
                <div class="tab-content">
                    <div id="w3-account" class="tab-pane active">
                        <div class="row customFormRow">
                            <div class="col-sm-6" >
                                <div class="form-group">
                                    {{ Form::label('w3-first_name', 'First Name', array('class' => 'col-sm-4 control-label mandatory')) }}
                                    <div class="col-sm-8">
										{{ Form::hidden('hash', $hash) }}
                                        {{ Form::text('first_name', null, ['class' => 'form-control input-sm required', 'id' => 'w3-first_name', 'placeholder' => 'First Name']) }}
                                    </div>
									<div id="vitaminSupplimentBox"></div>
									<div id="surgeryListBox"></div>
									<div id="allergiesListBox"></div>
									<div id="illnessListBox"></div>
                                </div>
                            </div>
                            <div class="col-sm-6" >
                                <div class="form-group">
                                    {{ Form::label('w3-middle_name', 'Middle Name', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('middle_name', null, ['class' => 'form-control input-sm', 'id' => 'w3-middle_name', 'placeholder' => 'Middle Name']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row customFormRow">
                            <div class="col-sm-6" >
                                <div class="form-group">
                                    {{ Form::label('w3-last_name', 'Last Name', array('class' => 'col-sm-4 control-label mandatory')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('last_name', null, ['class' => 'form-control input-sm required', 'id' => 'w3-middle_name', 'placeholder' => 'Last Name']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" >
                                <div class="form-group">
                                    {{ Form::label('w3-email', 'Email', array('class' => 'col-sm-4 control-label mandatory')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('email', null, ['class' => 'form-control input-sm required', 'id' => 'w3-email', 'placeholder' => 'example@mail.com']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row customFormRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-gender', 'Gender', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        <div class="radio">
                                            <label>
                                                {{ Form::radio('gender', 'Male', $patient['patientDetail']->gender == 'Male', ['id' => 'optionsRadios1']) }}
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                {{ Form::radio('gender', 'Female', $patient['patientDetail']->gender == 'Female', ['id' => 'optionsRadios2']) }}
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-marital', 'Marital Status', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        <?php $marital = ['Married' => 'Married', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed', 'Single' => 'Single']; 
										$value = ($patient['patientDetail'] && $patient['patientDetail']->marital_status) ? $marital[$patient['patientDetail']->marital_status] : null;
										?>
                                        {{ Form::select('marital_status', ['0' => 'Please Select Marital Status'] + $marital, $value, ['class' => 'form-control input', 'id' => 'maritalStatus']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row customFormRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-dob', 'Date of Birth', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <?php
                                            $dob = '';
                                            if ($patient['patientDetail']->dob) {
                                                $dob = date('m/d/Y', strtotime($patient['patientDetail']->dob));
                                            }
                                            ?>
                                            {{ Form::text('dob', $dob, ['class' => 'form-control', 'data-plugin-datepicker', 'placeholder' => 'Date of Birth']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-address', 'Address Line 1', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('address1', $patient['patientDetail']->address1, ['class' => 'form-control input-sm', 'id' => 'w3-address1', 'placeholder' => 'Primary Address']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row customFormRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-address2', 'Address Line 2', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('address2', $patient['patientDetail']->address2, ['class' => 'form-control input-sm', 'id' => 'w3-address2', 'placeholder' => 'Secondary Address']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-city', 'City', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('city', $patient['patientDetail']->city, ['class' => 'form-control input-sm', 'id' => 'w3-city', 'placeholder' => 'City']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row customFormRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-state', 'State', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::select('state', ['' => 'Please Select State'] + $states, $patient['patientDetail'] ? $patient['patientDetail']->state : '', ['class' => 'form-control input', 'id' => 'state']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-zip', 'Zip Code', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('zipCode', $patient['patientDetail']->zipCode, ['class' => 'form-control input', 'id' => 'zipCode', 'placeholder' => 'Zip Code', 'maxlength' => '15', 'minlength' => '6']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row customFormRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-homePhone', 'Home Phone', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('phone', $patient['patientDetail']->phone, ['class' => 'form-control', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-mobile', 'Mobile', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('mobile', $patient['patientDetail']->mobile, ['class' => 'form-control input-sm', 'id' => 'w3-mobile', 'placeholder' => 'Mobile Number']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row customFormRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-call', 'Best Time To Call', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        <?php $patientCallHour = callHourTime(); ?>
                                        {{ Form::select('call_time', ['' => 'Please Select Best Time To Call'] + $patientCallHour, $patient['patientDetail'] ? $patient['patientDetail']->call_time : '', ['class' => 'form-control input', 'id' => 'bestTime']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('driving_license', 'Driving License', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">                                   
                                        {{ Form::file('driving_license', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>	
                            </div>
                        </div>
                        <div class="row customFormRow">
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    {{ Form::label('w3-work', 'Work', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('employer', $patient['patientDetail']->employer, ['class' => 'form-control input-sm', 'id' => 'w3-work', 'placeholder' => 'Work']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    {{ Form::label('w3-employment', 'Place of Employment', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('employment_place', $patient['patientDetail']->employment_place, ['class' => 'form-control input-sm', 'id' => 'w3-employment', 'placeholder' => 'place of Employment']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row customFormRow">
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    {{ Form::label('w3-occupation', 'Occupation', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('occupation', $patient['patientDetail']->occupation, ['class' => 'form-control input-sm', 'id' => 'w3-occupation', 'placeholder' => 'Occupation']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row customFormRow">  
                            <div class="form-group">
                                {{ Form::label('w3-height', 'Height & Weight', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-4">
                                    <?php $commonHeight = commonHeight(); ?>
                                    {{ Form::select('height', ['' => 'Please Select The Height'] + $commonHeight, $patient['patientDetail'] ? $patient['patientDetail']->height : '', ['class' => 'form-control input', 'id' => 'height']) }}
                                </div>
                                <div class="col-sm-4">
                                    <?php $commonWeight = commonWeight(); ?>
                                    {{ Form::select('weight', ['' => 'Please Select The Weight'] + $commonWeight, $patient['patientDetail'] ? $patient['patientDetail']->weight : '', ['class' => 'form-control input', 'id' => 'weight']) }}
                                </div>
                            </div>
                        </div>

                        <div class="row customFormRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-physician', 'Primary Physician', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('primary_physician', $patient['patientDetail']->primary_physician, ['class' => 'form-control input-sm', 'id' => 'w3-physician', 'placeholder' => 'Primary Care Physician Name']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('w3-physician_phone', 'Physician Phone', array('class' => 'col-sm-4 control-label')) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('physician_phone', $patient['patientDetail']->physician_phone, ['class' => 'form-control input-sm phone', 'placeholder' => 'Physician Phone']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="w3-billing" class="tab-pane">
                        <div class="col-sm-12 questionRadio"> 
                            <div class="form-group">							
                                {{ Form::label('libido_rate', 'How would you rate your libido (sex drive)?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('libido_rate', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('libido_rate', '1', $adamsQuestionaires && $adamsQuestionaires->libido_rate == 1, ['id' => 'libido_rate1']) }}
                                        {{ Form::label('libido_rate1', 'Terrible') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('libido_rate', '2', $adamsQuestionaires && $adamsQuestionaires->libido_rate == 2, ['id' => 'libido_rate2']) }}
                                        {{ Form::label('libido_rate2', 'Poor') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('libido_rate', '3', $adamsQuestionaires && $adamsQuestionaires->libido_rate == 3, ['id' => 'libido_rate3']) }}
                                        {{ Form::label('libido_rate3', 'Average') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('libido_rate', '4', $adamsQuestionaires && $adamsQuestionaires->libido_rate == 4, ['id' => 'libido_rate4']) }}
                                        {{ Form::label('libido_rate4', 'Good') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('libido_rate', '5', $adamsQuestionaires && $adamsQuestionaires->libido_rate == 5, ['id' => 'libido_rate5']) }}
                                        {{ Form::label('libido_rate5', 'Exellent') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                          
                            <div class="form-group">
                                {{ Form::label('energy_rate', 'How are you rate your energy level?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('energy_rate', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('energy_rate', '1', $adamsQuestionaires && $adamsQuestionaires->energy_rate == 1, ['id' => 'energy_rate1']) }}
                                        {{ Form::label('energy_rate1', 'Terrible') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('energy_rate', '2', $adamsQuestionaires && $adamsQuestionaires->energy_rate == 2, ['id' => 'energy_rate2']) }}
                                        {{ Form::label('energy_rate2', 'Poor') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('energy_rate', '3', $adamsQuestionaires && $adamsQuestionaires->energy_rate == 3, ['id' => 'energy_rate3']) }}
                                        {{ Form::label('energy_rate3', 'Average') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('energy_rate', '4', $adamsQuestionaires && $adamsQuestionaires->energy_rate == 4, ['id' => 'energy_rate4']) }}
                                        {{ Form::label('energy_rate4', 'Good') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('energy_rate', '5', $adamsQuestionaires && $adamsQuestionaires->energy_rate == 5, ['id' => 'energy_rate5']) }}
                                        {{ Form::label('energy_rate5', 'Exellent') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div> 
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('strength_rate', 'How are you rate your strength/endurance?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('strength_rate', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('strength_rate', '1', $adamsQuestionaires && $adamsQuestionaires->strength_rate == 1, ['id' => 'strength_rate1']) }}
                                        {{ Form::label('strength_rate1', 'Terrible') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('strength_rate', '2', $adamsQuestionaires && $adamsQuestionaires->strength_rate == 2, ['id' => 'strength_rate2']) }}
                                        {{ Form::label('strength_rate2', 'Poor') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('strength_rate', '3', $adamsQuestionaires && $adamsQuestionaires->strength_rate == 3, ['id' => 'strength_rate3']) }}
                                        {{ Form::label('strength_rate3', 'Average') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('strength_rate', '4', $adamsQuestionaires && $adamsQuestionaires->strength_rate == 4, ['id' => 'strength_rate4']) }}
                                        {{ Form::label('strength_rate4', 'Good') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('strength_rate', '5', $adamsQuestionaires && $adamsQuestionaires->strength_rate == 5, ['id' => 'strength_rate5']) }}
                                        {{ Form::label('strength_rate5', 'Exellent') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div> 
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('enjoy_rate', 'How are you rate your enjoyment of life?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('enjoy_rate', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('enjoy_rate', '1', $adamsQuestionaires && $adamsQuestionaires->enjoy_rate == 1, ['id' => 'enjoy_rate1']) }}
                                        {{ Form::label('enjoy_rate1', 'Terrible') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('enjoy_rate', '2', $adamsQuestionaires && $adamsQuestionaires->enjoy_rate == 2, ['id' => 'enjoy_rate2']) }}
                                        {{ Form::label('enjoy_rate2', 'Poor') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('enjoy_rate', '3', $adamsQuestionaires && $adamsQuestionaires->enjoy_rate == 3, ['id' => 'enjoy_rate3']) }}
                                        {{ Form::label('enjoy_rate3', 'Average') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('enjoy_rate', '4', $adamsQuestionaires && $adamsQuestionaires->enjoy_rate == 4, ['id' => 'enjoy_rate4']) }}
                                        {{ Form::label('enjoy_rate4', 'Good') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('enjoy_rate', '5', $adamsQuestionaires && $adamsQuestionaires->enjoy_rate == 5, ['id' => 'enjoy_rate5']) }}
                                        {{ Form::label('enjoy_rate5', 'Exellent') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div> 
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('happiness_rate', 'How are you at your happiness level?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('happiness_rate', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('happiness_rate', '1', $adamsQuestionaires && $adamsQuestionaires->happiness_rate == 1, ['id' => 'happiness_rate1']) }}
                                        {{ Form::label('happiness_rate1', 'Terrible') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('happiness_rate', '2', $adamsQuestionaires && $adamsQuestionaires->happiness_rate == 2, ['id' => 'happiness_rate2']) }}
                                        {{ Form::label('happiness_rate2', 'Poor') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('happiness_rate', '3', $adamsQuestionaires && $adamsQuestionaires->happiness_rate == 3, ['id' => 'happiness_rate3']) }}
                                        {{ Form::label('happiness_rate3', 'Average') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('happiness_rate', '4', $adamsQuestionaires && $adamsQuestionaires->happiness_rate == 4, ['id' => 'happiness_rate4']) }}
                                        {{ Form::label('happiness_rate4', 'Good') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('happiness_rate', '5', $adamsQuestionaires && $adamsQuestionaires->happiness_rate == 5, ['id' => 'happiness_rate5']) }}
                                        {{ Form::label('happiness_rate5', 'Exellent') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div> 
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('erection_rate', 'How strong are your erections?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('erection_rate', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('erection_rate', '1', $adamsQuestionaires && $adamsQuestionaires->erection_rate == 1, ['id' => 'erection_rate1']) }}
                                        {{ Form::label('erection_rate1', 'Poor') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('erection_rate', '2', $adamsQuestionaires && $adamsQuestionaires->erection_rate == 2, ['id' => 'erection_rate2']) }}
                                        {{ Form::label('erection_rate2', 'Weak') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('erection_rate', '3', $adamsQuestionaires && $adamsQuestionaires->erection_rate == 3, ['id' => 'erection_rate3']) }}
                                        {{ Form::label('erection_rate3', 'Average') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('erection_rate', '4', $adamsQuestionaires && $adamsQuestionaires->erection_rate == 4, ['id' => 'erection_rate4']) }}
                                        {{ Form::label('erection_rate4', 'Strong') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('erection_rate', '5', $adamsQuestionaires && $adamsQuestionaires->erection_rate == 5, ['id' => 'erection_rate5']) }}
                                        {{ Form::label('erection_rate5', 'Very Strong') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div> 
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('performance_rate', 'How are you at your work performance over the last four weeks?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('performance_rate', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('performance_rate', '1', $adamsQuestionaires && $adamsQuestionaires->performance_rate == 1, ['id' => 'performance_rate1']) }}
                                        {{ Form::label('performance_rate1', 'Terrible') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('performance_rate', '2', $adamsQuestionaires && $adamsQuestionaires->performance_rate == 2, ['id' => 'performance_rate2']) }}
                                        {{ Form::label('performance_rate2', 'Poor') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('performance_rate', '3', $adamsQuestionaires && $adamsQuestionaires->performance_rate == 3, ['id' => 'performance_rate3']) }}
                                        {{ Form::label('performance_rate3', 'Average') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('performance_rate', '4', $adamsQuestionaires && $adamsQuestionaires->performance_rate == 4, ['id' => 'performance_rate4']) }}
                                        {{ Form::label('performance_rate4', 'Good') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('performance_rate', '5', $adamsQuestionaires && $adamsQuestionaires->performance_rate == 5, ['id' => 'performance_rate5']) }}
                                        {{ Form::label('performance_rate5', 'Exellent') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div> 
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('sleep_rate', 'How often do you fall asleep after dinner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('sleep_rate', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('sleep_rate', '1', $adamsQuestionaires && $adamsQuestionaires->sleep_rate == 1, ['id' => 'sleep_rate1']) }}
                                        {{ Form::label('sleep_rate1', 'Terrible') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('sleep_rate', '2', $adamsQuestionaires && $adamsQuestionaires->sleep_rate == 2, ['id' => 'sleep_rate2']) }}
                                        {{ Form::label('sleep_rate2', 'Poor') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('sleep_rate', '3', $adamsQuestionaires && $adamsQuestionaires->sleep_rate == 3, ['id' => 'sleep_rate3']) }}
                                        {{ Form::label('sleep_rate3', 'Average') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('sleep_rate', '4', $adamsQuestionaires && $adamsQuestionaires->sleep_rate == 4, ['id' => 'sleep_rate']) }}
                                        {{ Form::label('sleep_rate4', 'Good') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('sleep_rate', '5', $adamsQuestionaires && $adamsQuestionaires->sleep_rate == 5, ['id' => 'sleep_rate5']) }}
                                        {{ Form::label('sleep_rate5', 'Exellent') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div> 
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('sport_rate', 'How would you rate your sports ability over the past four weeks?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('sport_rate', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('sport_rate', '1', $adamsQuestionaires && $adamsQuestionaires->sport_rate == 1, ['id' => 'sport_rate1']) }}
                                        {{ Form::label('sport_rate1', 'Terrible') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('sport_rate', '2', $adamsQuestionaires && $adamsQuestionaires->sport_rate == 2, ['id' => 'sport_rate2']) }}
                                        {{ Form::label('sport_rate2', 'Poor') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('sport_rate', '3', $adamsQuestionaires && $adamsQuestionaires->sport_rate == 3, ['id' => 'sport_rate3']) }}
                                        {{ Form::label('sport_rate3', 'Average') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('sport_rate', '4', $adamsQuestionaires && $adamsQuestionaires->sport_rate == 4, ['id' => 'sport_rate4']) }}
                                        {{ Form::label('sport_rate4', 'Good') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('sport_rate', '5', $adamsQuestionaires && $adamsQuestionaires->sport_rate == 5, ['id' => 'sport_rate5']) }}
                                        {{ Form::label('sport_rate5', 'Exellent') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div> 
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('lost_height_rate', 'How much height have you lost?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('lost_height_rate', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('lost_height_rate', '1', $adamsQuestionaires && $adamsQuestionaires->lost_height_rate == 1, ['id' => 'lost_height_rate1']) }}
                                        {{ Form::label('lost_height_rate1', '2" or More') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('lost_height_rate', '2', $adamsQuestionaires && $adamsQuestionaires->lost_height_rate == 2, ['id' => 'lost_height_rate2']) }}
                                        {{ Form::label('lost_height_rate2', '1.5 - 1.9"') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('lost_height_rate', '3', false, ['id' => 'lost_height_rate3']) }}
                                        {{ Form::label('lost_height_rate3', '1 - 1.4"') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('lost_height_rate', '4', $adamsQuestionaires && $adamsQuestionaires->lost_height_rate == 3, ['id' => 'lost_height_rate4']) }}
                                        {{ Form::label('lost_height_rate4', '.5 - .9"') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('lost_height_rate', '5', $adamsQuestionaires && $adamsQuestionaires->lost_height_rate == 4, ['id' => 'lost_height_rate5']) }}
                                        {{ Form::label('lost_height_rate5', '0 - .4"') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div> 

                    </div>
                    <div id="w3-medical" class="tab-pane">
				
						<div class="form-group">
							{{ Form::label('medical_title', 'Why are you coming to see us, or why are you today?', array('class' => 'col-sm-5 control-label medicalTitle')) }}
							<div class="col-sm-12">
								@foreach($diseases as $i => $v)
								<div class="col-sm-6">
									<div class="checkbox-custom chekbox-primary reason_disease">
										{{ Form::checkbox('reason-'.$i, $i, in_array($i, $disease_id), ['id' => 'reason-'.$i, 'data-target' => '#disease-form-box-'.$i]) }}
										{{ Form::label('reason-'.$i, $v) }}
									</div>
								</div>
								@endforeach
							</div>
						</div> 
							
						<?php 
						$splChars = ['\\', '/', ':', '*', '?', '"', '<', '>', '|', ' '];
						$replace = ['','','','','','','','','','_'];
						?>
						<!-- Tab panes -->
						<div class="tab-content" style="padding:0">
							@foreach($diseases as $i => $v)
								<div class="hidden row {{ str_replace($splChars, $replace, strtolower($v)) }}" id="disease-form-box-{{ $i }}">
									@include('appointment.medical.'.str_replace($splChars, $replace, strtolower($v)))
								</div>
							@endforeach		
						</div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="toggle" data-plugin-toggle>
                                    <section class="toggle active">
                                        {{ Form::label('medical_title', 'Family Medical History') }}
                                        <div class="toggle-content">
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('cardiovascular', 'Cardiovascular Disease', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('cardiovascular', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('cardiovascular', '1', $medHistories && $medHistories->cardiovascular == '1', ['id' => 'cardio1']) }}
                                                                {{ Form::label('cardio1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('cardiovascular', '0', $medHistories && $medHistories->cardiovascular == '0', ['id' => 'cardio2']) }}
                                                                {{ Form::label('cardio2', 'No') }}
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('hypertension', 'Hypertension', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('hypertension', '',  true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('hypertension', '1', $medHistories && $medHistories->hypertension == '1', ['id' => 'hyper1']) }}
                                                                {{ Form::label('hyper1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('hypertension', '0', $medHistories && $medHistories->hypertension == '0', ['id' => 'hyper2']) }}
                                                                {{ Form::label('hyper2', 'No') }}
                                                            </div>                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('enocrine', 'Diabetes, Thyroid, or other Enocrine Disorder', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('enocrine_disorder', '', true, ['class' => 'hidden']) }}
																{{ Form::radio('enocrine_disorder', '1', $medHistories && $medHistories->enocrine_disorder == '1', ['id' => 'encorine1']) }}
                                                                {{ Form::label('encorine1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('enocrine_disorder', '0', $medHistories && $medHistories->enocrine_disorder == '0', ['id' => 'encorine2']) }}
                                                                {{ Form::label('encorine2', 'No') }}
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('prostate', 'Prostate Cancer', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('prostate', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('prostate', '1', $medHistories && $medHistories->enocrine_disorder == '1', ['id' => 'prostate1']) }}
                                                                {{ Form::label('prostate1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('prostate', '0', $medHistories && $medHistories->enocrine_disorder == '0', ['id' => 'prostate2']) }}
                                                                {{ Form::label('prostate2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('lipid', 'Lipid or Blood Disorder', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('lipid', '', true, ['class' => 'hidden']) }}															
                                                                {{ Form::radio('lipid', '1', $medHistories && $medHistories->lipid == '1', ['id' => 'lipid1']) }}
                                                                {{ Form::label('lipid1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('lipid', '0', $medHistories && $medHistories->lipid == '0', ['id' => 'lipid2']) }}
                                                                {{ Form::label('lipid2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('cancer_forms', 'Other Forms of Cancer', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('cancer_form', '', true, ['class' => 'hidden']) }}															
                                                                {{ Form::radio('cancer_form', '1', $medHistories && $medHistories->cancer_form == '1', ['id' => 'cancer1']) }}
                                                                {{ Form::label('cancer1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('cancer_form', '0', $medHistories && $medHistories->cancer_form == '0', ['id' => 'cancer2']) }}
                                                                {{ Form::label('cancer2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </section>
                                    <section class="toggle">
                                        <label>Lifestyle Information</label>
                                        <div class="toggle-content">
                                            <div class="col-sm-12 inputRow">
                                                <div class="form-group">
                                                    {{ Form::label('smoke', 'Do You Smoke.  If Yes How Often How Much?', ['class' => 'col-sm-6 control-label']) }}
                                                    <div class="col-sm-6 toggle-radio-custom">
                                                        <div class="col-sm-3 radio-custom radio-primary">
															{{ Form::radio('smoke_status', '', true, ['class' => 'hidden']) }}														
                                                            {{ Form::radio('smoke_status', '1', $medHistories && $medHistories->smoke_status == '1', ['id' => 'smoke1']) }}
                                                            {{ Form::label('smoke1', 'Yes') }}
                                                        </div>
                                                        <div class="col-sm-3 radio-custom radio-primary">
                                                            {{ Form::radio('smoke_status', '0', $medHistories && $medHistories->smoke_status == '0', ['id' => 'smoke2']) }}
                                                            {{ Form::label('smoke2', 'No') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow selectSmoke">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('smoke_often', 'How often?', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6">
                                                            <?php $drinkTime = [ 'Daily' => 'Daily', 'Occasionally' => 'Occasionally']; 
															?>
                                                            {{ Form::select('smoke_often', ['' => 'Please Select'] + $drinkTime, $medHistories? $medHistories->smoke_often : '', ['class' => 'form-control input']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('smoke_quantity', 'How much?', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6">
                                                            <?php $smokedose = [ 'less than 1 pack' => 'less than 1 pack', '1 pack' => '1 pack', '2 packs' => '2 packs', 'over 2 packs' => 'over 2 packs']; ?>
                                                            {{ Form::select('smoke_quantity', ['' => 'Please Select'] + $smokedose, $medHistories ? $medHistories->smoke_quantity : '', ['class' => 'form-control input']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="form-group">
                                                    {{ Form::label('drink_status', 'Do You Drink.  If Yes How Often How Much?', ['class' => 'col-sm-6 control-label']) }}
                                                    <div class="col-sm-6 toggle-radio-custom">
                                                        <div class="col-sm-3 radio-custom radio-primary">
															{{ Form::radio('drink_status', '', true, ['class' => 'hidden']) }}														
                                                            {{ Form::radio('drink_status', '1', $medHistories && $medHistories->drink_status == '1', ['id' => 'drink1']) }}
                                                            {{ Form::label('drink1', 'Yes') }}                                                            
                                                        </div>
                                                        <div class="col-sm-3 radio-custom radio-primary">
                                                            {{ Form::radio('drink_status', '0', $medHistories && $medHistories->drink_status == '0', ['id' => 'drink2']) }}
                                                            {{ Form::label('drink2', 'No') }}
                                                        </div>
                                                    </div>
                                                </div>                                      
                                            </div>
                                            <div class="col-sm-12 inputRow selectDrink">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('drink_often', 'How often?', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6">
															{{ Form::radio('prostate', '', true, ['class' => 'hidden']) }}
                                                            {{ Form::select('drink_often', ['' => 'Please Select'] + $drinkTime, $medHistories ? $medHistories->drink_often : '', ['class' => 'form-control input', 'id' => 'drink_often']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('drink_quantity', 'How much?', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6">
                                                            <?php $drinkdose = [ 'less than 1 drink' => 'less than 1 drink', '1 drink' => '1 drink', '2 drinks' => '2 drinks', 'over 2 drinks' => 'Over 2 drinks']; ?>
                                                            {{ Form::select('drink_quantity', ['' => 'Please Select'] + $drinkdose, $medHistories ? $medHistories->drink_quantity : '', ['class' => 'form-control input', 'id' => 'drink_quantity']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="form-group">
                                                    {{ Form::label('activity_level', 'Please Rate Your Daily Activity Level', ['class' => 'col-sm-6 control-label']) }}
                                                    <div class="col-sm-6">
                                                        <?php $activityLevel = [ 'Heavy' => 'Heavy', 'Medium' => 'Medium', 'Low' => 'Low']; ?>
                                                        {{ Form::select('activity_level', ['' => 'Please Select'] + $activityLevel, $medHistories ? $medHistories->activity_level : '', ['class' => 'form-control input', 'id' => 'activity_level']) }}
                                                    </div>
                                                </div>                                      
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('exercise_status', 'Do you Exercise? If So How Often?', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('exercise_status', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('exercise_status', '1', $medHistories && $medHistories->exercise_status == '1', ['id' => 'exercise1']) }}
                                                                {{ Form::label('exercise1', 'Yes') }}                                                                
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('exercise_status', '0', $medHistories && $medHistories->exercise_status == '0', ['id' => 'exercise2']) }}
                                                                {{ Form::label('exercise2', 'No') }}
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 selectExercise">
                                                    <div class="form-group">
                                                        {{ Form::label('exercise_often', 'How Often?', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6">
                                                            <?php $exercise = [ 'Daily' => 'daily', 'Weekly' => 'Weekly', '<Monthly' => 'less than Monthly', 'Monthly' => 'Monthly']; ?>
                                                            {{ Form::select('exercise_often', ['' => 'Please Select'] + $exercise, $medHistories ? $medHistories->exercise_often : '', ['class' => 'form-control input']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="toggle">
                                        {{ Form::label('diagnose', 'Diagnosed History Of Disease') }}
                                        <div class="toggle-content">
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('deficiency', 'Any Known Deficiency Including Minerals and Electrolytes', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('deficiency_status', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('deficiency_status', '1', $medHistories && $medHistories->deficiency_status == '1', ['id' => 'deficiency1']) }}
                                                                {{ Form::label('deficiency1', 'Yes') }}  
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('deficiency_status', '0', $medHistories && $medHistories->deficiency_status == '0', ['id' => 'deficiency2']) }}
                                                                {{ Form::label('deficiency2', 'No') }}
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('chemical', 'Chemical Dependency', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('chemical_dependency', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('chemical_dependency', '1', $medHistories && $medHistories->chemical_dependency == '1', ['id' => 'dependency1']) }}
                                                                {{ Form::label('dependency1', 'Yes') }}  
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('chemical_dependency', '0', $medHistories && $medHistories->chemical_dependency == '0', ['id' => 'dependency2']) }}
                                                                {{ Form::label('dependency2', 'No') }}  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('blood', 'Blood Disorders', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('blood_disorder', '',true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('blood_disorder', '1', $medHistories && $medHistories->blood_disorder == '1', ['id' => 'blood1']) }}
                                                                {{ Form::label('blood1', 'Yes') }} 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('blood_disorder', '0', $medHistories && $medHistories->blood_disorder == '0', ['id' => 'blood2']) }}
                                                                {{ Form::label('blood2', 'No') }} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('orthopedic', 'Orthopedic or muscle disorder including fracture or Joint disorders.', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('orthopedic_disorder', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('orthopedic_disorder', '1', $medHistories && $medHistories->orthopedic_disorder == '1', ['id' => 'ortho1']) }}
                                                                {{ Form::label('ortho1', 'Yes') }} 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('orthopedic_disorder', '0', $medHistories && $medHistories->orthopedic_disorder == '0', ['id' => 'ortho2']) }}
                                                                {{ Form::label('ortho2', 'No') }} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('deficiency', 'Any Known Deficiency Including Minerals and Electrolytes', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('known_deficiency', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('known_deficiency', '1', $medHistories && $medHistories->known_deficiency == '1', ['id' => 'known1']) }}
                                                                {{ Form::label('known1', 'Yes') }} 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('known_deficiency', '0', $medHistories && $medHistories->known_deficiency == '0', ['id' => 'known2']) }}
                                                                {{ Form::label('known2', 'No') }} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('carpal', 'Carpal Tunnel Syndrome', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('carpal_syndrome', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('carpal_syndrome', '1', $medHistories && $medHistories->carpal_syndrome == '1', ['id' => 'carpal1']) }}
                                                                {{ Form::label('carpal1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('carpal_syndrome', '0', $medHistories && $medHistories->carpal_syndrome == '0', ['id' => 'carpal2']) }}
                                                                {{ Form::label('carpal2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('Immune', 'Immune Disorders ', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('immune_disorder', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('immune_disorder', '1', $medHistories && $medHistories->immune_disorder == '1', ['id' => 'immune1']) }}
                                                                {{ Form::label('immune1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('immune_disorder', '0', $medHistories && $medHistories->immune_disorder == '0', ['id' => 'immune2']) }}
                                                                {{ Form::label('immune2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('heart', 'Heart disease including Atheroscelerosis, Angina, Heart Failure, or Heart Attack', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('heart_disease', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('heart_disease', '1', $medHistories && $medHistories->heart_disease == '1', ['id' => 'heart1']) }}
                                                                {{ Form::label('heart1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('heart_disease', '0', $medHistories && $medHistories->heart_disease == '0', ['id' => 'heart2']) }}
                                                                {{ Form::label('heart2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('lung', 'Lung Disorders', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('lung_disorder', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('lung_disorder', '1', $medHistories && $medHistories->lung_disorder == '1', ['id' => 'lung1']) }}
                                                                {{ Form::label('lung1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('lung_disorder', '0', $medHistories && $medHistories->lung_disorder == '0', ['id' => 'lung2']) }}
                                                                {{ Form::label('lung2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('cancers', 'Cancers', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('cancer_status', '',true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('cancer_status', '1', $medHistories && $medHistories->cancer_status == '1', ['id' => 'cancer1']) }}
                                                                {{ Form::label('cancer1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('cancer_status', '0', $medHistories && $medHistories->cancer_status == '0', ['id' => 'cancer2']) }}
                                                                {{ Form::label('cancer2', 'No') }}                                                                
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('surgeries', 'Major Surgeries', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('surgeries', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('surgeries', '1', $medHistories && $medHistories->surgeries == '1', ['id' => 'surgeries1', 'class' => 'modelShow']) }}
                                                                {{ Form::label('surgeries1', 'Yes') }}                                                                
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('surgeries', '0', $medHistories && $medHistories->surgeries == '0', ['id' => 'surgeries2']) }}
                                                                {{ Form::label('surgeries2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('renal', 'Renal Disease (Kidneys)', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('renal', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('renal', '1', $medHistories && $medHistories->renal == '1', ['id' => 'renal1']) }}
                                                                {{ Form::label('renal1', 'Yes') }} 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('renal', '0', $medHistories && $medHistories->renal == '0', ['id' => 'renal2']) }}
                                                                {{ Form::label('renal2', 'No') }} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('upper', 'Upper Respitory Problems', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('upper', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('upper', '1', $medHistories && $medHistories->upper == '1', ['id' => 'upper1']) }}
                                                                {{ Form::label('upper1', 'Yes') }} 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('upper', '0', $medHistories && $medHistories->upper == '0', ['id' => 'upper2']) }}
                                                                {{ Form::label('upper2', 'No') }} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('allergies', 'Allergies to Medications', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('allergies', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('allergies', '1', $medHistories && $medHistories->allergies == '1', ['id' => 'allergies1', 'class' => 'modelShow']) }}
                                                                {{ Form::label('allergies1', 'Yes') }}                                                                 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('allergies', '0', $medHistories && $medHistories->allergies == '0', ['id' => 'allergies2']) }}
                                                                {{ Form::label('allergies2', 'No') }} 
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('genital', 'Genital - Urinary Disorder', ['class' => 'col-sm-6 control-label']) }}
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('genital', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('genital', '1', $medHistories && $medHistories->genital == '1', ['id' => 'genital1']) }}
                                                                {{ Form::label('genital1', 'Yes') }} 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('genital', '0', $medHistories && $medHistories->genital == '0', ['id' => 'genital2']) }}
                                                                {{ Form::label('genital2', 'No') }} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('retention', 'Edema / Excess fluid retention', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">                                                            
																{{ Form::radio('retention', '', true, ['class' => 'hidden']) }}		
                                                                {{ Form::radio('retention', '1', $medHistories && $medHistories->retention == '1', ['id' => 'retention1']) }}
                                                                {{ Form::label('retention', 'Yes') }} 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('retention', '0', $medHistories && $medHistories->retention == '0', ['id' => 'retention2']) }}
                                                                {{ Form::label('retention2', 'No') }} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('endocrine', 'Thyroid, Diabetes or other endocrine disorder including insulin resistance', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('endocrine', '',true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('endocrine', '1', $medHistories && $medHistories->endocrine == '1', ['id' => 'endocrine1']) }}
                                                                {{ Form::label('endocrine1', 'Yes') }} 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('endocrine', '0', $medHistories && $medHistories->endocrine == '0', ['id' => 'endocrine2']) }}
                                                                {{ Form::label('endocrine2', 'No') }} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('hyperlipidemia', 'Hyperlipidemia (Cholesterol)', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('hyperlipidema', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('hyperlipidema', '1', $medHistories && $medHistories->hyperlipidema == '1', ['id' => 'hyperlipidema1']) }}
                                                                {{ Form::label('hyperlipidema1', 'Yes') }} 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('hyperlipidema', '0', $medHistories && $medHistories->hyperlipidema == '0', ['id' => 'hyperlipidema2']) }}
                                                                {{ Form::label('hyperlipidema2', 'No') }} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('healing', 'Poor Wound Healing', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('healing', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('healing', '1',  $medHistories && $medHistories->healing == '1', ['id' => 'healing1']) }}
                                                                {{ Form::label('healing1', 'Yes') }} 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('healing', '0',  $medHistories && $medHistories->healing == '0', ['id' => 'healing2']) }}
                                                                {{ Form::label('healing2', 'No') }} 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('neuro', 'Neurological Disorders', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('neurological', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('neurological', '1', $medHistories && $medHistories->neurological == '1', ['id' => 'neurological1']) }}
                                                                {{ Form::label('neurological1', 'Yes') }}                                                                 
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('neurological', '0', $medHistories && $medHistories->neurological == '0', ['id' => 'neurological2']) }}
                                                                {{ Form::label('neurological2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('emotional', 'Emotional disorders / Depression', ['class' => 'col-sm-6 control-label']) }}                                                                                                                
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">    
																{{ Form::radio('emotional', '', true, ['class' => 'hidden']) }}															
                                                                {{ Form::radio('emotional', '1', $medHistories && $medHistories->emotional == '1', ['id' => 'emotional1']) }}
                                                                {{ Form::label('emotional1', 'Yes') }}                    
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">                                                   
                                                                {{ Form::radio('emotional', '0', $medHistories && $medHistories->emotional == '0', ['id' => 'emotional2']) }}
                                                                {{ Form::label('emotional2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('Hypertention', 'Hypertention(High Blood Pressure)', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('hypertention_hbp', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('hypertention_hbp', '1', $medHistories && $medHistories->hypertention_hbp == '1', ['id' => 'hypertention1']) }}
                                                                {{ Form::label('hypertention1', 'Yes') }}   
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('hypertention_hbp', '0', $medHistories && $medHistories->hypertention_hbp == '0', ['id' => 'hypertention2']) }}
                                                                {{ Form::label('hypertention2', 'No') }}  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('illness', 'Other Illnesses', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('other_illness', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('other_illness', '1',  $medHistories && $medHistories->other_illness == '1', ['id' => 'illness1', 'class' => 'modelShow']) }}
                                                                {{ Form::label('illness1', 'yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('other_illness', '0',  $medHistories && $medHistories->other_illness == '0', ['id' => 'illness2']) }}
                                                                {{ Form::label('illness2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('arthritis', 'Arthritis', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('arthritis', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('arthritis', '1', $medHistories && $medHistories->arthritis == '1', ['id' => 'arthritis1']) }}
                                                                {{ Form::label('arthritis1', 'Yes') }}                                                                
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('arthritis', '0', $medHistories && $medHistories->arthritis == '0', ['id' => 'arthritis2']) }}
                                                                {{ Form::label('arthritis2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('drugs', 'Do you use any form of Recreational Drugs?', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('recreational_drug', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('recreational_drug', '1', $medHistories && $medHistories->recreational_drug == '1', ['id' => 'recreational_drug1']) }}
                                                                {{ Form::label('recreational_drug1', 'Yes') }}                                                                
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('recreational_drug', '0', $medHistories && $medHistories->recreational_drug == '0', ['id' => 'recreational_drug2']) }}
                                                                {{ Form::label('recreational_drug2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('neurological', 'Neurological Disorders', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('neurological', '',true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('neurological', '1', $medHistories && $medHistories->neurological == '1', ['id' => 'neurological1']) }}
                                                                {{ Form::label('neurological1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('neurological', '0', $medHistories && $medHistories->neurological == '0', ['id' => 'neurological2']) }}
                                                                {{ Form::label('neurological2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">                                               
                                                <div class="form-group">
                                                    {{ Form::label('blood_test', 'When was the last time you had a comprehensive Blood Test or Blood Test of anykind?', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                    <div class="col-sm-6">
                                                        <?php $bloodTestTime = ['1 Month' => '1 Month', '3 Months' => '3 Months', '6 Months' => '6 Months', '>1' => '1 Year or Longer', 'Never' => 'Never']; ?>
                                                        {{ Form::select('blood_test', ['' => 'Please Select'] + $bloodTestTime, $medHistories ? $medHistories->blood_test : '', ['class' => 'form-control input', 'id' => 'blood_test']) }}
                                                    </div>
                                                </div>                                      
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">					
                                                        {{ Form::label('health_isurance', 'Do you have any form of Health Insurance?', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('health_insurance', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('health_insurance', '1', $medHistories && $medHistories->health_insurance == '1', ['id' => 'health_insurance1']) }}
                                                                {{ Form::label('health_insurance1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('health_insurance', '0', $medHistories && $medHistories->health_insurance == '0', ['id' => 'health_insurance2']) }}
                                                                {{ Form::label('health_insurance2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('kind', 'Kind of Health Insurance', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6">
                                                            <?php $insuranceKind = ['Medicare' => 'Medicare', 'HMO' => 'HMO', 'PPO' => 'PPO', 'Medicaid' => 'Medicaid']; ?>
                                                            {{ Form::select('kind_of_hi', ['' => 'Please Select'] + $insuranceKind, $medHistories ? $medHistories->kind_of_hi : '', ['class' => 'form-control input', 'id' => 'kind_of_hi']) }}
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-sm-12 inputRow">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        {{ Form::label('medication', 'Are you Currently Taking Any Medications?', ['class' => 'col-sm-6 control-label']) }}                                                        
                                                        <div class="col-sm-6 toggle-radio-custom">
                                                            <div class="col-sm-3 radio-custom radio-primary">
																{{ Form::radio('medication', '', true, ['class' => 'hidden']) }}
                                                                {{ Form::radio('medication', '1', $medHistories && $medHistories->medication == '1', ['id' => 'medication1', 'class' => 'modelShow']) }}
                                                                {{ Form::label('medication1', 'Yes') }}
                                                            </div>
                                                            <div class="col-sm-3 radio-custom radio-primary">
                                                                {{ Form::radio('medication', '0', $medHistories && $medHistories->medication == '0', ['id' => 'medication2']) }}
                                                                {{ Form::label('medication2', 'No') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="panel-footer">
                <ul class="pager">
                    <li class="previous disabled">
                        <a><i class="fa fa-angle-left"></i> Previous</a>
                    </li>
                    <li class="finish hidden pull-right">
                        <a>Submit</a>
                    </li>
                    <li class="next">
                        <a>Next <i class="fa fa-angle-right"></i></a>
                    </li>
                </ul>
            </div>
        </section>

    </div>
    <div id="common_modal" class="modal-block modal-block-primary mfp-hide">
        <section class="panel panel-primary" id="listContent"></section>
    </div>
@if(empty(Request::segment(4)) || empty(Request::segment(5))) 
</section>
@endif
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
	var Appointment = {};
    $(document).ready(function() {
		$('.selectSmoke').hide();
		if($("input[name='smoke_status']:checked").val() == 1){
			$('.selectSmoke').show();
		}
	
        $('.selectDrink').hide();
        if($("input[name='drink_status']:checked").val() == 1){
			$('.selectDrink').show();
		}
		
        $('.selectExercise').hide();
        if($("input[name='exercise_status']:checked").val() == 1){
			$('.selectExercise').show();
		}
		
        $('.selectSex').hide();
        if($("input[name='sex_status']:checked").val() == 1){
			$('.selectSex').show();
		}
		
		Appointment.reasonArray = [];

		// show tab corresponding to checkbox checked
		var reason_disease = $(".reason_disease");
		$.each(reason_disease, function(i,v){
			input = $(v).find('input');
			if($(input).prop('checked')){
				id = $(input).data('target');
				$(id).removeClass('hidden');
				$('#disease_id').remove();
				Appointment.reasonArray.push(parseInt($(input).val()));
			}
		});
		var reasonArrayData = JSON.stringify(Appointment.reasonArray);
		if(reasonArrayData.length > 0){
			$(input).closest('.form-group').append('<input type="hidden" id="disease_id" name="disease_id" value="'+reasonArrayData+'">');				
		}		

		$(".reason_disease").find('input').on('click',function(){
			var id = $(this).data('target');
			var val = parseInt($(this).val());
			if($(this).prop('checked')){
				$(id).removeClass('hidden');
				Appointment.reasonArray.push(val);
			} else{
				$(id).addClass('hidden');
				Appointment.reasonArray = $.grep(Appointment.reasonArray, function(value){
											return value != val;
										});
			}			
			$('#disease_id').remove();
			var reasonArrayData = JSON.stringify(Appointment.reasonArray);
			if(reasonArrayData.length > 0){
				$(this).closest('.form-group').append('<input type="hidden" id="disease_id" name="disease_id" value="'+reasonArrayData+'">');				
			}			
		});		
	
 
        /** 
         * If Patient Drink Status is true then show the corresponding fields
         *  */
        $("input[name='drink_status']").click(function() {
            var drink_status = $(this).val();
            if (drink_status == 1) {
                $('.selectDrink').show();
            } else {
                $('.selectDrink').hide();
            }
        });
        /** 
         * If Smoke Status is true then show the corresponding fields
         *  */
        $("input[name='smoke_status']").click(function() {
            var smoke_status = $(this).val();
            if (smoke_status == 1) {
                $('.selectSmoke').show();
            } else {
                $('.selectSmoke').hide();
            }
        });
        /** 
         * If Patient Exercise Status is true then show the corresponding fields
         *  */
        $("input[name='exercise_status']").click(function() {
            var exercise_status = $(this).val();
            if (exercise_status == 1) {
                $('.selectExercise').show();
            } else {
                $('.selectExercise').hide();
            }
        });
        /** 
         * If Sex Status is true in ED/PD then show the corresponding fields
         *  */
        $("input[name='sex_status']").click(function() {
            var sex_status = $(this).val();
            if (sex_status == 1) {
                $('.selectSex').show();
            } else {
                $('.selectSex').hide();
            }
        });

    });

    /** 
     * Click on the Major surgeries then a pop-up will show corresponding that
     * */
//    $(document).on("click", "#surgeries1", function(ev) {
//        $('#common_modal .panel-title').text('List of Sergeries');
//        $.magnificPopup.open({
//            items: {
//                src: '#common_modal',
//                type: 'inline'
//            }
//        });
//    });
    /** 
     * Click on the the radio button to show the medicine list with corresponding id in the pop-up
     * */
    
    $(document).on("click", ".modelShow", function(ev) {
        var userId = <?php echo $patient->id; ?>	
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var radioId = $(this).attr('id');
		if((radioId == 'vitamin_taken1' && $("#vitaminMedList").length == 0) || (radioId == 'surgeries1' && $("#surgeryList").length == 0) || (radioId == 'allergies1' && $("#allergiesList").length == 0) || (radioId == 'illness1' && $("#illnessList").length == 0)){
			$.ajax({
			type: "POST",
					url: ajax_url + "/appointment/checkList",
					data: {"id": radioId,"patientId": userId },
					success: function(response) {
						$('#listContent').html(response);
					}
				}); 
			//$('#common_modal .panel-title').text('List of Medications');
		}
        $.magnificPopup.open({
            items: {
                src: '#common_modal',
                type: 'inline'
            }
        });
    });
    /** 
     * Click on the Other Illness then a pop-up will show corresponding that
     * */
//    $(document).on("click", "#illness1", function(ev) {
//        $('#common_modal .panel-title').text('List of Other Illness');
//        $.magnificPopup.open({
//            items: {
//                src: '#common_modal',
//                type: 'inline'
//            }
//        });
//    });
    /** 
     * Click on the Medication then a pop-up will show corresponding that
     * */
//    $(document).on("click", "#medication1", function() {
//        $('#common_modal .panel-title').text('List of Medication');
//        $.magnificPopup.open({
//            items: {
//                src: '#common_modal',
//                type: 'inline'
//            }
//        });
//    });

    /** 
     * Click on the Allergies then a pop-up will show corresponding that
     * */
//    $(document).on("click", "#vitamin_taken1", function(ev) {
//        $('#common_modal .panel-title').text('List of testosterone');
//        $.magnificPopup.open({
//            items: {
//                src: '#common_modal',
//                type: 'inline'
//            }
//        });
//    });

</script>
@endsection

