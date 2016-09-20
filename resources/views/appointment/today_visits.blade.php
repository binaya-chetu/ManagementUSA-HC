@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Today Visits</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('appointment.todayVisits') !!}

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

            <h2 class="panel-title">Today Visits</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                @if(Session::has('flash_message'))
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @endif
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Appointment time</th>
                        <th>Patient</th>                        
                        <th>Source</th>
                        <th>Reason for Visit</th>
                        <th>Patient Status</th>
                        <th>Appointment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                        <td class="table-text"><div>{{ date('d F Y H:ia', strtotime($appointment->apptTime)) }}</div></td>

                        <td class="table-text"><div><a class="defaultColor" href="/patient/view/{{ base64_encode($appointment['patient']->id) }}">{{ $appointment['patient']->first_name }} {{ $appointment['patient']->last_name }}</a></div></td>

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
                        <td class="table-text">
                            <div><?php 
                                $reasonArr = $appointment->patient->reason->toArray();
                                $reasonArray = array_column($reasonArr, 'reason_code');
                                $reasonList = array_column($reasonArray, 'reason');
                                $reason = implode(',', array_unique($reasonList)); 
                                echo $reason; ?>                                
                            </div>
                        </td>
                        <td class="table-text"><div><?php
                                switch ($appointment->patient_status) {
                                    case 1: echo "Show";
                                        break;
                                    case 2: echo "No Show";
                                        break;
                                    default: echo "None";
                                        break;
                                }
                            ?></div></td>
                        <td class="table-text"><div><?php
                                switch ($appointment->progress_status) {
                                    case 1: echo "Send To Lab";
                                        break;
                                    case 2: echo "Waiting For Lab Report";
                                        break;
                                    case 3: echo "Ready Lab Report";
                                        break;
                                    default: echo "Pending";
                                        break;
                                }
                            ?></div></td>
                        <td class="actions">                            
                            @if($appointment->progress_status < 1)
                                <a href="javascript:void(0)" class="on-default patient_status" rel="{{ $appointment->id }}"><i class="fa fa-pencil"></i></a>
                            @endif
<!--                            <a href="javascript:void(0)" data-href="/appointment/delete/{{ base64_encode($appointment->id) }}" class="on-default remove-row confirmation-callback"><i class="fa fa-trash-o"></i></a> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>
<div id="modal-change-patient-status" class="modal-block modal-block-primary mfp-hide">  
    {{ Form::open(array('url' => '/appointment/savePatientStatus', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'changeStatus')) }}
    {!! csrf_field() !!}
    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Select Status</h2>
        </header>
        <div class="panel-body">
<!--            <div class="form-group">
                {{ Form::label('status', 'Patient Status', array('class' => 'col-sm-4 control-label mandatory')) }}
                <div class="col-md-6">
                    <?php $states = ['1' => 'Show', '2' => 'Send To Lab', '3' => 'Waiting For Lab Report', '4' => 'Ready Lab Report', '5' => 'No Show']; ?>
                    {{ Form::select('patient_status', ['' => 'Please Select Patient Status'] + $states, null, ['class' => 'form-control input required']) }}
                </div>
                {{ Form::hidden('appointment_id', 0, array('id' => 'patient_appt_id')) }}
            </div>-->
            {{ Form::hidden('appointment_id', 0, array('id' => 'patient_appt_id')) }}
            <div class="form-group">							
                {{ Form::label('patient_status', 'Patient Status', array('class' => 'col-sm-4 control-label mandatory')) }}
                <div class="col-sm-6">
                    <div class="radio">
                        <label>
                            {{ Form::radio('patient_status', 1, 1, ['id' => 'optionsRadios1']) }}
                            Show
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            {{ Form::radio('patient_status', 2, 0,  ['id' => 'optionsRadios2']) }}
                            No Show
                        </label>
                    </div>    
                </div>
            </div>   
            <div class="form-group">							
                {{ Form::label('progress_status', 'Appointment Status', array('class' => 'col-sm-4 control-label mandatory')) }}
                <div class="col-sm-6">
                    <div class="radio">
                        <label>
                            {{ Form::radio('progress_status', 1, 1, ['id' => 'optionsRadios3']) }}
                            Send To Lab
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            {{ Form::radio('progress_status', 2, 0, ['id' => 'optionsRadios4']) }}
                            Waiting For Lab Report
                        </label>
                    </div>    
                    <div class="radio">
                        <label>
                            {{ Form::radio('progress_status', 3, 0,  ['id' => 'optionsRadios5']) }}
                            Ready Lab Report
                        </label>
                    </div>   
                </div>
            </div> 
            
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-8 text-right">
                    {{ Form::button('Submit', ['class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit']) }}    
                    <button class="btn btn-default closePop">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
    {{ Form::close() }}  
</div>
@endsection