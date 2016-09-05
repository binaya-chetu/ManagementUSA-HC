@extends('layouts.common')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
   
    <header class="page-header">
        <h2>Inventory Details</h2>

        <div class="right-wrapper pull-right">


            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>


    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">
                Patient Inventory Details
            </h2>
        </header>
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
                    Date of Birth
                </div>
                <div class="col-md-6 commentdiv">
                    Amir       
                </div>
                <div class="col-md-6 commentdiv">
                    06/09/1987
                </div>
            </div>

        </div>


      
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
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
                        </div>
                    </section>
                    <section class="panel" id="treatment">
                        <header class="panel-heading">
                            <div class="row-title"> Trimix /Sublingual ED Therapy </div>
                        </header>
                         {{ Form::open(array('url' => '#', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'patientInventory')) }}
                          <div class="panel-body">
                       <!-- Display Validation Errors -->
                   
                        {{ csrf_field() }}
                   
                        <div class="toggle" data-plugin-toggle>
                            <h4 style="text-align:center"></h4>
                            <section class="toggle">
                                <label>Intitial Test Dosing Deduct from Inventory Only</label>
                                <div class="toggle-content">
                                <div class = "row">
                                      <div class="col-sm-6 form-group">
                                            {{ Form::label('amount1', 'Test Dose 1 ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                            <div class="col-sm-9">
                                                
                                                <?php $dd9 = dropDown9();?>
                                                
                                                {{ Form::select('dd9', (['' => 'Select DD9 value'] + $dd9), null, ['class' => 'form-control input required', 'id' => 'dd9']) }}
                                                
                                                
                                                
                                            </div>
                                        </div>  
                                    <div>
                                  </div>
                                 </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            {{ Form::label('amount1', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                            <div class="col-sm-9">
                                                <?php $amount = dropDownAmount();?>
                                                
                                                {{ Form::select('amount1', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required', 'id' => 'amount1']) }}
                                                
                                            </div>
                                        </div>   

                                        <div class="col-sm-6 form-group">
                                            {{ Form::label('medicationa1', 'Medication ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                            <div class="col-sm-9">
                                                <?php $medication = dropDownMedication();?>
                                                
                                                 {{ Form::select('medicationA1', (['' => 'Select Medication'] + $medication), null, ['class' => 'form-control input required', 'id' => 'medicationA1']) }} 
                                                 
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                           
                                            
                                            {{ Form::label('amount2', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                            <div class="col-sm-9">
                                               <?php $amount = dropDownAmount();?>
                                                
                                                {{ Form::select('amount2', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required', 'id' => 'amount2']) }}
                                                
                                            </div>
                                        </div>   

                                        <div class="col-sm-6 form-group">
                                            {{ Form::label('medicationa2', 'Medication', array('class' => 'col-sm-3 control-label mandatory')) }}
                                            <div class="col-sm-9">
                                               <?php $medication = dropDownMedication();?>
                                                
                                                 {{ Form::select('medicationA2', (['' => 'Select Medication'] + $medication), null, ['class' => 'form-control input required', 'id' => 'medicationA2']) }} 

                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            {{ Form::label('amount3', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                            <div class="col-sm-9">
                                                
                                                <?php $amount = dropDownAmount();?>
                                                
                                                {{ Form::select('amount3', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required', 'id' => 'amount3']) }}
                                                
                                            </div>
                                        </div>   

                                        <div class="col-sm-6 form-group">
                                            
                                            {{ Form::label('medicationb1', 'Medication', array('class' => 'col-sm-3 control-label mandatory')) }}
                                            <div class="col-sm-9">
                                            <?php $medication = dropDownMedication();?>
                                                
                                                 {{ Form::select('medicationB1', (['' => 'Select Medication 2'] + $medication), null, ['class' => 'form-control input required', 'id' => 'medicationB1']) }} 

                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            {{ Form::label('amount4', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                                            <div class="col-sm-9">
                                                 <?php $amount = dropDownAmount();?>
                                                
                                                {{ Form::select('amount4', (['' => 'Select Amount'] + $amount), null, ['class' => 'form-control input required', 'id' => 'amount4']) }}
                                                
                                            </div>
                                        </div>   

                                        <div class="col-sm-6 form-group">
                                            {{ Form::label('medicationb2', 'Medication ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                            <div class="col-sm-9">
                                                 <?php $medication = dropDownMedication();?>
                                                
                                                 {{ Form::select('medicationB2', (['' => 'Select Medication 2'] + $medication), null, ['class' => 'form-control input required', 'id' => 'medicationB2']) }} 


                                            </div>
                                        </div> 
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-sm-6 form-grou">
                                            {{ Form::button(
                                            '<i class="fa fa-plus"></i> Submit',
                                            array(
                                                'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                                'type'=>'submit')) 
                                            }}                               
                                        </div>
                                    </div>
                                 


                                </div>
                                 
                            </section>

                        </div>
             {{ Form::close() }}
                    </section>
                </div>
                       
            </div>
 
    </section>

</section>

@endsection