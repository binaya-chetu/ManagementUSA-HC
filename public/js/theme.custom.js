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