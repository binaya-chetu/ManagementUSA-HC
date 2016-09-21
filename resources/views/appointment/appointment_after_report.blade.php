@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">

        <h2>
            Appointments After Report
        </h2>

        <div class="right-wrapper pull-right">
            
            @if(Request::segment(1) === 'appointmentApptSetting')
                {!! Breadcrumbs::render('frontapptafterreport.appointmentAfterReport') !!}
            @else
                {!! Breadcrumbs::render('appointment.appointmentAfterReport') !!}
            @endif
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
            <h2 class="panel-title">
                Appointments After Report
            </h2>

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
                        <th>App Date and Time</th>
                        <th>Patient</th>
                        <th>Reason for Visit</th>
                        <th>Source</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                        <td class="table-text"><div>{{ $appointment->apptTime }}</div></td>

                        <td class="table-text"><div><a class="defaultColor" href="/patient/view/{{ base64_encode($appointment['patient']->id) }}">{{ $appointment['patient']->first_name }} {{ $appointment['patient']->last_name }}</a></div></td>
                        <td class="table-text"><div><?php 
                                $reasonArr = $appointment->patient->reason->toArray();
                                $reasonArray = array_column($reasonArr, 'reason_code');
                                $reasonList = array_column($reasonArray, 'reason');
                                $reason = implode(',', array_unique($reasonList)); 
                                echo $reason; ?>                                
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
                        <td class="actions">
                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                            
                            <a href="/categories/listCategories" class="on-default"><i class="glyphicon glyphicon-tags"><title>Add to cart</title></i></a> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>
@endsection