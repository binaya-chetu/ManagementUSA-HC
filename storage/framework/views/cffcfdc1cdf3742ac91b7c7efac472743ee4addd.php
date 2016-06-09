<?php $__env->startSection('content'); ?>

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit patient :  <?php echo e($patient->first_name); ?> <?php echo e($patient->last_name); ?></h2>
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
                    <h2 class="panel-title"><strong>Edit Patient </strong> </h2>
                </header>
                <?php echo Form::model($patient, ['method' => 'post','url' => ['patient/updatePatient', $patient->id], 'id' => 'patient', 'files' => true]); ?>

                <?php echo e(csrf_field()); ?>

                <div class="panel-body">
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
                                <?php echo e(Form::email('email', null, ['class' => 'form-control required', 'id' => 'email', 'readonly'])); ?>

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
                                    <?php if($patient['patientDetail']->gender === 'Female') { $female = true; $male = false; } else { $male = true; $female = false; }?>
                                    <label>
                                        <?php echo e(Form::radio('gender', 'Male', $male, ['id' => 'optionsRadios1'])); ?>

                                        Male
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <?php echo e(Form::radio('gender', 'Female', $female, ['id' => 'optionsRadios2'])); ?>


                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('marital', 'Marital Status', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php $marital = ['Married' => 'Married', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed', 'Single' => 'Single']; ?>
                                <?php echo e(Form::select('marital_status', array_merge(['0' => 'Please Select Marital Status'], $marital), $patient['patientDetail']->marital_status, ['class' => 'form-control input', 'id' => 'maritalStatus'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('address1', 'Address Line 1', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('address1', $patient['patientDetail']->address1, ['class' => 'form-control', 'placeholder' => 'Primary Address', 'id' => 'address1', 'rows' => 3])); ?>

                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('address2', 'Address Line 2', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('address2', $patient['patientDetail']->address2, ['class' => 'form-control', 'placeholder' => 'Secondary Address', 'id' => 'address2', 'rows' => 3])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('city', 'City', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('city', $patient['patientDetail']->city, ['class' => 'form-control', 'placeholder' => 'City', 'id' => 'city'])); ?>

                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('state', 'State', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::select('state', array_merge(['0' => 'Please Select State'], $states), $patient['patientDetail']->state, ['class' => 'form-control input', 'id' => 'state'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group<?php echo e($errors->has('zipCode') ? ' has-error' : ''); ?>">
                            <?php echo e(Form::label('zipCode', 'Zip Code', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('zipCode', $patient['patientDetail']->zipCode, ['class' => 'form-control required', 'placeholder' => 'Zip Code', 'id' => 'zipCode', 'maxlength' => '15', 'minlength' => '6', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"])); ?>

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
                                <?php echo e(Form::text('phone', $patient['patientDetail']->phone, ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14'])); ?>

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
                                <?php echo e(Form::text('mobile', $patient['patientDetail']->mobile, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'id' => 'mobile', 'maxlength' => '14'])); ?>

                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('call_time', 'Best Time To Call', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php $patientCallHour = callHourTime(); ?>
                                <?php echo e(Form::select('call_time', array_merge(['0' => 'Please Select Best Time To Call'], $patientCallHour), $patient['patientDetail']->call_time, ['class' => 'form-control input', 'id' => 'call_time'])); ?>

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
                                    <?php 
                                        $dob = ''; 
                                        if($patient['patientDetail']->dob)
                                        {
                                            $dob = date('m/d/Y', strtotime($patient['patientDetail']->dob));
                                        }
                                    ?>
                                    <?php echo e(Form::text('dob', $dob, ['class' => 'form-control', 'data-plugin-datepicker', 'placeholder' => 'Date of Birth'])); ?>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('work', 'Work', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('work', $patient['patientDetail']->work, ['class' => 'form-control input-sm', 'id' => 'w3-work', 'placeholder' => 'Work'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('employer', 'Place of Employement', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('employer', $patient['patientDetail']->employer, ['class' => 'form-control', 'placeholder' => 'Employer', 'id' => 'employer'])); ?>

                            </div>
                        </div>					

                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('occupation', 'Occupation', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('occupation', $patient['patientDetail']->occupation, ['class' => 'form-control', 'placeholder' => 'Occupation', 'id' => 'occupation'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('height', 'Height', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-3">
                                <?php $commonHeight = commonHeight(); ?>
                                <?php echo e(Form::select('height', array_merge(['0' => 'Please Select The Height'], $commonHeight), $patient['patientDetail']->height, ['class' => 'form-control input', 'id' => 'height'])); ?>

                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('height', 'Weight', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-3">
                                <?php $commonWeight = commonWeight();  ?>
                                <?php echo e(Form::select('weight', array_merge(['0' => 'Please Select The Weight'], $commonWeight), $patient['patientDetail']->weight, ['class' => 'form-control input', 'id' => 'weight'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('physician', 'Primary Physician', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('primary_physician', $patient['patientDetail']->primary_physician, ['class' => 'form-control input-sm', 'id' => 'w3-physician', 'placeholder' => 'Primary Care Physician Name'])); ?>

                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('physician_phone', 'Physician Phone', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::text('physician_phone', $patient['patientDetail']->physician_phone, ['class' => 'form-control input-sm', 'id' => 'phone', 'placeholder' => 'Physician Phone'])); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('driving_license', 'Driving License', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::file('driving_license', null, ['class' => 'form-control'])); ?>

                                <?php if( isset($patient['patientDetail']->driving_license) && !empty($patient['patientDetail']->driving_license)): ?>
                                    <a href="<?php echo e(URL::asset('uploads/patient_documents/'.$patient['patientDetail']->driving_license)); ?>" download="myimage" class="document_link" ><img height="100" width="100" src="<?php echo e(URL::asset('uploads/patient_documents/'.$patient['patientDetail']->driving_license)); ?>" ></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('payment_bill', 'Payment Bill', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-9">
                                <?php if( isset($patient->payment_bill) && !empty($patient->payment_bill)): ?>
                                    <a href="<?php echo e(URL::asset('uploads/patient_documents/'.$patient->payment_bill)); ?>" download="myimage" class="document_link" ><img src="<?php echo e(URL::asset('images/pdf_icon.png')); ?>" ></a>
                                <?php endif; ?>
                                <?php echo e(Form::file('payment_bill', null, ['class' => 'form-control'])); ?>


                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <?php echo e(Form::label('never_treat_status', 'Never Treat', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-md-9">
                                <div class="checkbox">
                                    <label>
                                        <?php echo e(Form::checkbox('never_treat_status', null, $patient['patientDetail']->never_treat_status, ['id' => 'never_treat_status'])); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button class="btn btn-primary">Submit</button>
                            <a href="/patient" class="btn btn-default">Back</a>
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