@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>View Followup</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('appointment.viewFollowup', $followup) !!}
            
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        <div class="col-lg-12">	
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#followupTab" data-toggle="tab"><i class="fa fa-star"></i> Followup Information</a>
                    </li>
                    <li>
                        <a href="#patientTab" data-toggle="tab">Patient Information</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="followupTab" class="tab-pane active">
                        <p>Appointment Follow-up Information</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Appt. Time :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ date('d F Y H:i:s', strtotime($followup->appointment->apptTime)) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Appt. Comment :</label>
                            </div>
                            <div class="col-md-9">         
                                {{{ $followup->appointment->comment or 'N/A' }}} 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Follow-up Time :</label>
                            </div>
                            <div class="col-sm-9">
                              {{ date('d F Y H:i:s', strtotime($followup->created_at)) }}
                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Follow-up Action :</label>
                            </div>
                            <div class="col-sm-9">
                              {{ $followup->action }} 
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Comment :</label>
                            </div>
                            <div class="col-sm-9">
                              {{{ $followup->comment or 'N/A' }}}  
                            </div>
                        </div>
                    </div>

                    <div id="patientTab" class="tab-pane">
                        <p>Patient Information</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>First Name :</label>
                            </div>
                            <div class="col-sm-9">
                               {{ $followup->appointment->patient->first_name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Last Name :</label>
                            </div>
                            <div class="col-sm-9">
                               {{ $followup->appointment->patient->last_name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Email :</label>
                            </div>
                            <div class="col-sm-9">
                               {{ $followup->appointment->patient->email }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Gender :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $followup->appointment->patient->patientDetail->gender }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Dob :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ date('d F Y', strtotime( $followup->appointment->patient->patientDetail->dob)) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Phone :</label>
                            </div>
                            <div class="col-sm-9">
                                 {{ $followup->appointment->patient->patientDetail->phone }}
                            </div>
                        </div>	
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9">
                           <a href="/appointment/followup" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </div>

</section>
@endsection

