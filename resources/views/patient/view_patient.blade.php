@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>View patient :  {{ $patient->first_name }} {{ $patient->last_name }}</h2>
        <div class="right-wrapper pull-right">
           {!! Breadcrumbs::render('patient.view', $patient) !!}
            
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
                    <li>
                        <a href="#attachment" data-toggle="tab">Attachments</a>
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
                                {{ $patient->first_name }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Last Name :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $patient->last_name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Email :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $patient->email }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Role :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $patient['roleName']->role_title }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Gender :</label>
                            </div>
                            <div class="col-md-9">         
                                {{ $patient['patientDetail']->gender }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Dob :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($patient['patientDetail']->dob)
                                {{ date('d F Y', strtotime($patient['patientDetail']->dob)) }}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Employer :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($patient['patientDetail']->employer)
                                {{ $patient['patientDetail']->employer }}
                                 @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>					
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Occupation :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($patient['patientDetail']->occupation)
                                {{ $patient['patientDetail']->occupation }}
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
                                {{{ $patient['patientDetail']->phone or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Address Line 1 :</label>
                            </div>
                            <div class="col-sm-9">
                                 @if($patient['patientDetail']->address1)
                                {{ $patient['patientDetail']->address1 }}
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
                                @if($patient['patientDetail']->address2)
                                {{ $patient['patientDetail']->address2 }}
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
                                @if($patient['patientDetail']->city)
                                {{ $patient['patientDetail']->city }}
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
                                {{{ $patient['patientDetail']['patientStateName']->name or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Zip Code :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient['patientDetail']->zipCode or 'N/A' }}}
                            </div>
                        </div>	
                    </div>

                    <div id="attachment" class="tab-pane">
                        <p>Attachments</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Payment Bill :</label>
                            </div>
                            <div class="col-sm-9">
                                @if(isset($patient['patientDetail']->payment_bill) && !empty($patient['patientDetail']->payment_bill)) 
                                    <a href="{{ URL::asset('uploads/patient_documents/'.$patient['patientDetail']->payment_bill) }}" download="myimage" class="document_link" ><img src="{{ URL::asset('images/pdf_icon.png') }}" ></a>
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
                           <a href="javascript::void(0);" class="btn btn-default" onclick="window.history.go(-1); return false;">Back</a>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </div>

</section>
@endsection

