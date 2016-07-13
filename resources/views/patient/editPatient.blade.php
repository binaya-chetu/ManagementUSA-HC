@extends('layouts.common')

@section('content')

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit patient :  {{ $patient->first_name }} {{ $patient->last_name }}</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('patient.edit', $patient) !!}
            
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">	
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a class="panel-action panel-action-toggle" data-panel-toggle="" href="#"></a>
                        <a class="panel-action panel-action-dismiss" data-panel-dismiss="" href="#"></a>
                    </div>
                    <h2 class="panel-title"><strong>Edit Patient </strong> </h2>
                </header>
                {!! Form::model($patient, ['method' => 'post','url' => ['patient/updatePatient', $patient->id], 'id' => 'patient', 'files' => true]) !!}
                {{ csrf_field() }}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                {{ Form::hidden('id') }}
                                {{ Form::text('first_name', null, ['class' => 'form-control required', 'id' => 'first-name', 'placeholder' => 'First Name']) }}
                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            {{ Form::label('middle_name', 'Middle Name', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('middle_name', null, ['class' => 'form-control', 'id' => 'middle_name', 'placeholder' => 'Middle Name']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                {{ Form::text('last_name', null, ['class' => 'form-control required', 'id' => 'last-name', 'placeholder' => 'Last Name']) }}
                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                 <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    @if(!empty($patient->email))
                                {{ Form::email('email', null, ['class' => 'form-control required', 'id' => 'email', 'readonly']) }}
                                @else
                                {{ Form::email('email', null, ['class' => 'form-control required', 'id' => 'email']) }}
                                @endif
                                 </div>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('gender', 'Gender', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-md-9">
                                <div class="radio">
                                    <?php if($patient['patientDetail']->gender === 'Female') { $female = true; $male = false; } else { $male = true; $female = false; }?>
                                    <label>
                                        {{ Form::radio('gender', 'Male', $male, ['id' => 'optionsRadios1']) }}
                                        Male
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        {{ Form::radio('gender', 'Female', $female, ['id' => 'optionsRadios2']) }}

                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            {{ Form::label('marital', 'Marital Status', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                <?php $marital = ['Married' => 'Married', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed', 'Single' => 'Single']; ?>
                                {{ Form::select('marital_status', array_merge(['0' => 'Please Select Marital Status'], $marital), $patient['patientDetail']->marital_status, ['class' => 'form-control input', 'id' => 'maritalStatus']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('address1', 'Address Line 1', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('address1', $patient['patientDetail']->address1, ['class' => 'form-control', 'placeholder' => 'Primary Address', 'id' => 'address1', 'rows' => 3]) }}
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            {{ Form::label('address2', 'Address Line 2', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('address2', $patient['patientDetail']->address2, ['class' => 'form-control', 'placeholder' => 'Secondary Address', 'id' => 'address2', 'rows' => 3]) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('city', 'City', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('city', $patient['patientDetail']->city, ['class' => 'form-control', 'placeholder' => 'City', 'id' => 'city']) }}
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            {{ Form::label('state', 'State', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::select('state', array_merge(['0' => 'Please Select State'], $states), $patient['patientDetail']->state, ['class' => 'form-control input', 'id' => 'state']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group{{ $errors->has('zipCode') ? ' has-error' : '' }}">
                            {{ Form::label('zipCode', 'Zip Code', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                {{ Form::text('zipCode', $patient['patientDetail']->zipCode, ['class' => 'form-control required', 'placeholder' => 'Zip Code', 'id' => 'zipCode', 'maxlength' => '15', 'minlength' => '6', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"]) }}
                            @if ($errors->has('zipCode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('zipCode') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            {{ Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                {{ Form::text('phone', $patient['patientDetail']->phone, ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14']) }}
                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('mobile', 'Mobile', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('mobile', $patient['patientDetail']->mobile, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'id' => 'mobile', 'maxlength' => '14']) }}
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            {{ Form::label('call_time', 'Best Time To Call', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                <?php $patientCallHour = callHourTime(); ?>
                                {{ Form::select('call_time', array_merge(['0' => 'Please Select Best Time To Call'], $patientCallHour), $patient['patientDetail']->call_time, ['class' => 'form-control input', 'id' => 'call_time']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('dob', 'Date of Birth', ['class' => 'col-sm-3 control-label', 'id' => 'form']) }}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <?php 
                                        $dob = ''; 
                                        if($patient['patientDetail']->dob)
                                        {
                                            $dob = date('m/d/Y', strtotime($patient['patientDetail']->dob));
                                        }
                                    ?>
                                    {{ Form::text('dob', $dob, ['class' => 'form-control', 'data-plugin-datepicker', 'placeholder' => 'Date of Birth']) }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            {{ Form::label('work', 'Work', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('work', $patient['patientDetail']->work, ['class' => 'form-control input-sm', 'id' => 'w3-work', 'placeholder' => 'Work']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('employer', 'Place of Employement', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('employer', $patient['patientDetail']->employer, ['class' => 'form-control', 'placeholder' => 'Employer', 'id' => 'employer']) }}
                            </div>
                        </div>					

                        <div class="col-sm-6 form-group">
                            {{ Form::label('occupation', 'Occupation', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('occupation', $patient['patientDetail']->occupation, ['class' => 'form-control', 'placeholder' => 'Occupation', 'id' => 'occupation']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('height', 'Height', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                <?php $commonHeight = commonHeight(); ?>
                                {{ Form::select('height', array_merge(['0' => 'Please Select The Height'], $commonHeight), $patient['patientDetail']->height, ['class' => 'form-control input', 'id' => 'height']) }}
                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group">
                            {{ Form::label('height', 'Weight', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                <?php $commonWeight = commonWeight();  ?>
                                {{ Form::select('weight', array_merge(['0' => 'Please Select The Weight'], $commonWeight), $patient['patientDetail']->weight, ['class' => 'form-control input', 'id' => 'weight']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('physician', 'Primary Physician', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('primary_physician', $patient['patientDetail']->primary_physician, ['class' => 'form-control input-sm', 'id' => 'w3-physician', 'placeholder' => 'Primary Care Physician Name']) }}
                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group">
                            {{ Form::label('physician_phone', 'Physician Phone', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('physician_phone', $patient['patientDetail']->physician_phone, ['class' => 'form-control input-sm', 'id' => 'phone', 'placeholder' => 'Physician Phone']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('driving_license', 'Driving License', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::file('driving_license', null, ['class' => 'form-control']) }}
                                @if( isset($patient['patientDetail']->driving_license) && !empty($patient['patientDetail']->driving_license))
                                    <a href="{{ URL::asset('uploads/patient_documents/'.$patient['patientDetail']->driving_license) }}" download="myimage" class="document_link" ><img height="100" width="100" src="{{ URL::asset('uploads/patient_documents/'.$patient['patientDetail']->driving_license) }}" ></a>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group">
                            {{ Form::label('payment_bill', 'Payment Bill', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                @if( isset($patient->payment_bill) && !empty($patient->payment_bill))
                                    <a href="{{ URL::asset('uploads/patient_documents/'.$patient->payment_bill) }}" download="myimage" class="document_link" ><img src="{{ URL::asset('images/pdf_icon.png') }}" ></a>
                                @endif
                                {{ Form::file('payment_bill', null, ['class' => 'form-control']) }}

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('never_treat_status', 'Never Treat', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-md-9">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('never_treat_status', null, $patient['patientDetail']->never_treat_status, ['id' => 'never_treat_status']) }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button class="btn btn-primary">Submit</button>
                            <a href="/patient" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </footer>
                {{ Form::close() }}
           </section>
        </div>
    </div>
</section>
@endsection

