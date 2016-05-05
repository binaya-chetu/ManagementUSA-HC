<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .bootstrap-timepicker-widget.dropdown-menu.open {
        display: inline-block;
        z-index: 99999 !important;
    }
</style>
<link rel="stylesheet" href="{{ URL::asset('js/chosen/chosen.css') }}" />
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
<script src="{{ URL::asset('js/chosen/chosen.jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/chosen/chosen.jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/chosen/chosen.order.jquery.min.js') }}"></script>
	


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