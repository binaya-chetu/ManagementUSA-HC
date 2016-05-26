var ajax_url = window.location.origin;
/* Add here all your JS customizations */
$(function() {

    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

    // timeout for alert message
    setTimeout(function() {
        $('.alert').css('display', 'none');
    }, 8000);
    
	
	// validation for USA phone number
    $('#phone').usphone();
     
    // common validation for add/edit patients.
    $('#patient').validate({
        rules: {
            payment_bill: {
                extension: "jpg|gif|png|pdf|doc|docx|csv|xls"
            }
        }
    });
    
    // common validation for add/edit doctor.
    $('#doctor').validate();
    
    // common validation for add/edit roles.
    $('#addRole').validate();
    
    // common validation for add/edit users.
    $('#addUser').validate();
	
	
	//validation for followup pop-up form.
    $('#followUp').validate();

    //validation for followup pop-up form.
    $('#editAppointment').validate();
    $('#addAppointment').validate({
          rules: {
            email: {
              required: true,
              email: true,
              remote: "../appointment/uniquePatientEmail"
            }
          },
          messages:{
              email: {
                  remote: 'Email already registered'
              }
          }
    });
    
   
    // Set the calendar start date as today Date
    $('.selectDate').datepicker({
        startDate: today
    });
    /* ------------------------------------ Appointment Follow Up Code --------------------------- */
    // hidden the fields of the followup form
    $('#showOnSchedule').hide();
    
    // code for the close fisrt pop-up & open another pop-up
    $(document).on("click", ".followUp", function(event) {
        event.preventDefault();
        
        var appointmentId = $('#appointment_id').val();       
        $('#followup_appointment_id').val(appointmentId);
        // If popup close first time & open another time then unset the previous option for followup
        $('input:radio[name="action"]').removeAttr('checked');
        $('#showOnSchedule').hide();
        $.magnificPopup.close();
        $.magnificPopup.open({
            items: {
                src: '#modal-followup-status',
                type: 'inline'
            }
        });
    });
    
    // 
    $('.dateCalendar').datepicker({
       minDate: new Date()
    });
    
    
    // Code for the click event on the scheduling the code
    $('input:radio[name="action"]').on('change', function(){
        if ($('#optionsRadios1').is(':checked')) {
            $('#showOnlySchedule').show();
             $('#showOnSchedule').show();
             
        }else if ($('#optionsRadios2').is(':checked')){
            $('#showOnlySchedule').hide();
             $('#showOnSchedule').show();
        }else if ($('#optionsRadios4').is(':checked')){
            $('#timeOnSchedule').hide();
            $('#showOnlySchedule').show();
             $('#showOnSchedule').show();
        }else if ($('#optionsRadios5').is(':checked')){
            $('#showOnlySchedule').hide();
             $('#showOnSchedule').show();
        }else{
             $('#showOnSchedule').hide();
         }
    });
    
    // code for the close fisrt pop-up & open another pop-up
    $(document).on('click', '.closePop', function(event) {
        event.preventDefault();
        $.magnificPopup.close();
    });
    /* --------------------------------- End of Appointment Followup Code ------------------------------------ */
    
});
// Code for the common default-datatables
(function($) {

    'use strict';

    var datatableInit = function() {

        $('#datatable-default').dataTable();

    };

    $(function() {
        datatableInit();
    });

}).apply(this, [jQuery]);

//code for the delete confirmation pop-up 
   $(function(){
   $('.confirmation-callback').confirmation({
        
		onConfirm: function() {        
			var link = $(this).attr('href');
              
                        window.location = ajax_url+link;
		}
	});     
        
    $("#addAppointment").on("submit", function(event) {
        var count = 0;
        $('.commentdiv .error').remove();
        if($('#addAppointment').find('#patientMainDiv').is(':visible')){
            if ($("#patient_id").val() === undefined || $("#patient_id").val() === "")
                 {
                     $('#patient_id').parent(".commentdiv").append('<span class="help-block comment error"><strong>Please Select Patient</strong></span>');                                   
                         count = count + 1;
                 } 
        }
       
        if (count > 0) {
            return false;
        }
        return true;
            
       
    });
   });
   
   	/*
        Form-wizard for the patient medical Wizard 
	*/
	var $w3finish = $('#w3').find('ul.pager li.finish'),
		$w3validator = $("#w3 form").validate({
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
			$(element).remove();
		},
		errorPlacement: function( error, element ) {
			element.parent().append( error );
		}
	});

	$w3finish.on('click', function( ev ) {
		ev.preventDefault();
		var validated = $('#w3 form').valid();
		if ( validated ) {
			new PNotify({
				title: 'Congratulations',
				text: 'You completed the wizard form.',
				type: 'custom',
				addclass: 'notification-success',
				icon: 'fa fa-check'
			});
		}
	});

	$('#w3').bootstrapWizard({
		tabClass: 'wizard-steps',
		nextSelector: 'ul.pager li.next',
		previousSelector: 'ul.pager li.previous',
		firstSelector: null,
		lastSelector: null,
		onNext: function( tab, navigation, index, newindex ) {
			var validated = $('#w3 form').valid();
			if( !validated ) {
				$w3validator.focusInvalid();
				return false;
			}
		},
		onTabClick: function( tab, navigation, index, newindex ) {
			if ( newindex == index + 1 ) {
				return this.onNext( tab, navigation, index, newindex);
			} else if ( newindex > index + 1 ) {
				return false;
			} else {
				return true;
			}
		},
		onTabChange: function( tab, navigation, index, newindex ) {
			var $total = navigation.find('li').size() - 1;
			$w3finish[ newindex != $total ? 'addClass' : 'removeClass' ]( 'hidden' );
			$('#w3').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]( 'hidden' );
		},
		onTabShow: function( tab, navigation, index ) {
			var $total = navigation.find('li').length - 1;
			var $current = index;
			var $percent = Math.floor(( $current / $total ) * 100);
			$('#w3').find('.progress-indicator').css({ 'width': $percent + '%' });
			tab.prevAll().addClass('completed');
			tab.nextAll().removeClass('completed');
		}
	});
