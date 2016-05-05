@extends('layouts.common')

@section('content')
<!--<link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap-fileupload/bootstrap-fileupload.min.css') }}" />
<script src="{{ URL::asset('vendor/jquery-autosize/jquery.autosize.js') }}"></script>
<script src="{{ URL::asset('vendor/bootstrap-fileupload/bootstrap-fileupload.min.js') }}"></script>-->
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit patient :  {{ $patient->firstName }} {{ $patient->lastName }}</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{url('/')}}">
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
                    <li>
                        <a href="#attachment" data-toggle="tab">Attachments</a>
                    </li>
                </ul>
                <!--                {{ Form::open(array('url' => 'savePatient', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'addPatient')) }}-->
                {!! Form::model($patient, ['method' => 'post','url' => ['updatePatient', $patient->id], 'id' => 'patient', 'files' => true]) !!}
                {{ csrf_field() }}
                <div class="tab-content">
                    <div id="personal" class="tab-pane active">
                        <p><strong>Personal Information </strong> (Note: Title with '*' mark as mandatory fields)</p>
                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            {{ Form::label('firstName', 'First Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-6">
                                {{ Form::hidden('id') }}
                                {{ Form::text('firstName', null, ['class' => 'form-control required', 'id' => 'first-name', 'placeholder' => 'First Name']) }}
                                @if ($errors->has('firstName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('firstName') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            {{ Form::label('lastName', 'Last Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-6">
                                {{ Form::text('lastName', null, ['class' => 'form-control required', 'id' => 'last-name', 'placeholder' => 'Last Name']) }}
                                @if ($errors->has('lastName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastName') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-6">
                                {{ Form::email('email', null, ['class' => 'form-control required', 'id' => 'email', 'placeholder' => 'Email']) }}
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
                                        {{ Form::radio('gender', 'Male', 'true', ['id' => 'optionsRadios1']) }}
                                        Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('gender', 'Female', 'false', ['id' => 'optionsRadios2']) }}

                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('dob', 'Date of birth', ['class' => 'col-sm-3 control-label', 'id' => 'form']) }}
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    {{ Form::text('dob', null, ['class' => 'form-control', 'data-plugin-datepicker']) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('employer', 'Employer', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('employer', null, ['class' => 'form-control', 'placeholder' => 'Employer', 'id' => 'employer']) }}
                            </div>
                        </div>					

                        <div class="form-group">
                            {{ Form::label('occupation', 'Occupation', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('occupation', null, ['class' => 'form-control', 'placeholder' => 'Occupation', 'id' => 'occupation']) }}
                            </div>
                        </div>
                    </div>

                    <div id="contact" class="tab-pane">
                        <p>Contact Information</p>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            {{ Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-6">
                                {{ Form::text('phone', null, ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '12', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"]) }}
                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('address1', 'Primary Address', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::textarea('address1', null, ['class' => 'form-control', 'placeholder' => 'Primary Address', 'id' => 'address1', 'rows' => 3]) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('address2', 'Secondary Address', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::textarea('address2', null, ['class' => 'form-control', 'placeholder' => 'Secondary Address', 'id' => 'address2', 'rows' => 3]) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('city', 'City', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City', 'id' => 'city']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('state', 'State', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'State', 'id' => 'state']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('zipCode', 'Zip Code', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('zipCode', null, ['class' => 'form-control', 'placeholder' => 'Zip Code', 'id' => 'zipCode', 'maxlength' => '6', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"]) }}
                            </div>
                        </div>					
                    </div>

                    <div id="attachment" class="tab-pane">
                        <p>Attachments</p>
<!--                        <div class="form-group">
                            <label class="col-md-3 control-label">File Upload</label>
                            <div class="col-md-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Change</span>
                                            <span class="fileupload-new">Select file</span>
                                            <input type="file" name="payment_bill"/>
                                        </span>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                    @if ($errors->has('payment_bill'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('payment_bill') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>-->
                        <div class="form-group">
                            {{ Form::label('payment_bill', 'Payment Bill', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                @if( isset($patient->payment_bill) && !empty($patient->payment_bill))
                                    <a href="{{ URL::asset('uploads/patient_documents/'.$patient->payment_bill) }}" download="myimage" class="document_link" ><img src="{{ URL::asset('images/pdf_icon.png') }}" ></a>
                                @endif
                                {{ Form::file('payment_bill', null, ['class' => 'form-control']) }}
                                
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

            </div>

        </div>
    </div>

</section>
@endsection

