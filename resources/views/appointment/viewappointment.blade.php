@extends('layouts.common')
@section('content')	
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Appointment Calendar</h2>

        <div class="right-wrapper pull-right">
            @if(!empty(Request::segment(2)))
            {!! Breadcrumbs::render('appointment.viewappointment') !!}
            @endif

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
 
    <section class="panel">
        <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">	
                    <div class="tabs">
                        <ul class="nav nav-tabs" id = "calender-tabs">
                            <li class="active">
                                <a href="#calender"  data-toggle="tab"><i class="fa fa-star"></i>Appointment Calender</a>
                            </li>
                            <?php// echo "<pre>";print_r($categories);die;?>
                            @foreach($categories AS $category)
                            @if($category->id == 2)
                            <li>
                                <input type ="hidden" name="trimix_id" value="{{$category->id}}" />
                                <a href="#trimix-calender" id ="trimix"  data-toggle="tab">Trimix Therapy Calender</a>
                            </li>
                            @endif
                           @if($category->id == 12)
                            <li>
                                <input type ="hidden" name="siblingual_id" value="{{$category->id}}" />
                                <a href="#siblingual-calender" id ="siblingual"  data-toggle="tab">Sublingual Troche Therapy Calender</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            <div id="calendar" class="tab-content active"> </div>
                            <div id ="trimix-calender" class="tab-content" ></div>
                            <div id ="siblingual-calender" class="tab-content"  ></div>
                        </div>
                    </div>
                </div>
             </div>
            <div class="row">
        
                @if(Session::has('flash_message'))
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @endif
                <div class="row">
                    <!--div class="col-md-12 text-left col-sm-offset-1">
                        <a href="javascript:void(0)"><button id="add-view-appointment" class="btn btn-primary">Add Appointment <i class="fa fa-plus"></i></button></a>
                        <a href="{{ url('/patient/addpatient') }}"><button id="addToTable" class="btn btn-primary">Add Patient    <i class="fa fa-plus"></i></button></a>
                    </div-->
                </div>
                <div class="col-md-12">
<!--                 <div id="calendar"></div>-->
                    <section class="panel">
                        <div class="panel-body">
                            <div id="dialog" class="modal-block mfp-hide">
                                <section class="panel">
                                    <header class="panel-heading">
                                        <h2 class="panel-title">Are you sure?</h2>
                                    </header>
                                    <div class="panel-body">
                                        <div class="modal-wrapper">
                                            <div class="modal-text">
                                                <p>Are you sure that you want to delete this row?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="panel-footer">
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button id="dialogConfirm" class="btn btn-primary" value="10">Confirm</button>
                                                <button id="dialogCancel" class="btn btn-default">Cancel</button>
                                            </div>
                                        </div>
                                    </footer>
                                </section>
                            </div>

                            <!-- Modal Form -->
                            <div id="modalForm" class="modal-block modal-block-primary mfp-hide">                               
                                @include('appointment.edit_appointment')                                          
                            </div>

                            <div id="modal-add-view-appointment" class="modal-block modal-block-primary mfp-hide">                                
                                @include('appointment.popup_appointment_form')                                          
                            </div>

                            <!-- Model for the Follow up Status -->
                             @include('appointment.followup_popup') 
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <!-- end: page -->
</section>

<script>
    (function($) {
		var clinicOpenTime = "{{ @config('constants.CLINIC_OPEN_TIME') }}";
		var clinicCloseTime = "{{ @config('constants.CLINIC_CLOSE_TIME') }}";
		var defaultApptTime = "{{ @config('constants.DEFAULT_APPOINTMENT_TIME_SPAN') }}";
		var gapBetweenAppt = "{{ @config('constants.GAP_BETWEEN_APPOINTMENTS') }}";
		
        'use strict';

        $(function() {
            initCalendar(<?php echo json_encode($appointments, true); ?>, clinicOpenTime, clinicCloseTime, defaultApptTime, gapBetweenAppt,  "calendar");
            initCalendar(<?php echo json_encode($appointments, true); ?>, clinicOpenTime, clinicCloseTime, defaultApptTime, gapBetweenAppt, "trimix-calender");
            initCalendar(<?php echo json_encode($appointments, true); ?>, clinicOpenTime, clinicCloseTime, defaultApptTime, gapBetweenAppt, "siblingual-calender");
            //initCalendarDragNDrop();
        });

    }).apply(this, [jQuery]);

</script>
@endsection	
