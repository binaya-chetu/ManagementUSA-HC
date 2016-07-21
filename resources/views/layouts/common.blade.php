<!doctype html>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">

        <title>Dashboard | ManagementUSA-HC</title>
        <meta name="keywords" content="" />
        <meta name="description" content="">
        <meta name="author" content="">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('vendor/font-awesome/css/font-awesome.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('vendor/magnific-popup/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

        <!-- specific page css -->
        <link rel="stylesheet" href="{{ URL::asset('js/chosen/chosen.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('/vendor/select2/select2.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('/vendor/fullcalendar/fullcalendar.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('/vendor/fullcalendar/fullcalendar.print.css') }}" media="print" />
        <link rel="stylesheet" href="{{ URL::asset('/vendor/select2/select2.css') }}" />
        

        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ URL::asset('css/theme.css') }}" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="{{ URL::asset('css/skins/default.css') }}" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{{ URL::asset('css/theme-custom.css') }}">
        
          <!-- Theme Custom for print CSS -->
          <link rel="stylesheet" href="{{ URL::asset('css/theme-print.css') }}" media="print" rel = "stylesheet">

        <!-- Head Libs -->

        <script src="{{ URL::asset('vendor/modernizr/modernizr.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery/jquery.js') }}"></script>


    </head>
    <body>
        <section class="body">
            <!-- start: header -->
            @include('layouts.header')
            <!-- end: header -->
            <div class="inner-wrapper">
                @include('layouts.sidebar')

                @yield('content')

            </div>
            @include('layouts.right_sidebar')
        </section>

          <!-- Vendor -->
        <script src="{{ URL::asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
        <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ URL::asset('vendor/nanoscroller/nanoscroller.js') }}"></script>
        <script src="{{ URL::asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ URL::asset('vendor/magnific-popup/magnific-popup.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

        <!-- extra js -->
        <script src="{{ URL::asset('vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js') }}"></script>
        <script src="{{ URL::asset('vendor/ios7-switch/ios7-switch.js') }}"></script>
        <script src="{{ URL::asset('vendor/select2/select2.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>

        <script src="{{ URL::asset('vendor/bootstrap-confirmation/bootstrap-confirmation.js') }}"></script>
        <script src="{{ URL::asset('vendor/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>	
        <script src="{{ URL::asset('vendor/fullcalendar/lib/moment.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/fullcalendar/fullcalendar.js') }}"></script>   
        <script src="{{ URL::asset('vendor/bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>

        <script src="{{ URL::asset('js/chosen/chosen.jquery.min.js') }}"></script>
        <script src="{{ URL::asset('js/chosen/chosen.order.jquery.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery-validation/jquery.validate.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery-validation/additional-methods.js') }}"></script>
       
        
        <script src="{{ URL::asset('js/jquery.usphone.js') }}"></script>
        <!-- Theme Base, Components and Settings -->
        <script src="{{ URL::asset('js/theme.js') }}"></script>

        <!-- Theme Custom -->
        <script src="{{ URL::asset('js/theme.custom.js') }}"></script>
        <script src="{{ URL::asset('js/custom.js') }}"></script>
        

        <!-- Theme Initialization Files -->
        <script src="{{ URL::asset('js/theme.init.js') }}"></script>
        
         <script src="{{ URL::asset('vendor/bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>
        <script src="{{ URL::asset('js/forms/examples.wizard.js') }}"></script>
        <script src="{{ URL::asset('js/forms/examples.validation.js') }}"></script>
        <script src="{{ URL::asset('js/forms/examples.advanced.form.js') }}"></script>
        

    </body>
</html>
