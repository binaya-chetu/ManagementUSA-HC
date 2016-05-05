@extends('layouts.common')

@section('content')

@include('appointment.viewHeader')

<script>
$(document).ready(function() {

    });
</script>    
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Create Appointment</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Create Appointment</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">

            <form class="form-horizontal add-appointment" role="form" method="POST" action="{{ url('/addappointment') }}">
                {!! csrf_field() !!}
                <section class="panel panel-primary">


                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                            <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                        </div>

                        <h2 class="panel-title">Create Appointment</h2>
                    
                    </header>

                    @include('appointment.addAppointmentForm')

                    <footer class="panel-footer">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Add Appointment
                                </button>
                            </div>
                        </div>

                    </footer>	
                </section>
            </form>

        </div>
    </div>
</section>    
@endsection
