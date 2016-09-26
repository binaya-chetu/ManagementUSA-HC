@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Patients List</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('patient') !!}

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

            <h2 class="panel-title">Patients List</h2>
        </header>
        <div class="panel-body">
            @if(Session::has('flash_message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
            @endif	
            <!--div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a id="addToTable" class="btn btn-primary" href='/patient/addpatient'>Add patient <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div-->
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php $i = 0; ?>
                    @foreach ($patients as $patient)
                    <tr class="gradeX">
                        <td>{{ ++$i }}</td>
                        <td><a class="defaultColor" href="/patient/view/{{ base64_encode($patient->id) }}">{{ $patient->first_name }} {{ $patient->last_name }}</a></td>
                        <td><a class="defaultColor" href="/patient/view/{{ base64_encode($patient->id) }}">{{ $patient->email }}</a></td>
                        <td>{{ $patient['patientDetail']->phone }}</td>
                        <td>@if($patient['patientDetail']->city){{ $patient['patientDetail']->city }} @else {{ 'N/A' }} @endif</td>                      
                        <td>{{{ $patient['patientDetail']['patientStateName']->name or 'N/A' }}}</td>  
                          <td>{{{ $patient['patientDetail']['patientLocationName']->name or 'N/A' }}}</td>
                        <td class="actions">
                            <a href="/appointment/patientMedical/{{ base64_encode($patient->id) }}"  title="Edit"><i class="fa fa-pencil"></i></a> | 
                            <a href="/patient/view/{{ base64_encode($patient->id) }}"  title="View"><i class="fa fa-eye"></i></a> | 
                           <a data-href="/patient/delete/{{ base64_encode($patient->id) }}" href="javascrpt:void(0)" class="on-default remove-row confirmation-callback" ><i class="fa fa-trash-o"></i></a> 
<!--                           @if(!($patient['patientDetail']->never_treat_status)) 
                           |
                           <a href="/appointment/newAppointment/{{ base64_encode($patient->id) }}" class="on-default" title="Add Appointment"><i class="fa fa-calendar"></i></a>
                           @endif-->
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </section>
</section>
@endsection