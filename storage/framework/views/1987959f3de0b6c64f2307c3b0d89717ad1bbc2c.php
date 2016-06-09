<?php $__env->startSection('content'); ?>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo pull-left">
            <img src="<?php echo e(URL::asset('images/logo.jpg')); ?>" height="54" alt="Porto Admin" />
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
            </div>
            <div class="panel-body">
                 <?php if(Session::has('flash_message')): ?>
                    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> <?php echo session('flash_message'); ?></em></div>
                <?php endif; ?>	
                <?php echo e(Form::open(array('url' => '/login', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'login'))); ?>

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

                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> mb-lg">
                    <div class="clearfix">
                        <?php echo e(Form::label('password', 'Password', array('class' => 'control-label pull-left mandatory'))); ?>

                        <a href="<?php echo e(url('/password/reset')); ?>" class="pull-right">Lost Password?</a>
                    </div>
                    <div class="input-group input-group-icon">
                        <?php echo e(Form::password('password', ['class' => 'form-control input required', 'id' => 'password'])); ?>

                        <span class="input-group-addon">
                            <span class="icon icon-lg">
                                <i class="fa fa-lock"></i>
                            </span>
                        </span>
                    </div>
                    <?php if($errors->has('password')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="checkbox-custom checkbox-default">
                            <?php echo e(Form::checkbox('remember', 1, null, ['class' => 'form-control input', 'id' => 'RememberMe'])); ?>

                            <?php echo e(Form::label('RememberMe', 'RememberMe')); ?>

                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <?php echo e(Form::button(
                                    'Sign In',
                                    array(
                                        'class'=>'btn btn-primary hidden-xs',
                                        'type'=>'submit'))); ?>

                    </div>
                </div>
                <p class="text-center">Don't have an account yet? <a href="<?php echo e(url('/register')); ?>">Sign Up!</a>
                    <?php echo e(Form::close()); ?>

            </div>
        </div>
        <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2016. All Rights Reserved.</p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>