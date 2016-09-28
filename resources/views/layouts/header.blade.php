<header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <img src="{{ URL::asset('images/logo.png')}}"  height="35" alt="Porto Admin" /> 
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
	<!-- start: search & user box -->
        <div class="header-right">
        
        <div class="search nav-form">
            <div class="input-group input-search">
                <select  class="form-control" name="search_location" id="search_location">
                 <?php   $locations = getLocations(); ?>
                    <option value = "">Select Location</option>
                     @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                     @endforeach
                </select>
            </div>
        </div>

        <span class="separator"></span>

        <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture">
                        <img src="{{ URL::asset('images/!logged-user.jpg')}}" alt="Joseph Junior" class="img-circle" data-lock-picture="{{ URL::asset('images/!logged-user.jpg')}}" />
                    </figure>
                    <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                            <span class="name">{{ Auth::user()? Auth::user()->first_name :'' }} {{ Auth::user()? Auth::user()->last_name : '' }}</span>
                    </div>

                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled">
                        <li class="divider"></li>
                                
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{ url('/home/userProfile') }}"><i class="fa fa-user"></i> My Profile</a>
                        </li>
                        <!--  <li>
                            <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                        </li>-->
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> Logout</a>
                        </li>
                        
                    </ul>
                </div>
        </div>
    </div>
        <!-- end: search & user box -->
</header>