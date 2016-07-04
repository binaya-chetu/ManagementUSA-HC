<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <?php 
            $permissions = [];
                if(Auth::user())
                {
                    $permissions =  \App\Permission::getPermissionForLoggedUser(Auth::user()->role);
                }
            ?>
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class="{{ Request::segment(1) === '' ? 'nav-active nav-expanded' : null }}">
                        <a href="{{ url('/') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-parent {{ Request::segment(1) === 'apptsetting'  ? 'nav-active nav-expanded' : null }}">
                        <a>
                            <i class="fa fa-copy" aria-hidden="true"></i>
                            <span>Appt. Settings</span>
                        </a>
                        <ul class="nav nav-children">                       
                              
                            <li class="{{ Request::segment(2) === 'missedCall' ? 'nav-active' : null }}">
                                <a href="{{ url('/apptsetting/missedCall') }}">
                                    Missed Call
                                </a>
                            </li>  
                            <li class="{{ Request::segment(3) === 'marketingCall' ? 'nav-active' : null }}">
                                <a href="{{ url('/apptsetting/index/marketingCall') }}">
                                    Tele-marketing Calls
                                </a>
                            </li> 
                            <li class="{{ Request::segment(2) === 'webLead' ? 'nav-active' : null }}">
                                <a href="{{ url('/apptsetting/webLead') }}">
                                    Web Leads
                                </a>
                            </li> 
                            <li class="{{ Request::segment(3) === 'walkin' ? 'nav-active' : null }}">
                                <a href="{{ url('/apptsetting/index/walkin') }}">
                                    Direct Walkins
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php if(in_array('patient_module', $permissions) || in_array('doctor_module', $permissions) || in_array('appointment_module', $permissions) || in_array('follow_up_appointment_module', $permissions)) { ?>
                    <li class="nav-parent {{ Request::segment(1) === 'patient' || 
                                Request::segment(1) === 'doctor' || 
                                Request::segment(1) === 'appointment' ? 'nav-active nav-expanded' : null }}">
                        <a>
                            <i class="fa fa-copy" aria-hidden="true"></i>
                            <span>POS System</span>
                        </a>
                        <ul class="nav nav-children">
                            @if(in_array('patient_module', $permissions))
                            <li class="nav-parent {{ Request::segment(1) === 'patient' ? 'nav-expanded' : null }}">
                                <a>
                                    Patients
                                </a>
                                <ul class="nav nav-children">
                                    <li class="{{ Request::segment(2) === 'addpatient' ? 'nav-active' : null }}">
                                        <a href="/patient/addpatient">
                                            Add New Patient
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(1) === 'patient' && empty(Request::segment(2)) ? 'nav-active' : null }}">
                                        <a href="/patient">
                                            Patients List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            @if(in_array('doctor_module', $permissions)) 
				<li class="nav-parent {{ Request::segment(1) === 'doctor' ? 'nav-expanded' : null }}">
                                <a>
                                    Doctors
                                </a>
                                <ul class="nav nav-children">
                                   
                                   <li class="{{ Request::segment(2) === 'addDoctor' ? 'nav-active' : null }}">
                                        <a href="{{ url('/doctor/addDoctor') }}">
                                            Add New Doctor
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(1) === 'doctor' && empty(Request::segment(2)) ? 'nav-active' : null }}">
                                        <a href="/doctor">
                                            Doctors List
                                        </a>
                                    </li>

                                </ul>
                           </li>
                            @endif

                            @if(in_array('appointment_module', $permissions))
                            <li class="nav-parent {{ Request::segment(2) === 'newAppointment' ||
                                        Request::segment(2) === 'listappointment' ||
                                        Request::segment(2) === 'viewappointment' || Request::segment(2) === 'patientMedical' ? 'nav-expanded' : null }}">
                                <a>
                                    Appointments
                                </a>
                                <ul class="nav nav-children">

                                    <li class="{{ Request::segment(2) === 'newAppointment' ? 'nav-active' : null }}">
                                        <a href="{{ url('/appointment/newAppointment') }}">
                                            New Appointment
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(2) === 'listappointment' ? 'nav-active' : null }}">
                                        <a href="{{ url('appointment/listappointment') }}">
                                            Appointments List
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(2) === 'viewappointment' ? 'nav-active' : null }}">
                                        <a href="{{ url('appointment/viewappointment') }}">
                                            View Appointments
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            @if(in_array('follow_up_appointment_module', $permissions))
                            <li class="{{ Request::segment(2) === 'followup' || Request::segment(2) === 'viewFollowup' ? 'nav-active' : null }}">
                                <a href="{{ url('/appointment/followup') }}">
                                    Appointments Followup List
                                </a>
                            </li>
                            @endif
                            <li class="{{ Request::segment(2) === 'upcomingappointments' ? 'nav-active' : null }}">
                                <a href="{{ url('/appointment/upcomingappointments') }}">
                                    Upcoming Appointments
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    @if(in_array('role_module', $permissions))
                    <li class="nav-parent {{ Request::segment(1) === 'acl' ? 'nav-active nav-expanded' : null }}">
                        <a>
                            <i class="fa fa-copy" aria-hidden="true"></i>
                            <span>ACL Management</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ Request::segment(2) === 'listRole' || 
                                Request::segment(2) === 'addRole' || 
                                Request::segment(2) === 'editRole' ||
                                Request::segment(2) === 'listPermission' ? 'nav-active' : null }}">
                                <a href="{{ url('/acl/listRole') }}">
                                    Roles
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                     @if(in_array('user_module', $permissions))
                    <li class="nav-parent {{ Request::segment(1) === 'user' ? 'nav-active nav-expanded' : null }}">
                        <a>
                            <i class="fa fa-copy" aria-hidden="true"></i>
                            <span>User Management</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ Request::segment(2) === 'addUser'  ? 'nav-active' : null }}">
                                <a href="{{ url('/user/addUser') }}">
                                    Add New User
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'listUsers' || Request::segment(2) === 'editUser' || Request::segment(2) === 'viewUser' ? 'nav-active' : null }}">
                                <a href="{{ url('/user/listUsers') }}">
                                    Users List
                                </a>
                            </li>
                        </ul>
                    </li>       
                    @endif

                     <li class="nav-parent {{ Request::segment(1) === 'categories' ? 'nav-active nav-expanded' : null }}">
                        <a>

                            <i class="fa fa-copy" aria-hidden="true"></i>
                            <span>Product Categories</span>
                        </a>
                         <ul class="nav nav-children">
                            <li class="{{ Request::segment(2) === 'newCategory'  ? 'nav-active' : null }}">
                                <a href="{{ url('/categories/newCategory') }}">
                                    Add New Category
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'listCategories'  ? 'nav-active' : null }}">
                                <a href="{{ url('/categories/listCategories') }}">
                                    List All Categories
                                </a>
                            </li>
                        </ul>
                    </li> 
                    <li class="{{ Request::segment(2) === 'addcategories' ? 'nav-active nav-expanded' : null }}">
                        <a href="{{ url('categories/addcategories') }}">
                            <i class="fa fa-copy" aria-hidden="true"></i>
                            <span>Imports Product</span>
                        </a>
                    </li> 
                </ul>
            </nav>
        </div>
    </div>
</aside>
<!-- end: sidebar -->