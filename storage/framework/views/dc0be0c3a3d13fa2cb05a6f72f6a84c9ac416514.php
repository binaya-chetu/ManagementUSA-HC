<div id="modal-followup-status" class="modal-block modal-block-primary mfp-hide">
    <?php echo e(Form::open(array('url' => '/appointment/saveAppointmentFolloup', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'followUp'))); ?>

    <?php echo csrf_field(); ?>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Followup Appointment</h2>
        </header>
        <div class="panel-body">
            <div class="form-group">
                <?php echo e(Form::label('status', 'Followup Status', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-md-6">
                    <div class="radio">
                        <label>
                            <?php echo e(Form::radio('action', 'Reschedule', false, ['id' => 'optionsRadios1', 'class' => 'required'])); ?>

                            Reschedule Appointment
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <?php echo e(Form::radio('action', 'Cancel', false, ['id' => 'optionsRadios2', 'class' => 'required'])); ?>

                            Cancel Appointment
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <?php echo e(Form::radio('action', 'Confirm', false, ['id' => 'optionsRadios3', 'class' => 'required'])); ?>

                            Confirmed Appointment
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <?php echo e(Form::radio('action', 'Later', false, ['id' => 'optionsRadios4', 'class' => 'required'])); ?>

                            Follow-up Later
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <?php echo e(Form::radio('action', 'Never Treat', false, ['id' => 'optionsRadios5', 'class' => 'required'])); ?>

                            Never Treat
                        </label>
                    </div>
                </div>
                <?php echo e(Form::hidden('appointment_id', 0, array('id' => 'followup_appointment_id'))); ?>

            </div>
            <div id="showOnSchedule">
                <div class="form-group" id="showOnlySchedule">
                    <label class="col-md-4 control-label">Choose Date & Time</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <?php echo e(Form::text('appDate', null, ['class' => 'form-control dateCalendar selectDate', 'data-plugin-datepicker'])); ?>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </span>
                            <?php echo e(Form::text('appTime', null, ['class' => 'form-control', 'data-plugin-timepicker'])); ?>

                        </div>
                    </div>

                </div>  
                <div class="form-group">
                    <?php echo e(Form::label('comment', 'Comment', array('class' => 'col-sm-4 control-label'))); ?>

                    <div class="col-sm-6">
                        <?php echo e(Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter the comment', 'rows' => 3])); ?>

                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-8 text-right">
                    <?php echo e(Form::button('Submit', ['class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit'])); ?>    
                    <button class="btn btn-default closePop">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
    <?php echo e(Form::close()); ?>  
</div>
