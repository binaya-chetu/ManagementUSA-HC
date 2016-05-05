

@extends('layouts.common')

@section('content')	
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .bootstrap-timepicker-widget.dropdown-menu.open {
        display: inline-block;
        z-index: 99999 !important;
    }
</style>

<link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap-timepicker/css/bootstrap-timepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('vendor/fullcalendar/fullcalendar.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('vendor/fullcalendar/fullcalendar.print.css') }}" media="print" />
<link rel="stylesheet" href="{{ URL::asset('css/stylesheets/theme.css') }}" />

<!-- Skin CSS -->
<link rel="stylesheet" href="{{ URL::asset('css/stylesheets/skins/default.css') }}" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="{{ URL::asset('css/stylesheets/theme-custom.css') }}">

<script src="{{ URL::asset('vendor/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>	
<script src="{{ URL::asset('vendor/fullcalendar/lib/moment.min.js') }}"></script>
<script src="{{ URL::asset('vendor/fullcalendar/fullcalendar.js') }}"></script>
<script src="{{ URL::asset('vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js') }}"></script>
	


<script>
/*
 Name: 			Pages / Calendar - Examples
 Written by: 	Okler Themes - (http://www.okler.net)
 Theme Version: 	1.4.1
 */

(function($) {

    'use strict';

    var initCalendarDragNDrop = function() {
        $('#external-events div.external-event').each(function() {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });
    };

    var initCalendar = function() {
        var $calendar = $('#calendar');
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $calendar.fullCalendar({
            header: {
                left: 'title',
                right: 'prev,today,next,basicDay,basicWeek,month'
            },
            timeFormat: 'h:mm A',
            titleFormat: {
                month: 'MMMM YYYY', // September 2009
                week: "MMM D YYYY", // Sep 13 2009
                day: 'dddd, MMM D, YYYY' // Tuesday, Sep 8, 2009
            },
            themeButtonIcons: {
                prev: 'fa fa-caret-left',
                next: 'fa fa-caret-right',
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped
                var $externalEvent = $(this);
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $externalEvent.data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.className = $externalEvent.attr('data-event-class');

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#RemoveAfterDrop').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },
            events: <?php echo json_encode($appointments, true); ?>
        });

        // FIX INPUTS TO BOOTSTRAP VERSIONS
        var $calendarButtons = $calendar.find('.fc-header-right > span');
        $calendarButtons
                .filter('.fc-button-prev, .fc-button-today, .fc-button-next')
                .wrapAll('<div class="btn-group mt-sm mr-md mb-sm ml-sm"></div>')
                .parent()
                .after('<br class="hidden"/>');

        $calendarButtons
                .not('.fc-button-prev, .fc-button-today, .fc-button-next')
                .wrapAll('<div class="btn-group mb-sm mt-sm"></div>');

        $calendarButtons
                .attr({'class': 'btn btn-sm btn-default'});
    };

    $(function() {
        initCalendar();
        initCalendarDragNDrop();
    });

}).apply(this, [jQuery]);



</script>   
<script src="/js/custom.js"></script>
<!-- Theme CSS -->

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Calendar</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{url('/')}}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>

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

            <h2 class="panel-title">View Appointments</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                
                <div class="row">
                    <div class="col-md-12 text-left col-sm-offset-1">
                        <a href="{{ url('/appointment/1') }}"><button id="addToTable" class="btn btn-primary" style="background: #428bca">Add Appointment <i class="fa fa-plus"></i></button></a>
                        <a href="{{ url('/patient/addpatient') }}"><button id="addToTable" class="btn btn-primary" style="background: #428bca">Add Patient    <i class="fa fa-plus"></i></button></a>
                    </div>
                </div>
                <div class="col-md-12">

                    <div id="calendar"></div>
                    <section class="panel">


                        <div class="panel-body">
                            <!--a class="modal-with-form btn btn-default" href="#modalForm">Open Form</a-->

                            <!-- Modal Form -->
                            <div id="modalForm" class="modal-block modal-block-primary mfp-hide">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/saveappointment') }}">  
                                    {!! csrf_field() !!}
                                    <section class="panel">
                                        <header class="panel-heading">
                                            <h2 class="panel-title">Edit Appointment</h2>
                                        </header>
                                        <div class="panel-body">


                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Choose Date & Time</label>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input  type="text" name="appDate"  data-plugin-datepicker  class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                        <input type="text" name="appTime" data-plugin-timepicker class="form-control">
                                                    </div>
                                                </div>
                                                <input type="hidden"  name="appointment_id" id="appointment_id">
                                                <input type="hidden"  name="marketer" value="1">
                                                <input type="hidden"  name="status" value="Not Required">
                                                <input type="hidden"  name="createdBy" value="{{ Auth::user()->id }}">
                                                <input type="hidden"  name="lastUpdatedBy" value="{{ Auth::user()->id }}">
                                            </div>   
                                            
                                            
                                             <div class="form-group{{ $errors->has('doctor_id') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">Doctor</label>

                                                <div class="col-md-6">
                                                    <select  class="form-control" name="doctor_id">
                                                        @foreach ($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}">{{ $doctor->firstName }} {{ $doctor->lastName }}</option>
                                                        @endforeach


                                                    </select>    
                                                    @if ($errors->has('doctor_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('doctor_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            

                                            <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">Patient</label>

                                                <div class="col-md-6">
                                                    <select  class="form-control" name="patient_id">
                                                        @foreach ($patients as $patient)
                                                        <option value="{{ $patient->id }}">{{ $patient->firstName }} {{ $patient->lastName }}</option>
                                                        @endforeach

                                                        <input type="hidden"  name="clinic" value="{{ Auth::user()->id }}">
                                                        <!--input type="hidden"  name="clinic" value="{{ Auth::user()->id }}"-->

                                                    </select>    
                                                    @if ($errors->has('patient_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('patient_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                           



                                            <!-- Patient Edited Details -->

                                            <div class="form-group"> 
                                                <label for="firstName" class="col-sm-4 control-label">First Name
                                                </label> 

                                                <div class="col-sm-6"> 
                                                    <input type="hidden" name="id"> 
                                                    <input type="text" name="firstName" id="first-name" class="form-control" placeholder="First Name" value="{{ old('firstName') }}"> 

                                                    <span class="help-block firstName">
                                                    </span> 
                                                </div> 
                                            </div> 

                                            <div class="form-group"> 
                                                <label for="lastName" class="col-sm-4 control-label">Last Name
                                                </label> 

                                                <div class="col-sm-6"> 
                                                    <input type="text" name="lastName" id="last-name" class="form-control" placeholder="Last Name" value="{{ old('lastName') }}"> 

                                                    <span class="help-block lastName">
                                                    </span>
                                                </div> 
                                            </div> 

                                            <div class="form-group"> 
                                                <label for="email" class="col-sm-4 control-label">Email
                                                </label> 

                                                <div class="col-sm-6"> 
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}"> 

                                                    <span class="help-block email">
                                                    </span> 
                                                </div> 
                                            </div> 

                                            <div class="form-group"> 
                                                <label for="phone" class="col-sm-4 control-label">Phone
                                                </label> 

                                                <div class="col-sm-6"> 
                                                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}"> 
                                                </div> 
                                            </div> 

                                            <div class="form-group"> 
                                                <label for="date" class="col-sm-4 control-label">DOB
                                                </label> 

                                                <div class="col-md-6"> 

                                                    <div class="input-group"> 

                                                        <span class="input-group-addon"> <i class="fa fa-calendar"></i> 
                                                        </span> 
                                                        <input type="text" name="dob" id="dob" data-plugin-datepicker class="form-control" value="{{ old('dob') }}"> 
                                                    </div> @if ($errors->has('dob')) 

                                                    <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> 
                                                    </span> @endif 
                                                </div> 
                                            </div> 

                                            <div class="form-group"> 
                                                <label class="col-sm-4 control-label">Gender
                                                </label> 

                                                <div class="col-sm-6"> 

                                                    <div class="col-sm-3"> 

                                                        <div class="radio-custom radio-primary"> 
                                                            <input id="awesome" name="gender" type="radio" value="Male" checked="true" required /> 
                                                            <label for="awesome">Male
                                                            </label> 
                                                        </div> 
                                                    </div> 

                                                    <div class="col-sm-3"> 

                                                        <div class="radio-custom radio-primary"> 
                                                            <input id="very-awesome" name="gender" type="radio" value="Female" /> 
                                                            <label for="very-awesome">Female
                                                            </label> 
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div> 

                                            <div class="form-group"> 
                                                <label for="address1" class="col-sm-4 control-label">Primary Address
                                                </label> 

                                                <div class="col-sm-6"> 
                                                    <textarea name="address1" id="address1" class="form-control" rows="3" placeholder="Primary Address">{{ old('address1') }}
                                                    </textarea> 
                                                </div> 
                                            </div> 
                                            <!-- End -->


                                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">Comment</label>

                                                <div class="col-md-6">
                                                    <textarea  class="form-control" name="comment" value="{{ old('comment') }}">
                                                    </textarea>

                                                    @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('comment') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>


                                        </div>
                                        <footer class="panel-footer">
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button class="btn btn-primary modal-confirm">Submit</button>
                                                    <button class="btn btn-default modal-dismiss">Cancel</button>
                                                </div>
                                            </div>
                                        </footer>
                                    </section>
                                </form>    
                            </div>

                        </div>
                    </section>

                </div>


            </div>
        </div>
    </section>

    <!-- end: page -->
</section>





@endsection	
