@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>View Doctor :  {{ $doctor->firstName }} {{ $doctor->lastName }}</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>View Doctor</span></li>
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
                                {{ $doctor->firstName }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Last Name :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $doctor->lastName }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Email :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $doctor->email }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Gender :</label>
                            </div>
                            <div class="col-md-9">         
                                {{ $doctor->gender }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Dob :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ date('d F Y', strtotime($doctor->dob)) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Employer :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $doctor->employer or 'N/A' }}}
                            </div>
                        </div>					
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Occupation :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $doctor->occupation or 'N/A' }}}
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
                                {{{ $doctor->phone or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Primary Address :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $doctor->address1 or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Secondary Address :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $doctor->address2 or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>City :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $doctor->city or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>State :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $doctor->state or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Zip Code :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $doctor->zipCode or 'N/A' }}}
                            </div>
                        </div>	
                    </div>

                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9">
                            <a href="/doctor" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </div>

</section>
@endsection

