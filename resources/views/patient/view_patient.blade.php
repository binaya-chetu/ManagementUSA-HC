@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>View patient :  {{ $patient->firstName }} {{ $patient->lastName }}</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ url('/') }}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
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
                    <li>
                        <a href="#attachment" data-toggle="tab">Attachments</a>
                    </li>
                </ul>
                <!--                {{ Form::open(array('url' => 'savePatient', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'addPatient')) }}-->
                <div class="tab-content">
                    <div id="personal" class="tab-pane active">
                        <p>Personal Information</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>First Name :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $patient->firstName }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Last Name :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $patient->lastName }}
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
                                <label>Gender :</label>
                            </div>
                            <div class="col-md-9">         
                                {{ $patient->gender }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Dob :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ date('d F Y', strtotime($patient->dob)) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Employer :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient->employer or 'N/A' }}}
                            </div>
                        </div>					
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Occupation :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient->occupation or 'N/A' }}}
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
                                {{{ $patient->phone or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Primary Address :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient->address1 or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Secondary Address :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient->address2 or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>City :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient->city or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>State :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient->state or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Zip Code :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient->zipCode or 'N/A' }}}
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
                                @if(isset($patient->payment_bill) && !empty($patient->payment_bill)) 
                                    <a href="{{ URL::asset('uploads/patient_documents/'.$patient->payment_bill) }}" download="myimage" class="document_link" ><img src="{{ URL::asset('images/pdf_icon.png') }}" ></a>
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
                           <a href="/patient" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </div>

</section>
@endsection

