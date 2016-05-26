@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>View Doctor :  {{ $user->first_name }} {{ $user->last_name }}</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>View Users</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        <div class="col-lg-12">	
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#personal" data-toggle="tab"><i class="fa fa-star"></i> Personal Information</a>
                    </li>
                    <li>
                        <a href="#contact" data-toggle="tab">Contact Information</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="personal" class="tab-pane active">
                        <p>Personal Information</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>First Name :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $user->first_name }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Last Name :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $user->last_name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Email :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $user->email }}
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Role :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $user['roleName']->role_title }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Gender :</label>
                            </div>
                            <div class="col-md-9">         
                                {{ $user['userDetail']->gender }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Dob :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($user['userDetail']->dob)
                                {{ date('d F Y', strtotime($user['userDetail']->dob)) }}
                                @else 
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div id="contact" class="tab-pane">
                        <p>Contact Information</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Phone :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($user['userDetail']->phone)
                                {{ $user['userDetail']->phone }}
                                @else 
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Address Line 1 :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($user['userDetail']->address1)
                                {{ $user['userDetail']->address1 }}
                                @else 
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Address Line 2 :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($user['userDetail']->address2)
                                {{ $user['userDetail']->address2 }}
                                @else 
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>City :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($user['userDetail']->city)
                                {{ $user['userDetail']->city }}
                                @else 
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>State :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $user['userDetail']['userStateName']->name or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Zip Code :</label>
                            </div>
                            <div class="col-sm-9">
                                 @if($user['userDetail']->zipCode)
                                {{ $user['userDetail']->zipCode }}
                                @else 
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>	
                    </div>

                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9">
                            <a href="/user/listUsers" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </div>

</section>
@endsection

