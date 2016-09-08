@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">       
        <h2>Dose Management </h2>
        <div class="right-wrapper pull-right">


            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => '/doses/saveDoses', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'doseManagemnet')) }}
            {!! csrf_field() !!}            
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Dose Management </h2>                    
                </header>
                <div class="panel-body">
                    <div class="row">
                        @if(Session::has('flash_message'))
                        <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                        @endif
                        @if(Session::has('error_message'))
                        <div class="col-sm-12"><div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><em> {!! session('error_message') !!}</em></div></div>
                        @endif
                        <div class="col-sm-12"><div class="alert showSellMessage"><em></em></div></div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('Select Patient', null, array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-md-6">
                            <select  class="form-control chosen" name="patient_id" id = 'patient_to_choose'>
                                <option value="">Choose A Patient</option>
                                @foreach ($patients as $patient)
                                <option {{ old('patient_id') == $patient->id ? 'selected="selected"' :'' }} value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

            </section>
            {{ Form::close() }}

        </div>
        <div id = "hidden-doses">


            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 ">
                        Patient Name
                    </div>
                    <div class="col-md-6 ">
                        DOB
                    </div>
                    <div class="col-md-6 " id = "pname">
                    </div>
                    <div class="col-md-6 " id = "pdob">
                    </div>
                </div>

                <div class="panel-body" class ='treatment-done'  id="dose_details">

                </div>

            </div>



            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        {{ Form::open(array('url' => '/doses/store', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'patientInventory')) }}
                        <div class="panel-body">
                            <!-- Display Validation Errors -->
                            {{ csrf_field() }}
                            {{ Form::hidden('patient_id', '', array('id' => 'patient_id')) }}
                            {{ Form::hidden('dose_type', '', array('id' => 'dose_type')) }}
                            <div class="toggle" data-plugin-toggle>
                                <h4 style="text-align:center">   <div class="row-title"> Trimix /Sublingual ED Therapy </div></h4>
                                <section class="toggle">
                                    <label>Intitial Test Dosing Deduct from Inventory Only</label>
                                    <div  class="toggle-content">
                                        </br>
                                            <h3 class="row-title" id="dose_title"></h3>
                                        </br>
                                        <div class = "row">
                                            <div class="col-sm-6 form-group{{ $errors->has('doctor') ? ' has-error' : '' }}">
                                                {{ Form::label('doctor', ' Doctor ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $dd9 = dropDown9(); ?>
                                                    {{ Form::select('doctor', (['' => 'Select Doctor'] + $dd9), null, ['class' => 'form-control input required', 'id' => 'dd9']) }}
                                                    @if ($errors->has('doctor'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('doctor') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-6 form-group{{ $errors->has('amount1') ? ' has-error' : '' }}">
                                                {{ Form::label('amount1', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $amount = dropDownAmount(); ?>

                                                    {{ Form::select('amount1', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required amount', 'id' => 'amount1']) }}

                                                    @if ($errors->has('amount1'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('amount1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 form-group{{ $errors->has('medicationa1') ? ' has-error' : '' }}">
                                                {{ Form::label('medicationa1', 'Medication ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $medication = dropDownMedication(); ?>
                                                    {{ Form::select('medicationa1', (['' => 'Select Medication'] + $medication), null, ['class' => 'form-control input required amount', 'id' => 'medicationA1']) }} 
                                                    @if ($errors->has('medicationA1'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('medicationa1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-6 form-group{{ $errors->has('amount2') ? ' has-error' : '' }}">
                                                {{ Form::label('amount2', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $amount = dropDownAmount(); ?>

                                                    {{ Form::select('amount2', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required amount', 'id' => 'amount2']) }}

                                                    @if ($errors->has('amount1'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('amount2') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6 form-group{{ $errors->has('medicationa2') ? ' has-error' : '' }}">
                                                {{ Form::label('medicationa2', 'Medication ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $medication = dropDownMedication(); ?>

                                                    {{ Form::select('medicationa2', (['' => 'Select Medication'] + $medication), null, ['class' => 'form-control input required amount', 'id' => 'medicationa2']) }} 

                                                    @if ($errors->has('medicationa2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('medicationa2') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-6 form-group{{ $errors->has('amount3') ? ' has-error' : '' }}">
                                                {{ Form::label('amount3', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $amount = dropDownAmount(); ?>

                                                    {{ Form::select('amount3', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required amount', 'id' => 'amount3']) }}

                                                    @if ($errors->has('amount1'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('amount3') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 form-group{{ $errors->has('medicationb1') ? ' has-error' : '' }}">
                                                {{ Form::label('medicationb1', 'Medication ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $medication = dropDownMedication(); ?>

                                                    {{ Form::select('medicationb1', (['' => 'Select Medication'] + $medication), null, ['class' => 'form-control input required amount', 'id' => 'medicationb1']) }} 

                                                    @if ($errors->has('medicationb1'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('medicationb1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-6 form-group{{ $errors->has('amount4') ? ' has-error' : '' }}">
                                                {{ Form::label('amount4', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $amount = dropDownAmount(); ?>

                                                    {{ Form::select('amount4', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required amount', 'id' => 'amount4']) }}

                                                    @if ($errors->has('amount1'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('amount4') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 form-group{{ $errors->has('medicationb2') ? ' has-error' : '' }}">
                                                {{ Form::label('medicationb2', 'Medication ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $medication = dropDownMedication(); ?>

                                                    {{ Form::select('medicationb2', (['' => 'Select Medication'] + $medication), null, ['class' => 'form-control input required amount', 'id' => 'medicationb2']) }} 

                                                    @if ($errors->has('medicationb2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('medicationb2') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            </br>
                                            <div class="col-sm-12 form-group" >
                                                {{ Form::button(
                                            '<i class="fa fa-plus"></i> Submit',
                                            array(
                                                'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                                 'id' => 'prevent', 
                                                'type'=>'submit' )) 
                                                }}                               
                                            </div>
                                        </div>
                                        
                                     </div>
                                </section>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </section>

                </div>
            </div>
            </section>
            @endsection
