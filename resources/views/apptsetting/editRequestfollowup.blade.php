<div id="modalCall" class="modal-block modal-block-primary mfp-hide">    
        <section class="panel panel-primary">
            <header class="panel-heading">
                <h2 class="panel-title">Request Followup</h2>
            </header>
            {{ Form::open(array('url' => '/apptsetting/saveRequestFollowUp', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'requestFollowup')) }}
            <div class="panel-body">
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                    <div class="col-sm-8">
                        {{ Form::hidden('patient_id') }}
                        {{ Form::hidden('appointment_request_id') }}
                        {{ Form::hidden('appointment_id') }}
                        {{ Form::text('first_name', $requestFollowup['patient']->first_name, ['class' => 'form-control required', 'id' => 'first_name', 'placeholder' => 'First Name']) }}
                        @if ($errors->has('patient_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::text('last_name', $requestFollowup['patient']->last_name , ['class' => 'form-control ', 'id' => 'last_name', 'placeholder' => 'Last Name']) }}
                        @if ($errors->has('patient_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            {{ Form::email('email',$requestFollowup['patient']->email, ['class' => 'form-control ', 'id' => 'email', 'placeholder' => 'Email']) }}
                        </div>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    {{ Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::text('phone',  $phone , ['class' => 'form-control ', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14']) }}
                    </div>
                    @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
                
                <div class="form-group"> 
                    {{ Form::label('dob', 'DOB', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-md-8"> 
                        <div class="input-group"> 
                            <span class="input-group-addon"> <i class="fa fa-calendar"></i> 
                            </span>                           
                            {{ Form::text('dob',null , ['class' => 'form-control', 'data-plugin-datepicker', 'id' => 'dob']) }}
                        </div> 
                        @if ($errors->has('dob')) 
                        <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> 
                        </span>
                        @endif 
                    </div> 
                </div> 


                <div class="form-group">
                    {{ Form::label('status', 'Status', array('class' => 'col-sm-3 control-label call_label mandatory')) }}
                    <div class="col-sm-8">
                        <div class="col-sm-4">
                            <div class="radio-custom radio-primary">
                                {{ Form::radio('status', '0', false, ['id' => 'awesome', 'class' => 'callStatus required']) }}
                                <label for="awesome">Set
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="radio-custom radio-primary">
                                {{ Form::radio('status', '1', false, ['id' => 'very-awesome', 'class' => 'callStatus required']) }}
                                <label for="very-awesome">No Set (End)
                                </label>
                            </div>
                        </div>
                    </div>
                </div> 
                <div  id="nosetAppointment">
                    <div class="form-group">
                        {{ Form::label('noset_reason_id', 'Reason Code', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-md-8">
                            {{ Form::select('noset_reason_id', ['' => 'Choose the Reason Code'] + $noSetReasonCode, null, ['class' => 'form-control required']) }}

                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('comment', 'Comment for No Set', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-md-8">
                            {{ Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment','id' => 'noSetComment', 'rows' => '2']) }}

                        </div>
                    </div>
                </div>
                <div  id="setAppointment">
                    <div class="form-group">
                        {{ Form::label('setDate', 'Set Date', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>

                                {{ Form::text('appDate', old('appDate'), ['class' => 'form-control required selectDate', 'data-plugin-datepicker','id' =>'calendarDate']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                {{ Form::text('appTime', null, ['class' => 'form-control required', 'placeholder' => 'Choose Time', 'id' => 'durationExample']) }}  

                            </div>
                        </div>

                        {{ Form::hidden('createdBy', Auth::user()->id) }}
                        {{ Form::hidden('lastUpdatedBy', Auth::user()->id) }}
                        {{ Form::hidden('user_id', null, ['id' => 'user_id']) }} 

                    </div>
                    <div class="form-group">
                        {{ Form::label('reason_id', 'Reason for Visit', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-md-8">
                            {{ Form::select('reason_id', ['' => 'Choose the Reason'] + $reasonCode, null, ['class' => 'form-control required']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('comment', 'Comment for Set', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-md-8">
                            {{ Form::textarea('comment', null, ['class' => 'form-control required', 'id' => 'requestComment','placeholder' => 'Enter Comment', 'rows' => '2']) }}

                        </div>
                    </div>
                </div>
            </div>

            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        {{ Form::button( 'Save', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type' => 'submit','id'=>'saveRequest')) }}
                    </div>
                </div>
            </footer>
            {{ Form::close() }}
        </section>

    </div>
