@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Upcoming Appointment</h2>

        <div class="right-wrapper pull-right">
            @if(Request::segment(1) === 'appointmentApptSetting')
                {!! Breadcrumbs::render('frontupcoming.upcomingappointments') !!}
            @else
                {!! Breadcrumbs::render('appointment.upcomingappointments') !!}
            @endif

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Upcoming Appointment</h2>
        </header>
        <div class="panel-body">
            @if(Session::has('flash_message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
            @endif	

            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Appt. Date</th>
                        <th>Followup Action</th>   
                        <th>Followup Date</th>   
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($followup as $follow)
                    <tr class="gradeX">
                        <td>{{ ++$i }}</td>
                        <td><a class="defaultColor" href="/patient/view/{{ base64_encode($follow->appointment->patient->id) }}">{{ $follow->appointment->patient->first_name }} {{ $follow->appointment->patient->last_name }}</a></td>
                        <td>{{ date('d F Y H:ia', strtotime($follow->appointment->apptTime)) }}</td>
                        <td>{{ $follow->followupStatus->title }}
                        @if($follow->action == 2 || $follow->action == 6)
                            <?php echo ' on '.date('d F Y', strtotime($follow->schedule->appointment->apptTime)); ?> 
                        @endif</td>  
                        <td>{{ date('d F Y H:ia', strtotime($follow->created_at)) }}</td>             
                        <td class="actions">
                            <a href="/appointment/viewFollowup/{{ base64_encode($follow->id) }}" class="on-default" title="View"><i class="fa fa-eye"></i></a>
                            <a href="javascript:void(0)" data-href="/appointment/followup/delete/{{ base64_encode($follow->id) }}" class="on-default remove-row confirmation-callback"><i class="fa fa-trash-o"></i></a> 							
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection