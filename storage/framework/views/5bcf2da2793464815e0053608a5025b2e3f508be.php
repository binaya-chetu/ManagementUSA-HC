<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="Porto Admin - Responsive HTML5 Template">
        <meta name="author" content="okler.net">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?php echo e(URL::asset('vendor/bootstrap/css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('vendor/font-awesome/css/font-awesome.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(URL::asset('vendor/magnific-popup/magnific-popup.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(URL::asset('vendor/bootstrap-datepicker/css/datepicker3.css')); ?>" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo e(URL::asset('css/theme.css')); ?>" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="<?php echo e(URL::asset('css/skins/default.css')); ?>" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?php echo e(URL::asset('css/theme-custom.css')); ?>">

        <!-- Head Libs -->
        <script src="<?php echo e(URL::asset('vendor/modernizr/modernizr.js')); ?>"></script>


    </head>
    <body>
		<?php echo $__env->yieldContent('content'); ?>

		<!-- JavaScripts -->
		<!-- Vendor -->
               
		<script src="<?php echo e(URL::asset('vendor/jquery/jquery.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('vendor/bootstrap/js/bootstrap.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('vendor/nanoscroller/nanoscroller.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('vendor/magnific-popup/magnific-popup.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('vendor/jquery-placeholder/jquery.placeholder.js')); ?>"></script>
                <script src="<?php echo e(URL::asset('vendor/jquery-validation/jquery.validate.js')); ?>"></script>


		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo e(URL::asset('js/theme.js')); ?>"></script>
		

		<!-- Theme Initialization Files -->
		<script src="<?php echo e(URL::asset('js/theme.init.js')); ?>"></script>
                <script>
                    $('#login').validate({
                        
                    });
                </script>
    </body>
</html>
