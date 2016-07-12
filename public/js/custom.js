(function($){
    $.fn.checkUploadFileType = function(options) {
        var defaults = {
            allowedExtensions: [],
            success: function() {},
            error: function() {}
        };
        options = $.extend(defaults, options);

        return this.each(function() {
            $(this).on('change', function() {
                var value = $(this).val(),
                    file = value.toLowerCase(),
                    extension = file.substring(file.lastIndexOf('.') + 1);

                if ($.inArray(extension, options.allowedExtensions) == -1) {
                    options.error();
                    $(this).focus();
                } else {
                    options.success();
                }
            });
        });
    };	
})(jQuery);

var initCalendarDragNDrop = function() {
	$('#external-events div.external-event').each(function() {
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

var initCalendar = function(events, start = "00:00:00", end="24:00:00", defaultApptTime = "00:30:00", gapBetweenAppt="00:00:00", inputDate = null, defaultView = "month") {
	var $calendar = $('#calendar');
	var date = (inputDate == null)? new Date() : new Date(inputDate);
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	$calendar.fullCalendar({
		header: {
			left: 'title',
			right: 'prev,today,next,agendaDay,agendaWeek,month'
		},
		timeFormat: 'h:mm A',
		titleFormat: {
			month: 'MMMM YYYY', // September 2009
			week: "MMM D YYYY", // Sep 13 2009
			day: 'dddd, MMM D, YYYY' // Tuesday, Sep 8, 2009
		},
		themeButtonIcons: {
			prev: 'fa fa-caret-left',
			next: 'fa fa-caret-right'
		},
		editable: true,
		timezone: 'local',
		defaultView: 'agendaDay',
		slotEventOverlap: false,
		minTime: start,
		maxTime: end,
		
		slotLabelInterval: 30,
		slotLabelFormat: 'h(:mm)a',
		allDaySlot: false,
		firstDay:moment().format('MM/DD/YYYY'),
		droppable: false, // this allows things to be dropped onto the calendar !!!
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
		events: events,
		viewRender: function(view, element) {
			if (view.start.isBefore(moment())){  //if view start is before now
				$('#calendar').fullCalendar('gotoDate', moment().format('MM/DD/YYYY')); //go to now
			}
		},
		eventRender: function (event, element) {
			element.find('.fc-event-inner').attr('data-id', event.id);
		},		
		businessHours: [
		{
			start: '09:00',
			end: '17:00',
			dow: [1, 2, 3, 5, 6]
		},
		{
			start: '09:00',
			end: '19:00',
			dow: [4]
		}
		]
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

var initDoctorSchedulrCalendar = function(events, inputDate = null, slotMinutes = 30, start = '00:00:00', end = '24:00:00') {
	var $calendar = $('#calendar');
	var date = (inputDate == null || inputDate == "" || inputDate == undefined)? new Date() : new Date(inputDate);
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	$calendar.fullCalendar({
		height: "700",
		defaultDate:moment(date),
		slotEventOverlap: false,
		defaultTimedEventDuration: '00:30:00',
		defaultView: 'agendaWeek',
		header: {
			left: 'title',
			right: 'prev,next'
		},
		allDaySlot: false,
		slotMinutes: slotMinutes,
		minTime: start,
		maxTime: end,
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
		droppable: false, // this allows things to be dropped onto the calendar !!!
		eventStartEditable: false, // this allows things to be dropped onto the calendar !!!
		selectable: true,
		select: function(start, end, allDay, event) {
			$(event.target).css('background-color', '#0088CC');
			var today = new Date();
			if (start < today){
				apptDate = today.getMonth() + 1 + '/' + today.getDate() + '/' + today.getFullYear();
			} else{
				apptDate = start.format('MM/DD/YYYY');
			}

			apptTime = start.format('hh:mm A');
			$('input[data-plugin-datepicker]').datepicker('setDate', apptDate);
			$('input[data-plugin-timepicker]').timepicker('setTime', apptTime);
			$.magnificPopup.close();
		},
		eventRender: function (event, element) {
			element.find('.fc-event-title').prop('title', event.title);
			element.find('.fc-event-inner').css('padding', '0 2px');
			element.find('.fc-event-time').remove();
		},
		events: events
	});
	// FIX INPUTS TO BOOTSTRAP VERSIONS
	var $calendarButtons = $calendar.find('.fc-header-right > span');
	$calendarButtons.filter('.fc-button-prev, .fc-button-today, .fc-button-next')
		.wrapAll('<div class="btn-group mt-sm mr-md mb-sm ml-sm"></div>')
		.parent()
		.after('<br class="hidden"/>');
	$calendarButtons
		.not('.fc-button-prev, .fc-button-today, .fc-button-next')
		.wrapAll('<div class="btn-group mb-sm mt-sm"></div>');
	$calendarButtons
		.attr({'class': 'btn btn-sm btn-default'});
};
		
$(document).ready(function() {
    showAppointmentCount();
        setInterval(function() {
            showAppointmentCount();
        }, 5000);
    
    $('#external-events').hide();
	$('select.chosen').chosen();
	$('.add-appointment-submit').submit(function(event) {
		event.preventDefault();
	});
    $.validator.setDefaults({ignore: ":hidden:not(select)"});
    $.validator.addMethod("aFunction", function(value, element) {
		if (value === "none")
				return false;
				else
				return true;
		}, "Please select a value");
        /*
         * Below functions are called for add appointment.
         */
        $('#calendarDate').datepicker('setDate', moment().format('MM/DD/YYYY'));
        var i = 1;
        var j = 1;
        $("#addAppPatient").click(function() {
        if (i === 1)
        {
                $("#email").rules("add", { remote: ajax_url+ "/apptsetting/uniqueEmail"});
                $('#patient_come [type=text], #patient_come [type=email]').val('');
                $('#patient_come').show();
                $('#patient_id').val('');
                $('#addAppPatient').html('Choose Patient <i class="fa fa-minus"></i>');
                $('.patient_id').hide();
                i = 2;
        } else
        {
                $('#patient_come').hide();
                $('.patient_id').show();
                $('#addAppPatient').html('<i class="fa fa-plus"></i> Add Patient');
                i = 1;
                }
                return false;
        });
        /*
         * End of Functions for Add appointment.
         */

        $(document).on("click", ".edit-row", function(ev) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        var appointmentId = $(this).attr('rel');
        $.ajax({
        type: "POST",
                url: ajax_url + "/appointment/editappointment",
                data: {"id": appointmentId },
                success: function(response) {
                var combine = JSON.parse(response);
                        if (combine.appointment.status < 2){
                $('.followButton').show();
                } else{
                $('.followButton').hide();
                }
                $('#appointment_id').val(combine.appointment.id);
                        $("#patient_id").val(combine.patient.id).attr('selected', 'selected').trigger("chosen:updated");
                        if (combine.doctor){
                $("#doctor_id").val(combine.doctor.id).attr('selected', 'selected').trigger("chosen:updated");
                        $('input[name=doctor_id]').val(combine.doctor.id);
                } else{
                $("#doctor_id").val('').trigger("chosen:updated");
                        $('input[name=doctor_id]').val('0');
                }
                $('input[name=patient_id]').val(combine.patient.id);
                        $('#appointmentComment').val(combine.appointment.comment);
                        $('#first-name').val(combine.patient.first_name);
                        $('#last-name').val(combine.patient.last_name);
                        $('#email').val(combine.patient.email);
                        $('#phone').val(combine.patient.patient_detail.phone);
                        $('#address1').val(combine.patient.patient_detail.address1);
                        $('input:radio[name="gender"][value="' + combine.patient.patient_detail.gender + '"]').prop('checked', true);
                        $('input[data-plugin-datepicker]').datepicker('setDate', moment(combine.appointment.apptTime).format('MM/DD/YYYY'));
                        $('input[data-plugin-timepicker]').timepicker('setTime', moment(combine.appointment.apptTime).format('hh:mm A'));
                        $('#dob').datepicker('setDate', moment(combine.patient.dob).format('MM/DD/YYYY'));
                        $('#deleteAppointmentFromCalendar').attr('data-href', '/appointment/delete/' + btoa(combine.appointment.id));
                }
        });
        $.magnificPopup.open({
        items: {
        src: '#modalForm',
                type: 'inline'
        }
        });
        });
        $('.list-edit').on('change', function() {

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        });
        /*
         * Below Function are Called for View Appointment.
         */

        $(document).on("click", "#add-view-appointment", function(ev) {
            $.magnificPopup.open({
            items: {
            src: '#modal-add-view-appointment',
                    type: 'inline'
                    }
            });
        });
        $(document).on("click", ".fc-event-inner", function(ev) {
		var text =  $(this).data('id');
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
			type: "POST",
                url: "/appointment/editappointment",
                data: {"id": text},
                success: function(response) {
                var combine = JSON.parse(response);
                        if (combine.appointment.status < 2){
                $('.followButton').show();
                } else{
                $('.followButton').hide();
                }

                if (combine.doctor){
                $("#doctor_id").val(combine.doctor.id).attr('selected', 'selected').trigger("chosen:updated");
                        $('input[name=doctor_id]').val(combine.doctor.id);
						$(".showDocScheddulerLInk").html('<a href="#" data-link = "'+combine.doctor.id+'">Show scheduler</a>');
                } else{
                $("#doctor_id").val('').trigger("chosen:updated");
                        $('input[name=doctor_id]').val('0');
                }
                $('#appointment_id').val(combine.appointment.id);
                    $("#patient_id").val(combine.patient.id).attr('selected', 'selected').trigger("chosen:updated");
                    $('input[name=patient_id]').val(combine.patient.id);
                    $('#appointmentComment').val(combine.appointment.comment);
                    $('#first-name').val(combine.patient.first_name);
                    $('#last-name').val(combine.patient.last_name);
                    $('#email').val(combine.patient.email);
                    $('#phone').val(combine.patient.patient_detail.phone);
                    $('#address1').val(combine.patient.patient_detail.address1);
                    $('input:radio[name="gender"][value="' + combine.patient.patient_detail.gender + '"]').prop('checked', true);
                    $('input[data-plugin-datepicker]').datepicker('setDate', moment(combine.appointment.apptTime).format('MM/DD/YYYY'));
                    $('input[data-plugin-timepicker]').timepicker('setTime', moment(combine.appointment.apptTime).format('hh:mm A'));
                    $('#dob').datepicker('setDate', moment(combine.patient.patient_detail.dob).format('MM/DD/YYYY'));
                    $('#deleteAppointmentFromCalendar').attr('data-href', '/appointment/delete/' + btoa(combine.appointment.id));
                }
        });
        $.magnificPopup.open({
        items: {
			src: '#modalForm',
			type: 'inline'
        }
        });
        });
	$("#addAppointment #doctor_id, #editAppointment #doctor_id").on('change', function(e){
		var doctor_id 	= $(this).val();
		if(doctor_id == ''){
			$(".showDocScheddulerLInk a").remove();
			return false;
		}
		$(".showDocScheddulerLInk").html('<a href="#" data-link = "'+doctor_id+'">Show scheduler</a>');
	});
	$(document).on('click', '.showDocScheddulerLInk a', function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });		
		var doctor_id 	= $(this).data('link');
		var date 		= $("#appDate").val();
		var slotMinutes = $("input[name='apptSlotDuration']").val();  // span of each appointment in minutes
		var start 		= $("input[name='clinicOpeningTime']").val(); // clinic open time
		var end 		= $("input[name='clinicClosingTime']").val(); // clinic closing time 
		var modalId		= $(this).closest('.modal-block').attr('id');
		$.ajax({
            type: "POST",
            url: "/getdoctorschedule",
            data: {'doctor_id': doctor_id},
			dataType: "json",
            success: function(data) {
				$("#docApptSchedule").find("#calendar").remove()
 				//$('#doctor_id').closest('.form-group').append('<div class="col-md-12" id="calendar"></div>');
 				$("#docApptSchedule").find('.panel-body').append('<div class="col-md-12" id="calendar"></div>');

				$.magnificPopup.instance.close = function(){
					$.magnificPopup.proto.close.call(this);
					if($('#'+modalId).length > 0){
						$.magnificPopup.open({
							items: {
								src: '#'+modalId,
								type: 'inline'
							}
						});
						$.magnificPopup.instance.close = function(){
							$.magnificPopup.proto.close.call(this);
						}					
					}
				};				
				
				$.magnificPopup.open({
									items: {
										src: '#docApptSchedule',
										type: 'inline',
									},
								});
				initDoctorSchedulrCalendar(data, date, slotMinutes, start, end);
				//initCalendarDragNDrop(); 
            },
            error: function() {
                alert("failure");
            }
        });	 
	})

	$(document).on('click', '.addMedicineListRow', function(){
		new emrFormNewPopUpRow();
	});
	
	$(document).on('click', '.saveMedicineList', function(){
		$('#vitaminSupplimentBox').html('');
		var data = [];
		$(".vitSupInput").closest('tr').each(function(i,v){
			row = {};
			row['name'] = $(v).find('.name input').val();
			row['dosage'] = $(v).find('.dosage input').val();
			row['how_often'] = $(v).find('.how_often input').val();
			row['condition'] = $(v).find('.condition input').val();
			if(row['name'] != ''){
				data.push(row);
			}
		});
		data = JSON.stringify(data);
		input = jQuery('<input/>', {
			type: 'hidden',
			value: data,
			name: 'vitaminSuppliments'
		});
		$('#vitaminSupplimentBox').append(input);
	});
	
	$(document).on('click', '.saveIllnessList', function(){
		$('#illnessListBox').html('');
		var data = [];
		$(".illnessInput").closest('tr').each(function(i,v){
			row = {};
			row['illness'] = $(v).find('.illness input').val();
			if(row['illness'] != ''){
				data.push(row);
			}
		});
		data = JSON.stringify(data);
		input = jQuery('<input/>', {
			type: 'hidden',
			value: data,
			name: 'illness'
		});
		$('#illnessListBox').append(input);
	});
	
	$(document).on('click', '.saveSurgeryList', function(){
		$('#surgeryListBox').html('');
		var data = [];
		$(".surgeryInput").closest('tr').each(function(i,v){
			row = {};
			row['type_of_surgery']	= $(v).find('.type_of_surgery input').val();
			row['surgery_date']		= $(v).find('.surgery_date input').val();
			row['surgery_reason']	= $(v).find('.surgery_reason input').val();
			if(row['type_of_surgery'] != ''){
				data.push(row);
			}
		});
		data = JSON.stringify(data);
		input = jQuery('<input/>', {
			type: 'hidden',
			value: data,
			name: 'surgeryList'
		});
		$('#surgeryListBox').append(input);
	});
	
	$(document).on('click', '.saveAllergiesList', function(){
		new saveEmrPopupList();
	});

	$(document).on('click', '.deleteVitListRow', function(){
		$(this).closest('tr').remove();
	});
	/*  remove error message when next file is loaded on import products page */
	$("#addcategories").find('#categoryFile').on('change', function(){
		$(".help-block").remove();
		$(".has-error").removeClass('has-error');
	});	
});

	/**
	* saveEmrPopupList: saves lsit data from emr form popup to database
	*/
	function saveEmrPopupList(){
		$('#allergiesListBox').html('');
		var data = [];
		$(".allergiesInput").closest('tr').each(function(i,v){
			row = {};
			row['allergic_medicine']	= $(v).find('.allergic_medicine input').val();
			if(row['allergic_medicine'] != ''){
				data.push(row);
			}
		});
		data = JSON.stringify(data);
		input = jQuery('<input/>', {
			type: 'hidden',
			value: data,
			name: 'allergiesList'
		});
		$('#allergiesListBox').append(input);		
	};

	/**
	* emrFormNewPopUpRow: adds new empty row to popup forms within patient emr form
	* 
	*/
	function emrFormNewPopUpRow(){
		var clone = $(".addMedicineListRow").closest('.panel-footer').prev('.panel-body').find('tr:last').clone('true');
		var lastRow = $(".addMedicineListRow").closest('.panel-footer').prev('.panel-body').find('tr:last');
		
		var n = parseInt($(lastRow).data('count'));
		n += 1;
		$(clone).attr('data-count', n);

		$.each(clone.find('td'), function(i,v){
			if($(v).find('input').length > 0){
				id = $(v).find('input').attr('id');
				name = $(v).find('input').attr('name');
				id = id.substring(0, id.lastIndexOf('_'))+'_'+n;
				name = name.substring(0, name.lastIndexOf('_'))+'_'+n;
				$(v).find('input').attr({'id': id, 'name': name});
				$(v).find('input').val('');
			}
		});
		
		clone.insertAfter(lastRow);		
	}	
        (function($) {

        'use strict';
                var datatableInit = function() {
                var $table = $('#datatable-tabletools');
                        $table.dataTable({
                        sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
                                oTableTools: {
                                sSwfPath: $table.data('swf-path'),
                                        aButtons: [
                                        {
                                        sExtends: 'pdf',
                                                sButtonText: 'PDF'
                                        },
                                        {
                                        sExtends: 'csv',
                                                sButtonText: 'CSV'
                                        },
//                                        {
//                                        sExtends: 'xls',
//                                                sButtonText: 'Excel'
//                                        },
                                        {
                                        sExtends: 'print',
                                                sButtonText: 'Print',
                                                sInfo: 'Please press CTR+P to print or ESC to quit'
                                        }
                                        ]
                                }
                        });
                };
                $(function() {
                datatableInit();
                });
        }).apply(this, [jQuery]);

$(document).on("click", "#add_marketing_call", function(ev) {
            $.magnificPopup.open({
            items: {
            src: '#modal_add_marketing_call',
                    type: 'inline'
                    }
            });
        });
var table = $('table')[0];
var button = $('th')[0];		
$(button).on( 'click', function (e) {
    var data = table
        .data()
        .map( function (row) {
            return row.join(',');
        })
        .join( '\n' );
 
    saveAs(
        new Blob( [data], {type : 'text/csv'},
        'My file.csv'
    ));
} );

/*
 * Show the appointment patient record on the selection form choosing patient at the time of create appointment
 */
$('#patient_id').on('change', function(){
    var appt_request_id = $(this).val();
    if(appt_request_id != ''){
        
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $('#emailParent').removeClass('has-error');
        $('#emailParent label[class=error]').remove();
        $('#patient_come [type=text], #patient_come [type=email]').val('');
        $.ajax({
		type: "POST",
                url: ajax_url+"/apptsetting/findAppointmentDetail",
                data: {"id": appt_request_id},
                success: function(response) {
                var combine = JSON.parse(response);                
                $('#first_name').val(combine.first_name);
                $('#last_name').val(combine.last_name);
                $('#email').val(combine.email);
                $('#phone').val(combine.phone);
                $('#dob').datepicker('setDate', moment(combine.dob).format('MM/DD/YYYY'));
                $('#email').rules('remove', 'remote');
                $('#patient_come').show();
                }
        });
    }else{
        $("#email").rules("add", "required");
        $('#patient_come').hide();
    }
});
/*
 * Validate the form for creating new form by the Appt Setting 
 */
 $('#addApptRequest').validate({
          rules: {
            email: {
              //required: true,
              email: true,
              remote: ajax_url+ "/apptsetting/uniqueEmail"
            }
          },
          messages:{
              email: {
                  remote: 'Email already registered'
              }
          }
    });
 
 $(document).on("click", ".patient_status", function(ev) {
            $.magnificPopup.open({
            items: {
            src: '#modal-add-view-appointment',
                    type: 'inline'
                    }
            });
        });
$(document).on("click", ".patient_status", function(event) {
        event.preventDefault();        
        var appointmentId = $(this).attr('rel');       
        $('#patient_appt_id').val(appointmentId);
        $.magnificPopup.open({
            items: {
                src: '#modal-change-patient-status',
                type: 'inline'
            }
        });
    });
     $(document).ready(function(){
        $("#print_invoice").click(function(){
        if (document.getElementById("email_invoice").checked){
        var invoice_id = $("#invoice_id").val();
                $.ajax({
                url: ajax_url+"products/emailInvoice/",
                        data:{invoiceid:invoice_id},
                        success: function(result){
                        alert("hello");
                                   // $("#div1").html(result);
                                 }});
                            //  window.print();
                        }
                        else{
                        window.print();
                        }
                    });
        });
                $('#changeStatus').validate();
    $('#changeStatus').validate();
    
    
function showAppointmentCount(){
    $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $.ajax({
    type: "POST",
            url: ajax_url + "/appointment/countAppointments",
            success: function(response) {
                var combine = JSON.parse(response);
                $('.badge').text(combine.lab_appointment);
                
            }
    });
}

