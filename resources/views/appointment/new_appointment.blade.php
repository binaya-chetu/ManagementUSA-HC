@extends('layouts.common')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')

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
             @include('appointment.popup_appointment_form')

        </div>
    </div>
</section>    
@endsection
