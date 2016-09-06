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
                    @if(Session::has('flash_message'))
                    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6 commentdiv">
                        Patient Name
                    </div>
                    <div class="col-md-6 commentdiv">
                        DOB
                    </div>
                    <div class="col-md-6 commentdiv" id = "pname">
                    </div>
                    <div class="col-md-6 commentdiv" id = "pdob">
                    </div>
                </div>

            </div>



            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
<!--                        <header class="panel-heading">
                            <h6 class="panel-title" id = "small-heading" >Package Totals</h6>

                        </header>
                        <div class="panel-body">
                            <div class="row show-grid">
                                <div class="col-md-2"><span class="show-grid-block">Trimix</span></div>
                                <div class="col-md-2"><span class="show-grid-block">Sublingual</span></div>
                                <div class="col-md-2"><span class="show-grid-block">Office Visit</span></div>
                                <div class="col-md-2"><span class="show-grid-block">Redose</span></div>
                                <div class="col-md-2"><span class="show-grid-block">Antidotes</span></div>
                                <div class="col-md-2"><span class="show-grid-block">Prolyfic Treatment</span></div>
                            </div>
                            <div class="row show-grid">
                                <div class="col-md-2"><span class="show-grid-block">50%</span></div>
                                <div class="col-md-2"><span class="show-grid-block">5%</span></div>
                                <div class="col-md-2"><span class="show-grid-block">61%</span></div>
                                <div class="col-md-2"><span class="show-grid-block">30%</span></div>
                                <div class="col-md-2"><span class="show-grid-block">20%</span></div>
                                <div class="col-md-2"><span class="show-grid-block">10%</span></div>
                            </div>
                            <div class="row show-grid">
                                <div class="col-md-2"><span class="show-grid-block">3305</span></div>
                                <div class="col-md-2"><span class="show-grid-block">5896</span></div>
                                <div class="col-md-2"><span class="show-grid-block">8000</span></div>
                                <div class="col-md-2"><span class="show-grid-block">9600</span></div>
                                <div class="col-md-2"><span class="show-grid-block">5698</span></div>
                                <div class="col-md-2"><span class="show-grid-block">5669</span></div>
                            </div>
                        </div>-->

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
                                        <h4 class="row-title" id="dose_title"></h4>
                                        <div class = "row">


                                            <div class="col-sm-6 form-group{{ $errors->has('doctor') ? ' has-error' : '' }}">
                                                {{ Form::label('doctor', ' Doctor ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <?php $dd9 = dropDown9(); ?>
                                                        {{ Form::select('doctor', (['' => 'Select Doctor'] + $dd9), null, ['class' => 'form-control input required', 'id' => 'dd9']) }}
                                                    </div>
                                                    @if ($errors->has('doctor'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('doctor') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                {{ Form::label('amount1', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $amount = dropDownAmount(); ?>

                                                    {{ Form::select('amount1', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required', 'id' => 'amount1']) }}

                                                </div>
                                            </div>   

                                            <div class="col-sm-6 form-group">
                                                {{ Form::label('medicationa1', 'Medication ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $medication = dropDownMedication(); ?>

                                                    {{ Form::select('medicationA1', (['' => 'Select Medication'] + $medication), null, ['class' => 'form-control input required', 'id' => 'medicationA1']) }} 

                                                </div>
                                            </div> 
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 form-group">


                                                {{ Form::label('amount2', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $amount = dropDownAmount(); ?>

                                                    {{ Form::select('amount2', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required', 'id' => 'amount2']) }}

                                                </div>
                                            </div>   

                                            <div class="col-sm-6 form-group">
                                                {{ Form::label('medicationa2', 'Medication', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $medication = dropDownMedication(); ?>

                                                    {{ Form::select('medicationA2', (['' => 'Select Medication'] + $medication), null, ['class' => 'form-control input required', 'id' => 'medicationA2']) }} 

                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                {{ Form::label('amount3', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">

                                                    <?php $amount = dropDownAmount(); ?>

                                                    {{ Form::select('amount3', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required', 'id' => 'amount3']) }}

                                                </div>
                                            </div>   

                                            <div class="col-sm-6 form-group">

                                                {{ Form::label('medicationb1', 'Medication2', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $medication = dropDownMedication(); ?>

                                                    {{ Form::select('medicationB1', (['' => 'Select Medication 2'] + $medication), null, ['class' => 'form-control input required', 'id' => 'medicationB1']) }} 

                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                {{ Form::label('amount4', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $amount = dropDownAmount(); ?>

                                                    {{ Form::select('amount4', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required', 'id' => 'amount4']) }}

                                                </div>
                                            </div>   

                                            <div class="col-sm-6 form-group">
                                                {{ Form::label('medicationb2', 'Medication2 ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $medication = dropDownMedication(); ?>

                                                    {{ Form::select('medicationB2', (['' => 'Select Medication 2'] + $medication), null, ['class' => 'form-control input required', 'id' => 'medicationB2']) }} 


                                                </div>
                                            </div> 
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 form-group">
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


                </div>
            </div>
            </section>
            @endsection
