<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Tele-marketing Calls</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Tele-marketing Calls</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Tele-marketing Calls</h2>
        </header>
        <div class="panel-body">
            <!-- default / right -->
            <div class="row">
                <?php if(Session::has('flash_message')): ?>
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> <?php echo session('flash_message'); ?></em></div></div>
                <?php endif; ?>
                <div class="col-md-12 text-left">
                    <a href="javascript:void(0)"><button id="add_marketing_call" class="btn btn-primary" >Add Call<i class="fa fa-plus"></i></button></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabs tabs-primary">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#marketing" data-toggle="tab"><i class="fa fa-star"></i> Tele-marketing Calls</a>
                            </li>
                            <li>
                                <a href="#follow" data-toggle="tab">Follow-up (<?php echo e(count($follows)); ?>)</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="marketing" class="tab-pane active">


                                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="<?php echo e(URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf')); ?>">

                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>Name</th>                        
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Requested Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($calls as $call): ?>
                                        <tr>
                                            <td class="table-text table-text-id"><div><?php echo e($i++); ?></div></td>
                                            <td class="table-text"><?php echo e($call->first_name); ?> <?php echo e($call->last_name); ?></td>
                                            <td class="table-text"><?php echo e($call->email); ?></td>
                                            <td class="table-text"><?php echo e($call->phone); ?></td>                        
                                            <td class="table-text"> <?php echo e(date('Y-m-d h:ia', strtotime($call->requested_date))); ?></td>
                                            <td class="actions">
                                                <a href="javascript:void(0);" class="on-editing save-row call_popup" title="Edit" rel="<?php echo e($call->id); ?>"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>                                         
                                    </tbody>
                                </table> 


                            </div>
                            <div id="follow" class="tab-pane">
                                <p>Recent</p>
                                <table class="table table-bordered table-striped mb-none" id="datatable-default">

                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>Name</th>                        
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Requested Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $j = 1; ?>
                                        <?php foreach($follows as $follow): ?>
                                        <tr>
                                            <td class="table-text table-text-id"><div><?php echo e($j++); ?></div></td>
                                            <td class="table-text"><?php echo e($follow->web_lead->first_name); ?> <?php echo e($follow->web_lead->last_name); ?></td>
                                             <td class="table-text"><?php echo e($follow->web_lead->email); ?></td>
                                            <td class="table-text"><?php echo e($follow->web_lead->phone); ?></td>                        
                                            <td class="table-text"> <?php echo e(date('Y-m-d h:ia', strtotime($follow->web_lead->requested_date))); ?></td>
                                            <td class="actions">
<!--                                                <a href="javascript:void(0);" class="on-editing save-row lead_popup" title="Edit" rel="<?php echo e($follow->web_lead->id); ?>"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            -->
                                            </td>
                                        </tr>  
                                        <?php endforeach; ?>


                                    </tbody>
                                </table> 

                            </div>
                        </div>
                    </div>
                </div>                
            </div>

        </div>
    </section>
</section>
<!-- Modal Form -->
<div id="modalCall" class="modal-block modal-block-primary mfp-hide">    
    
    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Tele-marketing Calls Followup</h2>
        </header>
        <?php echo e(Form::open(array('url' => '/apptsetting/saveApptFollowup', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'callStatus'))); ?>  
        <div class="panel-body">
            <div class="form-group"> 
                <?php echo e(Form::label('status', 'Status', array('class' => 'col-sm-4 control-label call_label mandatory'))); ?>

                <div class="col-sm-8"> 
                    <div class="col-sm-6"> 
                        <div class="radio-custom radio-primary"> 
                            <?php echo e(Form::hidden('appt_id', null, ['id' => 'apptId'])); ?>  
                            <?php echo e(Form::hidden('appt_type', 2)); ?> 
                            <?php echo e(Form::radio('status', '1', false, ['id' => 'awesome', 'class' => 'callStatus required'])); ?>

                            <label for="awesome">Set
                            </label>
                        </div> 
                    </div> 
                    <div class="col-sm-6"> 
                        <div class="radio-custom radio-primary"> 

                            <?php echo e(Form::radio('status', '2', false, ['id' => 'very-awesome', 'class' => 'callStatus required'])); ?>

                            <label for="very-awesome">No Set
                            </label> 
                        </div> 
                    </div> 
                </div> 
            </div>
            <div  id="reasonCode">
                <div class="form-group">
                    <?php echo e(Form::label('reason_id', 'Reason Code', array('class' => 'col-sm-4 control-label mandatory'))); ?>


                    <div class="col-md-6">
                        <?php echo e(Form::select('reason_id', ['' => 'Choose the Reason Code'] + $reasonCode, ['class' => 'form-control required'])); ?>


                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('follow-up', 'Follow-up after one week', array('class' => 'col-sm-4 control-label'))); ?>


                    <div class="col-md-6">
                        <?php echo e(Form::checkbox('followup_status',null, false, ['class' => 'followup_check'])); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('comment', 'Comment', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                    <div class="col-md-6">
                        <?php echo e(Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3'])); ?>                        
                                             
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-md-12 text-right">
                    <?php echo e(Form::button( 'Submit', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type' => 'submit'))); ?>

                    <button class="btn btn-default closePop">Cancel</button>
                </div>
            </div>
        </footer>
        <?php echo e(Form::close()); ?>

    </section>    
</div>
<!-- Modal Form -->
<div id="modal_add_marketing_call" class="modal-block modal-block-primary mfp-hide">  
    <?php echo e(Form::open(array('url' => '/apptsetting/saveMarketingCall', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'editAppointment'))); ?>  
    <?php echo csrf_field(); ?>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Add New</h2>
        </header>
        <div class="panel-body">            
            <div class="form-group">
                <?php echo e(Form::label('appointment_time', 'Choose Date & Time', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <?php echo e(Form::text('appDate', old('appDate'), ['class' => 'form-control required', 'data-plugin-datepicker', 'id' => 'calendarDate'])); ?>

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
            </div>   
            <!-- Patient Edited Details -->
            <div class="form-group"> 
                <?php echo e(Form::label('first_name', 'First Name', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-sm-6"> 
                    <?php echo e(Form::hidden('id')); ?>      
                    <?php echo e(Form::text('first_name', old('first_name'), ['class' => 'form-control required', 'id' => 'first-name', 'placeholder' => 'First Name'])); ?>                    
                </div> 
            </div> 
            <div class="form-group"> 
                <?php echo e(Form::label('last_name', 'Last Name', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-sm-6"> 
                    <?php echo e(Form::text('last_name', old('last_name'), ['class' => 'form-control required', 'id' => 'last-name', 'placeholder' => 'Last Name'])); ?>                    
                </div> 
            </div> 
            <div class="form-group"> 
                <?php echo e(Form::label('email', 'Email', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-sm-6"> 
                    <?php echo e(Form::text('email', old('email'), ['class' => 'form-control required', 'id' => 'email', 'placeholder' => 'Email'])); ?>                    
                </div> 
            </div> 
            <div class="form-group">             
                <?php echo e(Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-sm-6"> 
                    <?php echo e(Form::text('phone', old('phone'), ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14'])); ?>

                </div> 
            </div>             

            <div class="form-group<?php echo e($errors->has('comment') ? ' has-error' : ''); ?>">
                <?php echo e(Form::label('comment', 'Comment', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                <div class="col-md-6">
                    <?php echo e(Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'id' => 'appointmentComment', 'rows' => '3'])); ?>                   
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-md-12 text-right">
                    <?php echo e(Form::button( 'Submit', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit'))); ?>                    
                    <button class="btn btn-default closePop">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
    <?php echo e(Form::close()); ?>

</div>

<script>
    $('document').ready(function() {
        $('#reasonCode').hide();
        $('#callStatus').validate();
    })

    $('.call_popup').on('click', function() {       
         $('#apptId').val($(this).attr('rel'));
        $.magnificPopup.open({
            items: {
                src: '#modalCall',
                type: 'inline'
            }
        });
    });
    $('.callStatus').on('click', function() {
        var call_value = $(this).val();
        console.log(call_value);
        if (call_value == 1) {
            $('#reasonCode').hide();
        } else {
            $('#reasonCode').show();
        }
    });


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>