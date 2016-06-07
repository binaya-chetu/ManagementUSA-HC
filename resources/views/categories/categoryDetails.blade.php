<!-- @extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">     
        <h2> {{ $category[0]->cat_name }} </h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>List Categories</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">
       
           
        </div>
            </div>
        </section>    
@endsection -->


<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>Responsive Tables | Porto Admin - Responsive HTML5 Template 1.4.1</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="">
        <meta name="author" content="okler.net">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <!--link rel="stylesheet" href="/assets/vendor/magnific-popup/magnific-popup.css" /-->
        <!--link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/css/datepicker3.css" /-->

        <!-- Theme CSS -->
        <!--link rel="stylesheet" href="/assets/stylesheets/theme.css" /-->

        <!-- Skin CSS -->
        <!--link rel="stylesheet" href="/assets/stylesheets/skins/default.css" /-->

        <!-- Theme Custom CSS -->
        <!--link rel="stylesheet" href="/assets/stylesheets/theme-custom.css"-->

        <!-- Head Libs -->
        <!--script src="/assets/vendor/modernizr/modernizr.js"></script-->
        <style>
            .bronze{ background:#cd7f32; }
            .silver{ background:#C0C0C0;}
            .gold{ background:#DAA520; }
            .packages-table .table{ color:#333;}
            .packages-table .table-bordered > thead > tr > th, .packages-table .table-bordered > tbody > tr > td{text-align:center; vertical-align:middle !important;}

            .packages-table th:first-child{ text-align:center;}
            .packages-table .table-bordered > tbody > tr > td:first-child{ text-align:left; }
            .pricing-table h3.bronze {
               background-color: #cd7f32;
            }
            .pricing-table h3.silver {
               background-color: #C0C0C0;
            }
            .pricing-table h3.gold {
               background-color: #DAA520;
            }
        </style>
    </head>
    <body>
        <section class="body">

            <!-- start: header -->
            <header class="header">
                <div class="logo-container">
                    <a href="../" class="logo">
                        <img src="/assets/images/logo.png" height="35" alt="Porto Admin" />
                    </a>
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>

                <!-- start: search & user box -->
                <div class="header-right">

                    <form action="pages-search-results.html" class="search nav-form">
                        <div class="input-group input-search">
                            <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

                    <span class="separator"></span>

                    <ul class="notifications">
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="badge">3</span>
                            </a>

                            <div class="dropdown-menu notification-menu large">
                                <div class="notification-title">
                                    <span class="pull-right label label-default">3</span>
                                    Tasks
                                </div>

                                <div class="content">
                                    <ul>
                                        <li>
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Generating Sales Report</span>
                                                <span class="message pull-right text-dark">60%</span>
                                            </p>
                                            <div class="progress progress-xs light">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                            </div>
                                        </li>

                                        <li>
                                            <a href="categoryDetails.blade.php"></a>
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Importing Contacts</span>
                                                <span class="message pull-right text-dark">98%</span>
                                            </p>
                                            <div class="progress progress-xs light">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                                            </div>
                                        </li>

                                        <li>
                                            <p class="clearfix mb-xs">
                                                <span class="message pull-left">Uploading something big</span>
                                                <span class="message pull-right text-dark">33%</span>
                                            </p>
                                            <div class="progress progress-xs light mb-xs">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="badge">4</span>
                            </a>

                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">
                                    <span class="pull-right label label-default">230</span>
                                    Messages
                                </div>

                                <div class="content">
                                    <ul>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joseph Doe</span>
                                                <span class="message">Lorem ipsum dolor sit.</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="/assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joseph Junior</span>
                                                <span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="/assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joe Junior</span>
                                                <span class="message">Lorem ipsum dolor sit.</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <figure class="image">
                                                    <img src="/assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
                                                </figure>
                                                <span class="title">Joseph Junior</span>
                                                <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <hr />

                                    <div >
                                        <a href="#" class="view-more">View All</a>
                                    </div>
                                </div>
                                <a href="categoryDetails.blade.php"></a>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="badge">3</span>
                            </a>

                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">
                                    <span class="pull-right label label-default">3</span>
                                    Alerts
                                </div>

                                <div class="content">
                                    <ul>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <div class="image">
                                                    <i class="fa fa-thumbs-down bg-danger"></i>
                                                </div>
                                                <span class="title">Server is Down!</span>
                                                <span class="message">Just now</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <div class="image">
                                                    <i class="fa fa-lock bg-warning"></i>
                                                </div>
                                                <span class="title">User Locked</span>
                                                <span class="message">15 minutes ago</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="clearfix">
                                                <div class="image">
                                                    <i class="fa fa-signal bg-success"></i>
                                                </div>
                                                <span class="title">Connection Restaured</span>
                                                <span class="message">10/10/2014</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <hr />

                                    <div >
                                        <a href="#" class="view-more">View All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <span class="separator"></span>

                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="/assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="/assets/images/!logged-user.jpg" />
                            </figure>
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                                <span class="name">John Doe Junior</span>
                                <span class="role">administrator</span>
                            </div>

                            <i class="fa custom-caret"></i>
                        </a>

                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="pages-signin.html"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: search & user box -->
            </header>
            <!-- end: header -->

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                
                <!-- end: sidebar -->

                <section role="main" class="content-body">
                    <header class="page-header">
                        <h2>Responsive Tables</h2>

                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="index.html">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li><span>Tables</span></li>
                                <li><span>Responsive</span></li>
                            </ol>

                            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                        </div>
                    </header>

                    <!-- start: page -->
                    <div class="alert alert-info">
                        Resize the browser to see the responsiveness in action.
                    </div>

                    <section class="panel">
                        <header class="panel-heading">
                            <div class="panel-actions">
                                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                            </div>

                            <h2 class="panel-title"></h2>
                        </header>
                        <div class="panel-body">
                            <div class="table-responsive packages-table">
                                <table class="table table-bordered pricing-table table-condensed mb-none">
                                    <thead>
                                        <tr>

                                            <th colspan="3">
                                                <h3>Low Carb High Protein Diet </h3>
                                            </th>
                                          
                                            <th class="bronze plan" colspan="2">
                                            <h3 class="bronze">Bronze<span>$3395</span></h3>
									<a class="btn btn-lg btn-primary" href="#">Buy Now</a>
                                                
                                            </th>
                                            
                                            <th class="silver plan" colspan="2">
                                                <h3 class="silver">Silver<span>$5,995</span></h3>
									<a class="btn btn-lg btn-primary" href="#">Buy Now</a>
                                                
                                            </th>
                                            
                                            <th class="gold plan" colspan="2">
                                             <h3 class="gold">Gold<span>$6,995</span></h3>
									<a class="btn btn-lg btn-primary" href="#">Buy Now</a>
                                                
                                                
                                            </th>
                                            
                                        </tr>
                                         <tr>

                                            <th>Nomenclature</th>
                                            <th >Unit of Measure</th>
                                            <th >Unit Price</th>
                                            <th class="bronze">Quantity Bronze</th>
                                            <th class="bronze">Package</th>
                                            <th class="silver">Quantity Silver</th>
                                            <th  class="silver">Package</th>
                                            <th class="gold">Quantity Gold</th>
                                            <th class="gold">Package</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                           <tr>
                                            <td> Body Mass Index (BMI) Futurex Reading Weekly</td>
                                            <td >EA</td>
                                            <td >$50</td>
                                            <td class="bronze">1</td>
                                            <td class="bronze">50.00</td>
                                            <td class="silver">50.00</td>
                                            <td class="silver">1</td>
                                            <td class="gold">1</td>
                                            <td class="gold">50.00</td>
                                        </tr>
                                          <tr>
                                            <td> Prescription MicroTab Vitamin Therapy One Month Supply</td>
                                            <td >EA</td>
                                            <td >$50</td>
                                            <td class="bronze">1</td>
                                            <td class="bronze">50.00</td>
                                            <td class="silver">50.00</td>
                                            <td class="silver">1</td>
                                            <td class="gold">1</td>
                                            <td class="gold">50.00</td>
                                        </tr>
                                        <tr>
                                            <td> High Protein Meal Replacements Shake, Pudding, Or Protein Bar</td>
                                            <td >EA</td>
                                            <td >$50</td>
                                            <td class="bronze">1</td>
                                            <td class="bronze">50.00</td>
                                            <td class="silver">50.00</td>
                                            <td class="silver">1</td>
                                            <td class="gold">1</td>
                                            <td class="gold">50.00</td>
                                        </tr>
                                        <tr>
                                            <td>  Lipotropic Intermuscular Injection Designed For Weight Loss</td>
                                            <td >EA</td>
                                            <td >$50</td>
                                            <td class="bronze">1</td>
                                            <td class="bronze">50.00</td>
                                            <td class="silver">50.00</td>
                                            <td class="silver">1</td>
                                            <td class="gold">1</td>
                                            <td class="gold">50.00</td>
                                        </tr>
                                        <tr>
                                            <td> Incredi-Powder Prescription Kegenex 60 Minute Ketosis Formula 1 Month Supply</td>
                                            <td >EA</td>
                                            <td >$50</td>
                                            <td class="bronze">1</td>
                                            <td class="bronze">50.00</td>
                                            <td class="silver">50.00</td>
                                            <td class="silver">1</td>
                                            <td class="gold">1</td>
                                            <td class="gold">50.00</td>
                                        </tr>
                                        <tr>
                                            <td>Total One Time Therapy Start Up Costs For Weight Loss Program</td>
                                            <td >EA</td>
                                            <td >$50</td>
                                            <td class="bronze">1</td>
                                            <td class="bronze">50.00</td>
                                            <td class="silver">50.00</td>
                                            <td class="silver">1</td>
                                            <td class="gold">1</td>
                                            <td class="gold">50.00</td>
                                        </tr>
                                        <tr>
                                            <td> Daily Diet Plan Emailed & Weekly Weigh In Includes Progress Consult and Coaching</td>
                                            <td >EA</td>
                                            <td >$50</td>
                                            <td class="bronze">1</td>
                                            <td class="bronze">50.00</td>
                                            <td class="silver">50.00</td>
                                            <td class="silver">1</td>
                                            <td class="gold">1</td>
                                            <td class="gold">50.00</td>
                                        </tr>
                                        <tr>
                                            <td>  12 Month Clinic Membership Package Includes 5% off Clinic Products/Services (NP Only)</td>
                                            <td >EA</td>
                                            <td >$50</td>
                                            <td class="bronze">1</td>
                                            <td class="bronze">50.00</td>
                                            <td class="silver">50.00</td>
                                            <td class="silver">1</td>
                                            <td class="gold">1</td>
                                            <td class="gold">50.00</td>
                                        </tr>
                                             
                                      
                                         <tr>
                                              <td colspan="3"><strong>Individual Purchage price</strong></td>
                                               <td class="bronze" colspan="2"><strong>$4144</strong></td>
                                               <td   class="silver"  colspan="2"><strong> $7944</strong></td>
                                                <td  class="gold"  class="bronze" colspan="2"><strong>$11794</strong></td>
                                        </tr>
                                        <tr>
                                              <td colspan="3"><strong>Save</strong></td>
                                               <td class="bronze" colspan="2"><strong>$749</strong></td>
                                               <td   class="silver"  colspan="2"><strong>$1949</strong></td>
                                                <td  class="gold"  class="bronze" colspan="2"><strong>$4799</strong></td>
                                        </tr>
                                        <tr>
                                              <td colspan="3"><strong>Package Total</strong></td>
                                               <td class="bronze" colspan="2"><strong> $3395</strong></td>
                                               <td   class="silver"  colspan="2"><strong> $5,995</strong></td>
                                                <td  class="gold"  class="bronze" colspan="2"><strong>$6,995</strong></td>
                                        </tr>
                                        
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <!-- end: page -->
                </section>
            </div>

            <aside id="sidebar-right" class="sidebar-right">
                <div class="nano">
                    <div class="nano-content">
                        <a href="#" class="mobile-close visible-xs">
                            Collapse <i class="fa fa-chevron-right"></i>
                        </a>

                        <div class="sidebar-right-wrapper">

                            <div class="sidebar-widget widget-calendar">
                                <h6>Upcoming Tasks</h6>
                                <div data-plugin-datepicker data-plugin-skin="dark" ></div>

                                <ul>
                                    <li>
                                        <time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
                                        <span>Company Meeting</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="sidebar-widget widget-friends">
                                <h6>Friends</h6>
                                <ul>
                                    <li class="status-online">
                                        <figure class="profile-picture">
                                            <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-online">
                                        <figure class="profile-picture">
                                            <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-offline">
                                        <figure class="profile-picture">
                                            <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-offline">
                                        <figure class="profile-picture">
                                            <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </aside>
        </section>

       

    </body>
</html>