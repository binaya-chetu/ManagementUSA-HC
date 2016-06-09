<?php echo e(Form::open(array('url' => '/appointment/addappointment', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'addAppointment'))); ?>  
<?php echo csrf_field(); ?>

<div id="docApptSchedule" class="modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <button title="Close (Esc)" type="button" class="mfp-close" >×</button>
        <div class="panel-body">

        </div>
    </section>
</div>

<section class="panel panel-primary">
    <header class="panel-heading">
        <h2 class="panel-title">Create  Appointment</h2>
    </header>
    <div class="panel-body">
        <div class="form-group">
            <?php echo e(Form::label('doctor_id', 'Doctor', array('class' => 'col-sm-4 control-label'))); ?>

            <div class="col-md-6 commentdiv">
                <select  class="form-control chosen" name="doctor_id" id="doctor_id">
                    <option value="">Choose Doctor</option>
                    <?php foreach($doctors as $doctor): ?>
                    <option value="<?php echo e($doctor->id); ?>" <?php echo e(old('doctor_id') == $doctor->id ? 'selected="selected"' :''); ?>><?php echo e($doctor->first_name); ?> <?php echo e($doctor->last_name); ?></option>
                    <?php endforeach; ?>
                </select>    
                
            </div>
            <div class="showDocScheddulerLInk"></div>
        </div>

        <div class="form-group<?php echo e($errors->has('appDate') ? ' has-error' : ''); ?>">
            <?php echo e(Form::label('appDate', 'Choose Date & Time', array('class' => 'col-sm-4 control-label mandatory'))); ?>


            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <?php echo e(Form::text('appDate', old('appDate'), ['class' => 'form-control required selectDate', 'data-plugin-datepicker', 'placeholder' => 'Choose Date', 'id' =>'calendarDate'])); ?>

                </div>
                <?php if($errors->has('appDate')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('appDate')); ?></strong>
                </span>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </span>
                    <?php echo e(Form::text('appTime', old('appTime'), ['class' => 'form-control required', 'data-plugin-timepicker', 'placeholder' => 'Choose Date'])); ?>

                </div>
            </div>
            <?php echo e(Form::hidden('marketer', 1)); ?>

            <?php echo e(Form::hidden('createdBy', Auth::user()->id)); ?>

            <?php echo e(Form::hidden('lastUpdatedBy', Auth::user()->id)); ?>

            <?php echo e(Form::hidden('apptSlotDuration', config('constants.DEFAULT_APPOINTMENT_TIME_SPAN'))); ?>

            <?php echo e(Form::hidden('clinicOpeningTime', config('constants.CLINIC_OPEN_TIME'))); ?>

            <?php echo e(Form::hidden('clinicClosingTime', config('constants.CLINIC_CLOSE_TIME'))); ?>

        </div>   
        <div class="form-group<?php echo e($errors->has('patient_id') ? ' has-error' : ''); ?>">        
            <?php echo e(Form::label('patient_id', 'Patient', array('class' => 'col-sm-4 control-label'))); ?>

            <div class="col-md-5 patient_id commentdiv" id="patientMainDiv">
                
                <select  class="form-control chosen" name="patient_id" id="patient_id">
                    <option value="">Choose Patient</option>
                    <?php foreach($patients as $patient): ?>
                         <?php if(!empty($id)): ?>
                            <?php if($id == $patient->id): ?>
                                <option  <?php echo e(old('patient_id') == $patient->id ? 'selected="selected"' :''); ?> value="<?php echo e($patient->id); ?>"><?php echo e($patient->first_name); ?> <?php echo e($patient->last_name); ?></option>
                            <?php endif; ?>
                             
                            <?php else: ?>
                                <option <?php echo e(old('patient_id') == $patient->id ? 'selected="selected"' :''); ?> value="<?php echo e($patient->id); ?>"><?php echo e($patient->first_name); ?> <?php echo e($patient->last_name); ?></option>  
                        <?php endif; ?>
                   <?php endforeach; ?>
                   
                </select>  
                <?php if($errors->has('patient_id')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('patient_id')); ?></strong>
                </span>
                <?php endif; ?>
                <?php echo e(Form::hidden('clinic', Auth::user()->id)); ?>

            </div>
            <div class="col-sm-3">
                <div class="mb-md">
                    <?php echo e(Form::button(
                                    '<i class="fa fa-plus"></i> Add Patient',
                                        ['class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'id' => 'addAppPatient', 'data-token' => csrf_token() ])); ?>

                </div>
            </div>
        </div>
        <div id="patient_come"  style="display:none;">
            <div class="form-group<?php echo e($errors->has('first_name') ? ' has-error' : ''); ?>"> 
                <?php echo e(Form::label('first_name', 'First Name', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-sm-6"> 
                    <?php echo e(Form::hidden('id')); ?>

                    <?php echo e(Form::text('first_name', old('first_name'), ['class' => 'form-control required', 'id' => 'first_name', 'placeholder' => 'First Name'])); ?>

                    <?php if($errors->has('patient_id')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                    </span>
                    <?php endif; ?> 
                </div> 
            </div> 

            <div class="form-group<?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>"> 
                <?php echo e(Form::label('last_name', 'Last Name', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-sm-6"> 
                    <?php echo e(Form::text('last_name', old('last_name'), ['class' => 'form-control required', 'id' => 'last_name', 'placeholder' => 'Last Name'])); ?>

                    <?php if($errors->has('patient_id')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div> 
            </div> 

            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>"> 
                <?php echo e(Form::label('email', 'Email', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-sm-6">   
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <?php echo e(Form::email('email', old('email'), ['class' => 'form-control required', 'id' => 'email', 'placeholder' => 'Email'])); ?>

                    </div>
                    <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div> 
            </div> 

            <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>"> 
                <?php echo e(Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-sm-6"> 
                    <?php echo e(Form::text('phone', old('phone'), ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14'])); ?>

                </div> 
                <?php if($errors->has('phone')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('phone')); ?></strong>
                </span>
                <?php endif; ?>
            </div> 

            <div class="form-group"> 
                <?php echo e(Form::label('dob', 'Date of Birth', ['class' => 'col-sm-4 control-label'])); ?>

                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <?php echo e(Form::text('dob', null, ['class' => 'form-control', 'data-plugin-datepicker', 'placeholder' => 'Date of Birth'])); ?>

                    </div>
                </div>
                <?php if($errors->has('dob')): ?> 

                <span class="help-block"> <strong><?php echo e($errors->first('dob')); ?></strong> 
                </span> <?php endif; ?> 
            </div> 

            <div class="form-group"> 
                <?php echo e(Form::label('gender', 'Gender', ['class' => 'col-sm-4 control-label'])); ?>


                <div class="col-sm-6"> 
                    <div class="col-sm-3"> 

                        <div class="radio-custom radio-primary"> 
                            <?php echo e(Form::radio('gender', 'Male', true, ['id' => 'optionsRadios1', 'id' => "awsome"])); ?> 
                            <label for="awesome">Male
                            </label> 
                        </div> 
                    </div> 

                    <div class="col-sm-3"> 
                        <div class="radio-custom radio-primary"> 
                            <?php echo e(Form::radio('gender', 'Female', true, ['id' => 'optionsRadios1', 'id' => "very-awsome"])); ?> 
                            <label for="very-awesome">Female
                            </label> 
                        </div> 
                    </div> 
                </div> 
            </div> 

            <div class="form-group"> 
                <?php echo e(Form::label('address1', 'Address', ['class' => 'col-sm-4 control-label'])); ?>

                <div class="col-sm-6"> 
                    <?php echo e(Form::text('address1', null, ['class' => 'form-control', 'placeholder' => 'Primary Address', 'id' => 'address1'])); ?>

                </div> 
            </div>
            
            <div class="form-group<?php echo e($errors->has('zipCode') ? ' has-error' : ''); ?>">
                <?php echo e(Form::label('zipCode', 'Zip Code', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-sm-6">
                    <?php echo e(Form::text('zipCode', null, ['class' => 'form-control required', 'placeholder' => 'Zip Code', 'id' => 'zipCode', 'maxlength' => '15', 'minlength' => '6', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"])); ?>

                    <?php if($errors->has('zipCode')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('zipCode')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>

        </div><br/>
        <div class="form-group<?php echo e($errors->has('comment') ? ' has-error' : ''); ?>">
            <?php echo e(Form::label('comment', 'Comment', ['class' => 'col-sm-4 control-label mandatory'])); ?>

            <div class="col-md-6">
                <?php echo e(Form::textarea('comment', old('comment'), ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'id' => 'comment', 'rows' => 3])); ?>


                <?php if($errors->has('comment')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('comment')); ?></strong>
                </span>
                <?php endif; ?>
            </div>
        </div>


    </div>
    <footer class="panel-footer">
        <div class="row">
            <?php if(Request::segment(2) === 'newAppointment'): ?>
            <div class="col-md-12 col-md-offset-4">
                <?php echo e(Form::button(
                                    '<i class="fa fa-btn fa-user"></i>  Add Appointment',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit'))); ?>  
            </div>

            <?php else: ?>
            <div class="col-md-12 text-right">
                <?php echo e(Form::button(
                                    '<i class="fa fa-btn fa-user"></i>  Add Appointment',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit'))); ?>

                <button class="btn btn-default closePop">Cancel</button>
            </div>
            <?php endif; ?>


        </div>
    </footer>
</section>
<?php echo e(Form::close()); ?>

