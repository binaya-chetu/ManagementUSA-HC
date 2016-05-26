<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class="{{ Request::segment(1) === '' ? 'nav-active nav-expanded' : null }}">
                        <a href="{{ url('/') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-parent {{ Request::segment(1) === 'patient' || 
                                Request::segment(1) === 'doctor' || 
                                Request::segment(1) === 'appointment' ? 'nav-active nav-expanded' : null }}">
                        <a>
                            <i class="fa fa-copy" aria-hidden="true"></i>
                            <span>POS System</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="nav-parent {{ Request::segment(1) === 'patient' ? 'nav-expanded' : null }}">
                                <a>
                                    Patients
                                </a>
                                <ul class="nav nav-children">
                                    <li class="{{ Request::segment(2) === 'addpatient' ? 'nav-active' : null }}">
                                        <a href="/patient/addpatient">
                                            New Patient
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(1) === 'patient' && empty(Request::segment(2)) ? 'nav-active' : null }}">
                                        <a href="/patient">
                                            List Patients
                                        </a>
                                    </li>
                                </ul>
                            </li>
				<li class="nav-parent {{ Request::segment(1) === 'doctor' ? 'nav-expanded' : null }}">
                                <a>
                                    Doctor
                                </a>
                                <ul class="nav nav-children">
                                   
                                   <li class="{{ Request::segment(2) === 'addDoctor' ? 'nav-active' : null }}">
                                        <a href="{{ url('/doctor/addDoctor') }}">
                                            New Doctor
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(1) === 'doctor' && empty(Request::segment(2)) ? 'nav-active' : null }}">
                                        <a href="/doctor">
                                            List Doctor
                                        </a>
                                    </li>

                                </ul>
                           </li>
                            <li class="nav-parent {{ Request::segment(2) === 'newAppointment' ||
                                        Request::segment(2) === 'listappointment' ||
                                        Request::segment(2) === 'viewappointment' ? 'nav-expanded' : null }}">
                                <a>
                                    Appointments
                                </a>
                                <ul class="nav nav-children">

                                    <li class="{{ Request::segment(2) === 'appointment' ? 'nav-active' : null }}">
                                        <a href="{{ url('/appointment/newAppointment') }}">
                                            New Appointment
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(2) === 'listappointment' ? 'nav-active' : null }}">
                                        <a href="{{ url('appointment/listappointment') }}">
                                            List Appointments
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(2) === 'viewappointment' ? 'nav-active' : null }}">
                                        <a href="{{ url('appointment/viewappointment') }}">
                                            View Appointments
                                        </a>
                                    </li>

                                </ul>
                            </li>
<!--                            <li class="nav-parent">
                                <a>
                                    Sales
                                </a>
                                <ul class="nav nav-children">
                                    <li>
                                        <a href="#">
                                            New Sale
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            List Sales
                                        </a>
                                    </li>
                                </ul>
                            </li>-->
                            <li class="{{ Request::segment(2) === 'followup' || Request::segment(2) === 'viewFollowup' ? 'nav-active' : null }}">
                                <a href="{{ url('/appointment/followup') }}">
                                    Follow-up Appointment
                                </a>
                            </li>
                            <!--<li class="nav-parent">
                                <a>
                                    Follow-up Sale
                                </a>

                            </li>-->
                        </ul>
                    </li>
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
                    <li class="nav-parent {{ Request::segment(1) === 'user' ? 'nav-active nav-expanded' : null }}">
                        <a>
                            <i class="fa fa-copy" aria-hidden="true"></i>
                            <span>User Management</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ Request::segment(2) === 'addUser'  ? 'nav-active' : null }}">
                                <a href="{{ url('/user/addUser') }}">
                                    Add User
                                </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'listUsers' || Request::segment(2) === 'editUser' || Request::segment(2) === 'viewUser' ? 'nav-active' : null }}">
                                <a href="{{ url('/user/listUsers') }}">
                                    All User
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
<!-- end: sidebar -->