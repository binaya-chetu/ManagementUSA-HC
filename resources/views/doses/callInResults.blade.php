
@extends('layouts.common')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">       
        <h2>Patient's Feedback </h2>
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
                    <h2 class="panel-title">Patient's Feedback </h2>                    
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
                           <label>Saved Doses</label>
                           <div class="toggle-content">
                               <div class="panel-body" class ='treatment-done'  id="dose_details">

                               </div>
                           </div>        
                       </section>
                   </div>
            
            
            
        </div>
            <div class="row">

       <section id = "callInResults">
                                        
<hr>
    <div class="row">
        <div class="col-sm-2 form-group{{ $errors->has('time') ? ' has-error' : '' }}">
            {{ Form::label('time', 'Time', array('class' => 'col-sm-3 control-label mandatory')) }}
        </div>
        <div class="col-sm-2 form-group{{ $errors->has('percent') ? ' has-error' : '' }}">
            {{ Form::label('percent', 'Percent', array('class' => 'col-sm-3 control-label mandatory')) }}
         </div>
        <div class="col-sm-2 form-group{{ $errors->has('pain') ? ' has-error' : '' }}">
            {{ Form::label('pain', 'Pain', array('class' => 'col-sm-3 control-label mandatory')) }}
        </div>
        <div class="col-sm-2 form-group{{ $errors->has('check2') ? ' has-error' : '' }}">
            {{ Form::label('antidote', 'Antidote ', array('class' => 'col-sm-3 control-label mandatory')) }}
        </div>
        <div class="col-sm-2 form-group{{ $errors->has('check3') ? ' has-error' : '' }}">
            {{ Form::label('notes', 'Notes', array('class' => 'col-sm-3 control-label mandatory')) }}
        </div>
         <div class="col-sm-2 form-group{{ $errors->has('check3') ? ' has-error' : '' }}">
            {{ Form::label('perm', 'Perm', array('class' => 'col-sm-3 control-label mandatory')) }}
        </div>                         
    </div>

     <div class="row">
          <div class="col-sm-2 form-group{{ $errors->has('time') ? ' has-error' : '' }}">
           <select class="form-control"  required = "required " name = "time">
           <?php for($hours=0; $hours<=12; $hours++) // the interval for hours is '1'
                for($mins=0; $mins<60; $mins+=5) // the interval for mins is '30'
                    echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                       .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>'; ?>
           </select>
        </div>
        <div class="col-sm-2 form-group{{ $errors->has('percent') ? ' has-error' : '' }}">
             <?php $ddvalue = dropDown4(); ?>
             {{ Form::select('percent', (['' => 'Select'] + $ddvalue), null, ['class' => 'form-control input required percent', 'id' => 'percent']) }}
                 @if ($errors->has('percent'))
                 <span class="help-block">
                     <strong>{{ $errors->first('percent') }}</strong>
                 </span>
                 @endif
        </div>
        <div class="col-sm-2 form-group{{ $errors->has('pain') ? ' has-error' : '' }}">
          <?php $ddvalue = dropDown7(); ?>
            {{ Form::select('pain', (['' => 'Select'] + $ddvalue), null, ['class' => 'form-control input required pain', 'id' => 'pain']) }}
                @if ($errors->has('pain'))
                <span class="help-block">
                    <strong>{{ $errors->first('pain') }}</strong>
                </span>
                @endif
        </div>
         <div class="col-sm-2 form-group{{ $errors->has('antidote') ? ' has-error' : '' }}">
             <?php $ddvalue = dropDown8(); ?>
            {{ Form::select('antidote', (['' => 'Select'] + $ddvalue), null, ['class' => 'form-control input required antidote', 'id' => 'antidote']) }}
                @if ($errors->has('antidote'))
                <span class="help-block">
                    <strong>{{ $errors->first('antidote') }}</strong>
                </span>
                @endif
        </div>
        <div class="col-sm-2 form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
            {{ Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => 'Add note', 'id' => 'notes', 'rows' => '1']) }}
                @if ($errors->has('notes'))
                <span class="help-block">
                    <strong>{{ $errors->first('notes') }}</strong>
                </span>
                @endif
        </div>
         <div class="col-sm-2 form-group{{ $errors->has('perm') ? ' has-error' : '' }}">
            {{ Form::checkbox('perm',null, ['class' => 'form-control input required perm', 'id' => 'perm']) }}
                 @if ($errors->has('perm'))
                 <span class="help-block">
                     <strong>{{ $errors->first('perm') }}</strong>
                 </span>
                 @endif
       </div>
    </div>
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
            @endsection




