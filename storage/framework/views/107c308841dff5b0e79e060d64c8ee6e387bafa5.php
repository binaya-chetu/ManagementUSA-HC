<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>List Appointments</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>List Appointments</span></li>
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

            <h2 class="panel-title">List Appointments</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <?php if(Session::has('flash_message')): ?>
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> <?php echo session('flash_message'); ?></em></div></div>
                <?php endif; ?>
                <div class="col-md-12 text-left">
                    <a href="javascript:void(0)"><button id="add-view-appointment" class="btn btn-primary" >Add Appointment <i class="fa fa-plus"></i></button></a>
                    <a href="<?php echo e(url('/patient/addpatient')); ?>"><button id="addToTable" class="btn btn-primary" >Add Patient    <i class="fa fa-plus"></i></button></a>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="<?php echo e(URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf')); ?>">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>App Date and Time</th>
                        <th>Patient</th>
                        <th>Comment</th>
<!--                        <th>Status</th>-->
                        <th>Source</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach($appointments as $appointment): ?>
                    <tr>
                        <td class="table-text table-text-id"><div><?php echo e($i++); ?></div></td>
                        <td class="table-text"><div><?php echo e($appointment->apptTime); ?></div></td>

                        <td class="table-text"><div><a class="defaultColor" href="/appointment/patientMedical/<?php echo e(base64_encode($appointment['patient']->id)); ?>"><?php echo e($appointment['patient']->first_name); ?> <?php echo e($appointment['patient']->last_name); ?></a></div></td>
                        <td class="table-text"><div><?php echo e($appointment->comment); ?></div></td>
                        <td class="table-text"><div>
                                <?php
//                                switch ($appointment->status) {
//                                    case 1: echo "Active";
//                                        break;
//                                    case 2: echo "Reschedule";
//                                        break;
//                                    case 3: echo "Cancel";
//                                        break;
//                                    case 4: echo "Confirm";
//                                        break;
//                                    default: echo "Active";
//                                        break;
//                                }
                                switch ($appointment->appt_source) {
                                    case 1: echo "Web Lead";
                                        break;
                                    case 2: echo "Tele Marketing";
                                        break;
                                    case 3: echo "Walk-ins";
                                        break;
                                    default: echo "Unknown";
                                        break;
                                }
                                ?>
                            </div></td>
                        <td class="actions">
                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                            <a href="javascript:void(0)" class="on-default edit-row" rel="<?php echo e($appointment->id); ?>"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" data-href="/appointment/delete/<?php echo e(base64_encode($appointment->id)); ?>" class="on-default remove-row confirmation-callback"><i class="fa fa-trash-o"></i></a> 
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</section>
<!-- Modal Form -->
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">  
            <?php echo $__env->make('appointment.edit_appointment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>   
</div>

<div id="modal-add-view-appointment" class="modal-block modal-block-primary mfp-hide">  
    <?php echo $__env->make('appointment.popup_appointment_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>              
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>