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
                                Request::segment(1) === 'appointment' ||
                                Request::segment(1) === 'listappointment' ||
                                Request::segment(1) === 'viewappointment' ? 'nav-active nav-expanded' : null }}">
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
                            <li class="nav-parent {{ Request::segment(1) === 'appointment' ||
                                        Request::segment(1) === 'listappointment' ||
                                        Request::segment(1) === 'viewappointment' ? 'nav-expanded' : null }}">
                                <a>
                                    Appointments
                                </a>
                                <ul class="nav nav-children">

                                    <li class="{{ Request::segment(1) === 'appointment' ? 'nav-active' : null }}">
                                        <a href="{{ url('/appointment/1') }}">
                                            New Appointment
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(1) === 'listappointment' ? 'nav-active' : null }}">
                                        <a href="{{ url('/listappointment') }}">
                                            List Appointments
                                        </a>
                                    </li>
                                    <li class="{{ Request::segment(1) === 'viewappointment' ? 'nav-active' : null }}">
                                        <a href="{{ url('/viewappointment') }}">
                                            View Appointments
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-parent">
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
                            </li>
                            <li class="nav-parent">
                                <a>
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
                    <li class="nav-parent {{ Request::segment(1) === 'listRole' || 
                                Request::segment(1) === 'addRole' || 
                                Request::segment(1) === 'editRole' ||
                                Request::segment(1) === 'listPermission' ? 'nav-active nav-expanded' : null }}">
                        <a>
                            <i class="fa fa-copy" aria-hidden="true"></i>
                            <span>ACL Management</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ Request::segment(1) === 'listRole' ? 'nav-active' : null }}">
                                <a href="{{ url('/listRole') }}">
                                    Roles
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