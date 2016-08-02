@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Lab Ready Appointments</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('appointment.labReadyAppointments') !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right">
                <i class="fa fa-chevron-left"></i>
            </a>
        </div>
    </header>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Lab Ready Appointments</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                @if(Session::has('flash_message'))
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @endif
                 @if(Session::has('error_message'))
                    <div class="col-sm-12"><div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><em> {!! session('error_message') !!}</em></div></div>
                @endif
            </div>
            <div class="row">
                @if(Session::has('flash_message'))
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @endif
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>App Date and Time</th>
                        <th>Patient</th>                        
                        <th>Source</th>
                        <th>Reason of visit</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                        <td class="table-text"><div>{{ $appointment->apptTime }}</div></td>

                        <td class="table-text"><div><a class="defaultColor" href="/appointment/patientMedical/{{ base64_encode($appointment['patient']->id) }}">{{ $appointment['patient']->first_name }} {{ $appointment['patient']->last_name }}</a></div></td>
                        
                        <td class="table-text"><div>
                                <?php
                                switch ($appointment->appt_source) {
                                    case 1: echo "Web Lead";
                                        break;
                                    case 2: echo "Tele Marketing";
                                        break;
                                    case 3: echo "Walk-ins";
                                        break;
                                    default: echo "Unknown";
                                        break;
                                }
                                ?>
                            </div></td>
                        <td class="table-text"><div><?php 
                                $reasonArr = $appointment->patient->reason->toArray();
                                $reasonArray = array_column($reasonArr, 'reason_code');
                                $reasonList = array_column($reasonArray, 'reason');
                                $reason = implode(',', array_unique($reasonList)); 
                                echo $reason; ?>                                
                            </div></td>
                        <td class="table-text"><div>{{ $appointment->patient->patientDetail->phone }}</div></td>
                        <td class="actions">                            
                            <a href="javascript:void(0)" class="on-default createAppointment" rel="{{ $appointment->id }}"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>
<!-- Modal Form -->
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">  
    @include('appointment.appointment_after_report_popup')   
</div>
@endsection