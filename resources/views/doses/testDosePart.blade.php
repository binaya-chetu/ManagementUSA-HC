




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
                                        <div class="row">
                                            <div class="col-sm-6 form-group{{ $errors->has('injection') ? ' has-error' : '' }}">
                                                {{ Form::label('injection', 'Injetion', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $amount = dropDownAmount(); ?>

                                                    {{ Form::select('injection', (['' => 'Select Injection'] + $amount), null, ['class' => 'form-control input required amount', 'id' => 'injection']) }}

                                                    @if ($errors->has('amount1'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('injection') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 form-group{{ $errors->has('injection2') ? ' has-error' : '' }}">
                                                {{ Form::label('injection2', 'Injection 2 ', array('class' => 'col-sm-3 control-label mandatory')) }}
                                                <div class="col-sm-9">
                                                    <?php $medication = dropDownMedication(); ?>
                                                    {{ Form::select('injection2', (['' => 'Select Medication'] + $medication), null, ['class' => 'form-control input required amount', 'id' => 'injection2']) }} 
                                                    @if ($errors->has('injection2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('injection2') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-6 form-group{{ $errors->has('amount2') ? ' has-error' : '' }}">
                                                {{ Form::label('', 'Injection', array('class' => 'col-sm-3 control-label mandatory')) }}
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
                                                {{ Form::label('inje', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
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
                                        
                                     </div>
                                </section>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </section>
