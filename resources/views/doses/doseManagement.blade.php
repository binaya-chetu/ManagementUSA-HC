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
                    <h2 class="panel-title">Dose Management : &nbsp;<span  id = "patientName"></span> </h2>   
                    
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
    </div>
    <div id = "hidden-doses">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 ">
                    <label>Patient Name</label>
                </div>
                <div class="col-md-6 ">
                  <label>DOB</label>  
                </div>
                <div class="col-md-6 ">
                    <label id = "pname"></label>  
                </div>
                <div class="col-md-6 ">
                      <label id = "pdob"></label>  
                </div>
            </div>
             <div class="toggle" data-plugin-toggle>
                       <section class="toggle">
                           <label>Given Doses Details</label>
                           <div class="toggle-content">
                               <div class="panel-body" class ='treatment-done'  id="dose_details">

                               </div>
                           </div>        
                       </section>
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
                                    <section id = "testDosePart">
                                        @include('doses.testDosePart')
                                    </section>

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
    </div>
</section>


    <div id="feedbackPopup" class="modal-block modal-block-primary mfp-hide">  
       <section class="panel panel-primary">
       <header class="panel-heading">
                <h2 class="panel-title">Add Feedback</h2>
            </header>
           <div class="panel-body">
             {{ Form::open(array('url' => '/doses/storeFeedback', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'doseManagemnet')) }}
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
               {{ Form::label('time', 'Time', array('class' => 'col-sm-3 control-label mandatory')) }}

                <div class="col-md-6"> 
                  <select class="form-control"  required = "required " name = "time">
                   <option value="">Select Time</option>
                    <?php for($hours=0; $hours<=12; $hours++) // the interval for hours is '1'
                         for($mins=5; $mins<60; $mins+=5) // the interval for mins is '30'
                             echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                                .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>'; ?>
                    </select>
                </div>
                         @if ($errors->has('time'))
                         <span class="help-block">
                             <strong>{{ $errors->first('time') }}</strong>
                         </span>
                         @endif
            </div>
          
             <div class="form-group{{ $errors->has('percent') ? ' has-error' : '' }}"> 
                 {{ Form::label('percent', 'Percent', array('class' => 'col-sm-3 control-label mandatory')) }}
                 <div class="col-sm-6 form-group{{ $errors->has('percent') ? ' has-error' : '' }}">
                    <?php $ddvalue = dropDown4(); ?>
                    {{ Form::select('percent', (['' => 'Select'] + $ddvalue), null, ['class' => 'form-control input required percent', 'id' => 'percent']) }}
                 @if ($errors->has('percent'))
                 <span class="help-block">
                     <strong>{{ $errors->first('percent') }}</strong>
                 </span>
                 @endif
             </div>
  
            </div> 
            
                  <div class="form-group{{ $errors->has('pain') ? ' has-error' : '' }}"> 
                 {{ Form::label('pain', 'Pain', array('class' => 'col-sm-3 control-label mandatory')) }}
                    <div class="col-sm-6 form-group{{ $errors->has('pain') ? ' has-error' : '' }}">
                   <?php $ddvalue = dropDown7(); ?>
                 {{ Form::select('pain', (['' => 'Select'] + $ddvalue), null, ['class' => 'form-control input required pain', 'id' => 'pain']) }}
                     @if ($errors->has('pain'))
                     <span class="help-block">
                         <strong>{{ $errors->first('pain') }}</strong>
                     </span>
                     @endif
                   </div>
  
                  </div> 
            
              <div class="form-group{{ $errors->has('antidote') ? ' has-error' : '' }}"> 
                 {{ Form::label('antidote', 'Antidote ', array('class' => 'col-sm-3 control-label mandatory')) }}
                 <div class="col-sm-6 form-group{{ $errors->has('antidote') ? ' has-error' : '' }}">
             <?php $ddvalue = dropDown8(); ?>
            {{ Form::select('antidote', (['' => 'Select'] + $ddvalue), null, ['class' => 'form-control input required antidote', 'id' => 'antidote']) }}
                @if ($errors->has('antidote'))
                <span class="help-block">
                    <strong>{{ $errors->first('antidote') }}</strong>
                </span>
                @endif
             </div>
            </div> 
           <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}"> 
            {{ Form::label('notes', 'Notes', array('class' => 'col-sm-3 control-label mandatory')) }}
              <div class="col-sm-6 form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
            {{ Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => 'Add note', 'id' => 'notes', 'rows' => '1']) }}
                @if ($errors->has('notes'))
                <span class="help-block">
                    <strong>{{ $errors->first('notes') }}</strong>
                </span>
                @endif
              </div>
            </div> 
            
            
             <div class="form-group{{ $errors->has('perm') ? ' has-error' : '' }}"> 
                {{ Form::label('perm', 'Perm', array('class' => 'col-sm-3 control-label mandatory')) }}
                 <div class="col-sm-6 form-group{{ $errors->has('perm') ? ' has-error' : '' }}">
            {{ Form::checkbox('perm', 'false', ['class' => 'form-control input required perm', 'checked' => 'false', 'id' => 'perm']) }}
                 @if ($errors->has('perm'))
                 <span class="help-block">
                     <strong>{{ $errors->first('perm') }}</strong>
                 </span>
                 @endif
                </div>
            </div> 
            
           </div>
           

 
    <footer class="panel-footer">
        <div class="row">
          
            <div class="col-md-12 text-center">
                {{ Form::button(
                                    '<i class="fa fa-btn fa-user"></i>  Save feedback',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                }}
                <button class="btn btn-default closePop">Cancel</button>
            </div>
       


        </div>
    </footer>
</section>
{{ Form::close() }}
  </div>         

@endsection
