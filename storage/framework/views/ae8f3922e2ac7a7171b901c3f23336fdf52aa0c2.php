<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<link rel="stylesheet" href="<?php echo e(URL::asset('vendor/jquery-timepicker/jquery.timepicker.css')); ?>" />
<script src="<?php echo e(URL::asset('vendor/jquery-timepicker/jquery.timepicker.js')); ?>"></script>
<section role="main" class="content-body">
    <header class="page-header">
        <?php if($value == 'marketingCall'){                                    
                $type = 'Tele-Marketing Call';
            }else if($value == 'walkin'){
                $type = 'Direct Walkin ';
            }
        ?>
        <h2>Create Appointment From <?php echo e($type); ?></h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span><?php echo e($type); ?></span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">
            <?php echo e(Form::open(array('url' => '/apptsetting/saveApptFollowup', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'addApptRequest'))); ?>

            <?php echo csrf_field(); ?>            
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Create  Appointment</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <?php if(Session::has('flash_message')): ?>
                            <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> <?php echo session('flash_message'); ?></em></div></div>
                        <?php endif; ?>
                    </div>
                    <?php if($type == 'Tele-Marketing Call'): ?>
                    <div class="form-group">
                            <?php echo e(Form::label('phone', 'Marketing Phone', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-6">
                                <?php echo e(Form::text('telemarketing_phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Phone', 'maxlength' => '14', 'readonly' => true])); ?>

                            </div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <?php $time = $type.' Time'; ?>
                        <?php echo e(Form::label('callTime', $time, array('class' => 'col-sm-3 control-label'))); ?>


                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo e(Form::text('created', date('m/d/Y'), ['class' => 'form-control', 'readonly' => true])); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                <?php echo e(Form::text('created_time', date('h:i A'), ['class' => 'form-control', 'readonly' => true])); ?>

                            </div>
                        </div>
                        <?php echo e(Form::hidden('created_by', Auth::user()->id)); ?>

                        <?php if($value == 'marketingCall'){                                    
                                        $appt_type = '2';
                                    }else if($value == 'walkin'){
                                        $appt_type = '3';
                                    }
                                ?>
                        <?php echo e(Form::hidden('appt_source', $appt_type)); ?>

                    </div>
<!--                    <div class="form-group">
                            <?php echo e(Form::label('appt_type', 'Appointment Type', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-md-6">
                                <?php if($value == 'marketingCall'){                                    
                                        $type = '2';
                                    }else if($value == 'walkin'){
                                        $type = '3';
                                    }
                                ?>
                                <?php echo e(Form::select('appt_source1',  $resources, $type, ['class' => 'form-control required', 'disabled' => true])); ?>

                                
                            </div>
                    </div>-->
                  
                    <div class="form-group<?php echo e($errors->has('patient_id') ? ' has-error' : ''); ?>">
                        <?php echo e(Form::label('patient_id', 'Patient', array('class' => 'col-sm-3 control-label mandatory'))); ?>

<!--                        <div class="col-md-5 patient_id commentdiv" id="patientMainDiv">
  
                            <select  class="form-control chosen" name="patient_id" id="patient_id">
                                <option value="">Choose Any</option>
                                <?php foreach($patients as $patient): ?>
                                <option <?php echo e(old('patient_id') == $patient->id ? 'selected="selected"' :''); ?> value="<?php echo e($patient->id); ?>"><?php echo e($patient->first_name); ?> <?php echo e($patient->last_name); ?> (<?php echo e($patient->email); ?>)</option>
                                <?php endforeach; ?>

                            </select>
                            <?php if($errors->has('patient_id')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('patient_id')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>-->
                        
  
                            <div class="col-md-3 patient_id" id="patientMainDiv">
                                <select  class="form-control" name="patient_id" id="patient_id">
                                    <option value="">Choose Any</option>
                                    <?php foreach($patients as $patient): ?>
                                        <option <?php echo e(old('patient_id') == $patient->id ? 'selected="selected"' :''); ?> value="<?php echo e($patient->id); ?>"><?php echo e($patient->first_name); ?> <?php echo e($patient->last_name); ?> </option>
                                    <?php endforeach; ?>

                                </select>
                                
                            </div>
                            <?php if($errors->has('patient_id')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('patient_id')); ?></strong>
                            </span>
                            <?php endif; ?>
                       
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
                            <?php echo e(Form::label('first_name', 'First Name', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-sm-6">
                                <?php echo e(Form::text('first_name', old('first_name'), ['class' => 'form-control required', 'id' => 'first_name', 'placeholder' => 'First Name'])); ?>

                                <?php if($errors->has('patient_id')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('first_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>">
                            <?php echo e(Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-6">
                                <?php echo e(Form::text('last_name', old('last_name'), ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Last Name'])); ?>

                                <?php if($errors->has('patient_id')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('last_name')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>" id='emailParent'>
                            <?php echo e(Form::label('email', 'Email', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <?php echo e(Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email'])); ?>

                                </div>
                                <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
 
                        <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                            <?php echo e(Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label'))); ?>

                            <div class="col-sm-6">
                                <?php echo e(Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14'])); ?>

                            </div>
                            <?php if($errors->has('phone')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('phone')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <?php echo e(Form::label('dob', 'Date of Birth', ['class' => 'col-sm-3 control-label'])); ?>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <?php echo e(Form::text('dob', old('dob'), ['class' => 'form-control', 'data-plugin-datepicker', 'placeholder' => 'Date of Birth'])); ?>

                                </div>
                            </div>
                        </div>

                    </div><br/>
<!--                    <div class="form-group<?php echo e($errors->has('comment') ? ' has-error' : ''); ?>">
                        <?php echo e(Form::label('comment', 'Comment', ['class' => 'col-sm-3 control-label mandatory'])); ?>

                        <div class="col-md-6">
                            <?php echo e(Form::textarea('comment', old('comment'), ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'id' => 'comment', 'rows' => 3])); ?>


                            <?php if($errors->has('comment')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('comment')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <?php echo e(Form::label('status', 'Status', array('class' => 'col-sm-3 control-label call_label mandatory'))); ?>

                        <div class="col-sm-8">
                            <div class="col-sm-3">
                                <div class="radio-custom radio-primary">
                                    <?php echo e(Form::radio('status', '1', false, ['id' => 'awesome', 'class' => 'callStatus required'])); ?>

                                    <label for="awesome">Set
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="radio-custom radio-primary">
                                    <?php echo e(Form::radio('status', '2', false, ['id' => 'very-awesome', 'class' => 'callStatus required'])); ?>

                                    <label for="very-awesome">No Set
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  id="nosetAppointment">
                        <div class="form-group">
                            <?php echo e(Form::label('reason_id', 'Reason Code', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-md-6">
                                <?php echo e(Form::select('reason_id', ['' => 'Choose the Reason Code'] + $reasonCode, null, ['class' => 'form-control required'])); ?>


                            </div>
                        </div>
                     
                        <div class="form-group">
                            <?php echo e(Form::label('followup', 'Follow-Up After One Week', ['class' => 'col-sm-3 control-label'])); ?>

                            <div class="col-md-1">
                                <div class="input-group">
                                   
                                    <?php echo e(Form::checkbox('followup_status', null, false, ['class' => 'followup_check', 'id' => 'followupWeek'])); ?>

                                
                                </div>
                            </div>
                            <?php echo e(Form::label('followup', 'OR', ['class' => 'col-sm-1 control-label'])); ?>

                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <?php echo e(Form::text('followup_date', null, ['class' => 'form-control selectDate', 'data-plugin-datepicker', 'placeholder' => 'Follow-Up Date', 'id' => 'followupDate'])); ?>

                                </div>
                            </div>
                        </div>
                  
                        <div class="form-group">
                            <?php echo e(Form::label('comment', 'Comment for No Set', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-md-6">
                                <?php echo e(Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3'])); ?>


                            </div>
                        </div>
                    </div>
                    <div  id="setAppointment">

                        <div class="form-group">
                            <?php echo e(Form::label('appDate', 'Appointment Time', array('class' => 'col-sm-3 control-label mandatory'))); ?>


                            <div class="col-md-3">
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

                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    <?php echo e(Form::text('appTime', date('h:ia'), ['class' => 'form-control required', 'placeholder' => 'Choose Time', 'id' => 'durationExample'])); ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('comment', 'Comment for Set', array('class' => 'col-sm-3 control-label mandatory'))); ?>

                            <div class="col-md-6">
                                <?php echo e(Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3'])); ?>


                            </div>
                        </div>
                    </div>


                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4">
                            <?php echo e(Form::button(
                                    '<i class="fa fa-btn fa-user"></i>  Add Appointment',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit'))); ?>

                        </div>
                    </div>
                </footer>
            </section>
            <?php echo e(Form::close()); ?>


        </div>
    </div>
</section>
<script>
    $('document').ready(function() {
        $('#nosetAppointment').hide();
        $('#setAppointment').hide();
    })
    $('.callStatus').on('click', function() {
        var call_value = $(this).val();
        if (call_value == 1) {
            $('#nosetAppointment').hide();
            $('#setAppointment').show();
        } else {
            $('#setAppointment').hide();
            $('#nosetAppointment').show();
        }
    });
     $('#durationExample').timepicker({
        'minTime': '09:00am',
        'maxTime': '05:00pm',
        'showDuration': true
    });
    


    /*
     * Code for the Checking the followup
     */

    $('#followupWeek').on('click', function(){
        if($(this).is(':checked')){
            var date = new Date();
            date.setDate(date.getDate() + 7);
            var dateMsg = ("0" + (date.getMonth() + 1)).slice(-2) +'/'+("0" + date.getDate()).slice(-2)+'/'+date.getFullYear();
            $('#followupDate').val(dateMsg);
            $('#followupDate').attr('disabled', true);
        }else{
            $('#followupDate').removeAttr('disabled');            
        }
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>