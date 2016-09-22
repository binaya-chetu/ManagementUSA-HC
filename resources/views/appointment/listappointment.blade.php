@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">

        <h2>
            @if(isset($type) && $type == 'followup')
                Followup Appointments
            @else
                List Appointments
            @endif</h2>
        </h2>

        <div class="right-wrapper pull-right appt_list">
            @if(Request::segment(2) === 'followup' && Request::segment(1) === 'appointment')
                {!! Breadcrumbs::render('appointment.followup') !!}
            @elseif(Request::segment(2) === 'followup' && Request::segment(1) === 'appointmentApptSetting')
                {!! Breadcrumbs::render('frontfollowup.followup') !!}
            @else
                {!! Breadcrumbs::render('appointment.listappointment') !!}
            @endif
        
        </div>
    </header>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>
            <h2 class="panel-title">
                @if(isset($type) && $type == 'followup')
                    Followup Appointments
                @else
                    List Appointments
                @endif</h2>

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
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Appointment Time</th>
                        <th>Patient</th>
                        <th>Reason for Visit</th>
                        <th>Source</th>                        
                        <th>Followup Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                        <td class="table-text"><div>{{ date('d F Y H:ia', strtotime($appointment->apptTime)) }}</div></td>

                        <td class="table-text"><div><a class="defaultColor" href="/patient/view/{{ base64_encode($appointment['patient']->id) }}">{{ $appointment['patient']->first_name }} {{ $appointment['patient']->last_name }}</a></div></td>
                        <td class="table-text"><div><?php 
                                $reasonArr = $appointment->patient->reason->toArray();
                                $reasonArray = array_column($reasonArr, 'reason_code');
                                $reasonList = array_column($reasonArray, 'reason');
                                $reason = implode(',', array_unique($reasonList)); 
                                echo $reason;
                                ?>                                
                            </div></td>
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
                            <td class="table-text"><div>
                                <?php
                                switch ($appointment->status) {
                                    case 1: echo "Pending";
                                        break;
                                    case 2: echo "Reschedule";
                                        break;
                                    case 3: echo "Cancel";
                                        break;
                                    case 4: echo "Confirmed";
                                        break;
                                    case 5: echo "Never treat";
                                        break;
                                    case 6: echo "Followup later";
                                        break;
                                    default: echo "Unknown";
                                        break;
                                }
                                ?>
                            </div>
                          </td>
                        <td class="actions">
                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                            <?php $date = date('Y-m-d H:i');
                                  $appointmentTime = date('Y-m-d H:i', strtotime($appointment->apptTime));
                                  
                                  ?>                            
                            @if($appointmentTime >= $date)
                                <a href="javascript:void(0)" class="on-default edit-row" rel="{{ $appointment->id }}"><i class="fa fa-pencil"></i></a>
                            @endif
                            <a href="javascript:void(0)" data-href="/appointment/delete/{{ base64_encode($appointment->request_id) }}" class="on-default remove-row confirmation-callback"><i class="fa fa-trash-o"></i></a> 
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
            @include('appointment.edit_appointment')   
            @include('appointment.followup_popup') 
</div>

<div id="modal-add-view-appointment" class="modal-block modal-block-primary mfp-hide">  
    @include('appointment.popup_appointment_form')              
</div>
@endsection