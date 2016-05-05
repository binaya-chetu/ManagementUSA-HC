@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add New Doctor</h2>
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
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a class="panel-action panel-action-toggle" data-panel-toggle="" href="#"></a>
                        <a class="panel-action panel-action-dismiss" data-panel-dismiss="" href="#"></a>
                    </div>
                    <h2 class="panel-title"><strong>Add Doctor </strong> </h2>
                </header>	
                 {{ Form::open(array('url' => 'doctor/saveDoctor', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'doctor')) }}
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                   
                        {{ csrf_field() }}
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
                                 <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                {{ Form::email('email', null, ['class' => 'form-control required', 'id' => 'email', 'placeholder' => 'example@mail.com']) }}
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
<!--                                    <input type="text" data-plugin-datepicker class="form-control" name="dob">-->
                                </div>
                            </div>
                        </div>

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
                 <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                                {{ Form::button(
                                    '<i class="fa fa-plus"></i> Add Doctor',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                                }}                               
                                <a href='/patient' class = 'mb-xs mt-xs mr-xs btn btn-default'>Cancel</a>
                            </div>
                    </div>
                </footer>
                 {{ Form::close() }}
            </section>
        </div>
    </div>
</section>
@endsection

