<?php $__env->startSection('content'); ?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add New Patient</h2>
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
                    <h2 class="panel-title"><strong>Add Patient </strong> </h2>
                </header>	
                 <?php echo e(Form::open(array('url' => 'patient/savePatient', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'patient'))); ?>

                <div class="panel-body">
                <!-- Display Validation Errors -->
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-sm-6 form-group<?php echo e($errors->has('first_name') ? ' has-error' : ''); ?>">
                           <?php echo e(Form::label('first_name', 'First Name', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::hidden('id')); ?>

                                <?php echo e(Form::text('first_name', null, ['class' => 'form-control required', 'id' => 'first-name', 'placeholder' => 'First Name'])); ?>

                                <?php if($errors->has('first_name')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('first_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('middle_name', 'Middle Name', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('middle_name', null, ['class' => 'form-control', 'id' => 'middle_name', 'placeholder' => 'Middle Name'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group<?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>">
                            <?php echo e(Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('last_name', null, ['class' => 'form-control required', 'id' => 'last-name', 'placeholder' => 'Last Name'])); ?>

                                <?php if($errors->has('last_name')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('last_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <?php echo e(Form::label('email', 'Email', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-sm-9">
                                 <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                <?php echo e(Form::email('email', null, ['class' => 'form-control required', 'id' => 'email', 'placeholder' => 'example@mail.com'])); ?>

                                 </div>
                                <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('gender', 'Gender', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-md-9">
                                <div class="radio">
                                    <label>
                                        <?php echo e(Form::radio('gender', 'Male', 'true', ['id' => 'optionsRadios1'])); ?>

                                        Male
                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <?php echo e(Form::radio('gender', 'Female', 'false', ['id' => 'optionsRadios2'])); ?>


                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('marital', 'Marital Status', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php $marital = ['Married' => 'Married', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed', 'Single' => 'Single']; ?>
                                <?php echo e(Form::select('marital_status', array_merge(['0' => 'Please Select Marital Status'], $marital), null, ['class' => 'form-control input', 'id' => 'maritalStatus'])); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('address1', 'Address Line 1', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('address1', null, ['class' => 'form-control', 'placeholder' => 'Primary Address', 'id' => 'address1'])); ?>

                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('address2', 'Address Line 2', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('address2', null, ['class' => 'form-control', 'placeholder' => 'Secondary Address', 'id' => 'address2'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('city', 'City', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City', 'id' => 'city'])); ?>

                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('state', 'State', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::select('state', array_merge(['' => 'Please Select State'], $states), null, ['class' => 'form-control input', 'id' => 'state'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group<?php echo e($errors->has('zipCode') ? ' has-error' : ''); ?>">
                            <?php echo e(Form::label('zipCode', 'Zip Code', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('zipCode', null, ['class' => 'form-control required', 'placeholder' => 'Zip Code', 'id' => 'zipCode', 'maxlength' => '15', 'minlength' => '6', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"])); ?>

                            <?php if($errors->has('zipCode')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('zipCode')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                             <?php echo e(Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('phone', null, ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14'])); ?>

                                <?php if($errors->has('phone')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('phone')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('mobile', 'Mobile', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'id' => 'mobile', 'maxlength' => '14'])); ?>

                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('call_time', 'Best Time To Call', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php $patientCallHour = callHourTime(); ?>
                                <?php echo e(Form::select('call_time', array_merge(['0' => 'Please Select Best Time To Call'], $patientCallHour), null, ['class' => 'form-control input', 'id' => 'call_time'])); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('dob', 'Date of Birth', ['class' => 'col-sm-3 control-label', 'id' => 'form'])); ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                     <?php echo e(Form::text('dob', null, ['class' => 'form-control', 'data-plugin-datepicker', 'placeholder' => 'Date of Birth'])); ?>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('work', 'Work', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('work', null, ['class' => 'form-control input-sm', 'id' => 'w3-work', 'placeholder' => 'Work'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('employer', 'Place of Employment', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('employer', null, ['class' => 'form-control', 'placeholder' => 'Place of Employement', 'id' => 'employer'])); ?>

                            </div>
                        </div>					

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('occupation', 'Occupation', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('occupation', null, ['class' => 'form-control', 'placeholder' => 'Occupation', 'id' => 'occupation'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('height', 'Height', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php $commonHeight = commonHeight(); ?>
                                <?php echo e(Form::select('height', array_merge(['0' => 'Please Select The Height'], $commonHeight), null, ['class' => 'form-control', 'id' => 'height'])); ?>

                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group">
                             <?php echo e(Form::label('weight', 'Weight', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php $commonWeight = commonWeight(); ?>
                                <?php echo e(Form::select('weight', array_merge(['0' => 'Please Select The Weight'], $commonWeight), null, ['class' => 'form-control', 'id' => 'weight'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('physician', 'Primary Physician', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('primary_physician', null, ['class' => 'form-control input-sm', 'id' => 'w3-physician', 'placeholder' => 'Primary Care Physician Name'])); ?>

                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('physician_phone', 'Physician Phone', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('physician_phone', null, ['class' => 'form-control input-sm', 'id' => 'phone', 'placeholder' => 'Physician Phone'])); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('driving_license', 'Driving License', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">                                   
                                <?php echo e(Form::file('driving_license', null, ['id' => 'driving_license'])); ?>

                            </div>
                        </div>
                    </div>
                </div>
                 
                 <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                                <?php echo e(Form::button(
                                    '<i class="fa fa-plus"></i> Add Patient',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit'))); ?>                               
                                <a href='/patient' class = 'mb-xs mt-xs mr-xs btn btn-default'>Cancel</a>
                            </div>
                    </div>
                </footer>
                 <?php echo e(Form::close()); ?>

            </section>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>