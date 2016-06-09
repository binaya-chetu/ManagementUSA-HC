<?php $__env->startSection('content'); ?>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo pull-left">
            <img src="<?php echo e(URL::asset('images/logo.jpg')); ?>" height="54" alt="Porto Admin" />
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Reset Password</h2>
            </div>
            <div class="panel-body">
                <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
                <?php endif; ?>

                <?php echo e(Form::open(array('url' => '/password/email', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'login'))); ?>

                <?php echo csrf_field(); ?>


                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?> mb-lg">
                    <?php echo e(Form::label('email', 'Email', array('class' => 'control-label mandatory'))); ?>

                    <div class="input-group input-group-icon">
                        <?php echo e(Form::email('email', null, ['class' => 'form-control input required', 'id' => 'email'])); ?>

                        <span class="input-group-addon">
                            <span class="icon icon-lg">
                                <i class="fa fa-user"></i>
                            </span>
                        </span>
                    </div>
                    <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-sm-8 text-right">

                        <?php echo e(Form::button(
                                    'Send Password Reset Link',
                                    array(
                                        'class'=>'btn btn-primary',
                                        'type'=>'submit'))); ?>

                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2016. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>