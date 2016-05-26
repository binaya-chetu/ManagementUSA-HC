@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Doctor </h2>
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

    <div class="row">
        <div class="col-lg-12">	
           <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#personal" data-toggle="tab"><i class="fa fa-star"></i> Personal Information</a>
                    </li>
                    <li>
                        <a href="#contact" data-toggle="tab">Contact Information</a>
                    </li>
                </ul>
                
                {!! Form::model($doctor, ['method' => 'post','url' => ['doctor/updateDoctor', $doctor->id], 'id' => 'doctor']) !!}
                {{ csrf_field() }}
                    <div class="tab-content">
                    <div id="personal" class="tab-pane active">
                        <p>Personal Information </p>
                    
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                           {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-6">
                                {{ Form::hidden('id') }}
                                {{ Form::text('first_name', null, ['class' => 'form-control required', 'id' => 'first-name', 'placeholder' => 'First Name']) }}
                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-6">
                                {{ Form::text('last_name', null, ['class' => 'form-control required', 'id' => 'last-name', 'placeholder' => 'Last Name']) }}
                                @if ($errors->has('last_name'))
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
                                {{ Form::email('email', null, ['class' => 'form-control required', 'id' => 'email', 'readonly']) }}
                                 </div>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group">
                            {{ Form::label('gender', 'Gender', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-md-6">
                                <div class="radio">
                                    <label>
                                        <?php if($doctor['doctorDetail']->gender === 'Female') { $female = true; $male = false; } else { $male = true; $female = false; }?>
                                        {{ Form::radio('gender', 'Male', $male, ['id' => 'optionsRadios1']) }}
                                        Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('gender', 'Female', $female, ['id' => 'optionsRadios2']) }}
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('dob', 'Date of Birth', ['class' => 'col-sm-3 control-label', 'id' => 'form']) }}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <?php 
                                        $dob = ''; 
                                        if($doctor['doctorDetail']->dob)
                                        {
                                            $dob = date('m /d/Y', strtotime($doctor['doctorDetail']->dob));
                                        }
                                    ?>
                                     {{ Form::text('dob', $dob, ['class' => 'form-control', 'data-plugin-datepicker', 'placeholder' => 'Date of Birth']) }}

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('employer', 'Employer', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('employer', $doctor['doctorDetail']->employer, ['class' => 'form-control', 'placeholder' => 'Employer', 'id' => 'employer']) }}
                            </div>
                        </div>					

                        <div class="form-group">
                            {{ Form::label('specialization', 'Specialization', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('specialization', $doctor['doctorDetail']->specialization, ['class' => 'form-control', 'placeholder' => 'Specialization', 'id' => 'specialization']) }}
                            </div>
                        </div>
                        </div>
                        <div id="contact" class="tab-pane">
                        <p>Contact Information</p>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                             {{ Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-6">
                                {{ Form::text('phone', $doctor['doctorDetail']->phone, ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14']) }}
                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('address1', 'Address Line 1', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('address1', $doctor['doctorDetail']->address1, ['class' => 'form-control', 'placeholder' => 'Primary Address', 'id' => 'address1', 'rows' => 3]) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('address2', 'Address Line 2', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('address2', $doctor['doctorDetail']->address2, ['class' => 'form-control', 'placeholder' => 'Secondary Address', 'id' => 'address2', 'rows' => 3]) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('city', 'City', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('city', $doctor['doctorDetail']->city, ['class' => 'form-control', 'placeholder' => 'City', 'id' => 'city']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('state', 'State', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::select('state', array_merge(['0' => 'Please Select State'], $states), $doctor['doctorDetail']->state, ['class' => 'form-control input', 'id' => 'state']) }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('zipCode') ? ' has-error' : '' }}">
                            {{ Form::label('zipCode', 'Zip Code', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-6">
                                {{ Form::text('zipCode', $doctor['doctorDetail']->zipCode, ['class' => 'form-control required', 'placeholder' => 'Zip Code', 'id' => 'zipCode', 'maxlength' => '15', 'minlength' => '6', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"]) }}
                            @if ($errors->has('zipCode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('zipCode') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    </div>
                 <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                                {{ Form::button(
                                    'Save',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                                }}                               
                                <a href='/doctor' class = 'mb-xs mt-xs mr-xs btn btn-default'>Cancel</a>
                            </div>
                    </div>
                </footer>
                 {{ Form::close() }}
            </div>
        </div>
    </div>
</section>

@endsection

