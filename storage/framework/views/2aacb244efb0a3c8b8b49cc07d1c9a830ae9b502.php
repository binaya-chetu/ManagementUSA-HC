<?php $__env->startSection('content'); ?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Patients List</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo e(url('/')); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Patients List</h2>
        </header>
        <div class="panel-body">
            <?php if(Session::has('flash_message')): ?>
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> <?php echo session('flash_message'); ?></em></div>
            <?php endif; ?>	
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a id="addToTable" class="btn btn-primary" href='/patient/addpatient'>Add patient <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>State</th>                     
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php $i = 0; ?>
                    <?php foreach($patients as $patient): ?>
                    <tr class="gradeX">
                        <td><?php echo e(++$i); ?></td>
                        <td><a class="defaultColor" href="/patient/view/<?php echo e(base64_encode($patient->id)); ?>"><?php echo e($patient->first_name); ?> <?php echo e($patient->last_name); ?></a></td>
                        <td><a class="defaultColor" href="/patient/view/<?php echo e(base64_encode($patient->id)); ?>"><?php echo e($patient->email); ?></a></td>
                        <td><?php echo e($patient['patientDetail']->phone); ?></td>
                        <td><?php if($patient['patientDetail']->city): ?><?php echo e($patient['patientDetail']->city); ?> <?php else: ?> <?php echo e('N/A'); ?> <?php endif; ?></td>                      
                        <td><?php echo e(isset($patient['patientDetail']['patientStateName']->name) ? $patient['patientDetail']['patientStateName']->name : 'N/A'); ?></td>  
                        <td class="actions">
                            <a href="/patient/edit/<?php echo e(base64_encode($patient->id)); ?>"  title="Edit"><i class="fa fa-pencil"></i></a> | 
                           <a data-href="/patient/delete/<?php echo e(base64_encode($patient->id)); ?>" href="javascrpt:void(0)" class="on-default remove-row confirmation-callback" ><i class="fa fa-trash-o"></i></a> 
                           <?php if(!($patient['patientDetail']->never_treat_status)): ?> 
                           |
                           <a href="/appointment/newAppointment/<?php echo e(base64_encode($patient->id)); ?>" class="on-default" title="Add Appointment"><i class="fa fa-calendar"></i></a>
                           <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div>
    </section>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>