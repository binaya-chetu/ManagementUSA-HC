<?php echo e(Form::open(array('url' => '/appointment/saveappointment', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'editAppointment'))); ?>  
<?php echo csrf_field(); ?>

<section class="panel panel-primary">
    <header class="panel-heading">
        <h2 class="panel-title">Edit Appointment</h2>
    </header>
    <div class="panel-body">
		<div class="form-group">
            <?php echo e(Form::label('Doctor', 'Doctor', array('class' => 'col-sm-4 control-label'))); ?>

            <div class="col-md-6">
                <select  class="form-control chosen" name="doctor_id" id="doctor_id">
                    <option value="">Choose Doctor</option>
                    <?php foreach($doctors as $doctor): ?>
                    <option value="<?php echo e($doctor->id); ?>"><?php echo e($doctor->first_name); ?> <?php echo e($doctor->last_name); ?></option>
                    <?php endforeach; ?>
                </select>    
            </div>
            <div class="showDocScheddulerLInk"></div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('appointment_time', 'Choose Date & Time', array('class' => 'col-sm-4 control-label mandatory'))); ?>

            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <?php echo e(Form::text('appDate', old('appDate'), ['class' => 'form-control required', 'data-plugin-datepicker', 'id' => 'apptdate'])); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </span>
                    <?php echo e(Form::text('appTime', old('appTime'), ['class' => 'form-control required', 'data-plugin-timepicker'])); ?>

                </div>
            </div>
            <?php echo e(Form::hidden('appointment_id', 1,['id' => 'appointment_id'])); ?>

            <?php echo e(Form::hidden('marketer', 1)); ?>         
            <?php echo e(Form::hidden('lastUpdatedBy', Auth::user()->id)); ?>

        </div>   
        
        <div class="form-group">
            <?php echo e(Form::label('patient', 'Patient', array('class' => 'col-sm-4 control-label'))); ?>


            <div class="col-md-6">
                <select  class="form-control chosen" name="patient_id" id="patient_id" disabled="true">
                    <option value="" disabled>Choose Patient</option>
                    <?php foreach($patients as $patient): ?>
                    <option value="<?php echo e($patient->id); ?>"><?php echo e($patient->first_name); ?> <?php echo e($patient->last_name); ?></option>
                    <?php endforeach; ?>                 
                </select>    
                <?php echo e(Form::hidden('clinic', Auth::user()->id)); ?>

                <?php echo e(Form::hidden('patient_id')); ?>               
            </div>
        </div>
        
        <!-- Patient Edited Details -->
        <div class="form-group"> 
            <?php echo e(Form::label('first_name', 'First Name', array('class' => 'col-sm-4 control-label mandatory'))); ?>

            <div class="col-sm-6"> 
                <?php echo e(Form::hidden('id')); ?>      
                <?php echo e(Form::text('first_name', old('first_name'), ['class' => 'form-control required', 'id' => 'first-name', 'placeholder' => 'First Name'])); ?>

                <span class="help-block firstName">
                </span> 
            </div> 
        </div> 
        <div class="form-group"> 
            <?php echo e(Form::label('last_name', 'Last Name', array('class' => 'col-sm-4 control-label mandatory'))); ?>

            <div class="col-sm-6"> 
                <?php echo e(Form::text('last_name', old('last_name'), ['class' => 'form-control required', 'id' => 'last-name', 'placeholder' => 'Last Name'])); ?>

                <span class="help-block lastName">
                </span>
            </div> 
        </div> 
        <div class="form-group"> 
            <?php echo e(Form::label('email', 'Email', array('class' => 'col-sm-4 control-label'))); ?>

            <div class="col-sm-6"> 
                <?php echo e(Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'disabled' => true])); ?>

                <span class="help-block email">
                </span> 
            </div> 
        </div> 
        <div class="form-group">             
            <?php echo e(Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label'))); ?>

            <div class="col-sm-6"> 
                <?php echo e(Form::text('phone', old('phone'), ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14'])); ?>

            </div> 
        </div> 
        <div class="form-group"> 
            <?php echo e(Form::label('dob', 'DOB', array('class' => 'col-sm-4 control-label'))); ?>

            <div class="col-md-6"> 
                <div class="input-group"> 
                    <span class="input-group-addon"> <i class="fa fa-calendar"></i> 
                    </span> 
                    <?php echo e(Form::text('dob', old('dob'), ['class' => 'form-control', 'data-plugin-datepicker', 'id' => 'dob'])); ?>

                </div> 
                <?php if($errors->has('dob')): ?> 
                <span class="help-block"> <strong><?php echo e($errors->first('dob')); ?></strong> 
                </span>
                <?php endif; ?> 
            </div> 
        </div> 
        <div class="form-group"> 
            <?php echo e(Form::label('gender', 'Gender', array('class' => 'col-sm-4 control-label'))); ?>

            <div class="col-sm-6"> 
                <div class="col-sm-3"> 
                    <div class="radio-custom radio-primary"> 
                        <?php echo e(Form::radio('gender', 'Male', true, ['id' => 'awesome'])); ?>

                        <label for="awesome">Male
                        </label> 
                    </div> 
                </div> 
                <div class="col-sm-3"> 
                    <div class="radio-custom radio-primary"> 
                        <?php echo e(Form::radio('gender', 'Female', false, ['id' => 'very-awesome'])); ?>

                        <label for="very-awesome">Female
                        </label> 
                    </div> 
                </div> 
            </div> 
        </div> 
        <div class="form-group"> 
            <?php echo e(Form::label('address', 'Address line 1', array('class' => 'col-sm-4 control-label'))); ?>

            <div class="col-sm-6"> 
                <?php echo e(Form::text('address1', old('dob'), ['class' => 'form-control', 'placeholder' => 'Primary Address', 'id' => 'address1'])); ?>

            </div> 
        </div> 
        <!-- End -->
        <div class="form-group<?php echo e($errors->has('comment') ? ' has-error' : ''); ?>">
            <?php echo e(Form::label('comment', 'Comment', array('class' => 'col-sm-4 control-label mandatory'))); ?>

            <div class="col-md-6">
                <?php echo e(Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'id' => 'appointmentComment', 'rows' => '3'])); ?>

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
            <div class="col-md-4 followButton">
                <?php echo e(Form::button('Follow Up', [ 'class' => 'btn btn-primary followUp' ])); ?>

            </div>
            <div class="col-md-8 text-right">
                <?php echo e(Form::button( 'Submit', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit'))); ?>

                <a href="javascript:void(0)" class="btn btn-default remove-row confirmation-callback" id = "deleteAppointmentFromCalendar"><i class="fa fa-trash-o"></i> Delete</a> 
                <button class="btn btn-default closePop">Cancel</button>
            </div>
        </div>
    </footer>
</section>
</form> 
<script>
    $(function() {
        $('.confirmation-callback').confirmation({
            onConfirm: function() {
                var link = $('.confirmation-callback').data('href');
                window.location = ajax_url + link;
            }
        });
    });
</script>