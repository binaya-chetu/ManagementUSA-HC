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
        ignore:  ".ignore",
        rules: {
            payment_bill: {
                extension: "jpg|gif|png|pdf|doc|docx|csv|xls"
            },
            email: {
              required: true,
              email: true,
              remote: ajax_url+ "/appointment/uniquePatientEmail"
            },
            phone: {
                minlength: 14
            }
        },
        messages:{
              email: {
                  remote: 'Email already exists in database'
              },
              phone: {
                  minlength: 'Please enter at least 10 digits.'
              }
        }
    });
    
    // common validation for add/edit doctor.
    jQuery('#doctor').validate({  
        ignore:  ".ignore",
        rules : {
            password : {
                minlength : 6
            },
            password_confirmation : {
                minlength : 6,
                equalTo : "#password"
            },
            email: {
              required: true,
              email: true,
              remote: ajax_url+ "/appointment/uniquePatientEmail"
            },
            phone: {
                minlength: 14
            }
        },
        messages:{
              email: {
                  remote: 'Email already exists in database'
              },
              phone: {
                  minlength: 'Please enter at least 10 digits.'
              }
        }
    });
    
    // common validation for add/edit roles.
    $('#addRole').validate();
    
    // common validation for add/edit users.
    jQuery('#addUser').validate({

        ignore:  ".ignore",

       rules : {
            password : {
                minlength : 6
            },
            password_confirmation : {
                minlength : 6,
                equalTo : "#password"
            },
            email: {
              required: true,
              email: true,
              remote: ajax_url+ "/appointment/uniquePatientEmail"
            },
            phone: {
                minlength: 14
            }
        },
        messages:{
              email: {
                  remote: 'Email already exists in database'
              },
              phone: {
                  minlength: 'Please enter at least 10 digits'
              }
        }
    });
	
    //validation for followup pop-up form.
    $('#followUp').validate();
    
    //validation for followup pop-up form.
    $('#newCategory').validate();
    
    // Validation for Inventory Imports form
    $('#inventory_imports').validate();
    
    //Validate the trimix feedback form
     $('#storeFeedback').validate();
    
    //validation for followup pop-up form.
    $('#editAppointment').validate({
          rules: {
            email: {
              required: true,
              email: true,
              remote: ajax_url+ "/appointment/uniquePatientEmail"
            },
            phone: {
                minlength: 14
            }
          },
          messages:{
              email: {
                  remote: 'Email already exist in database'
              },
              phone: {
                  minlength: 'Please enter at least 10 digits.'
              }
          }
    });
    
    $('#addAppointment').validate({
          rules: {
            email: {
              required: true,
              email: true,
              remote: ajax_url+ "/appointment/uniquePatientEmail"
            },
            phone: {
                minlength: 14
            }
          },
          messages:{
              email: {
                  remote: 'Email already exist in database'
              },
              phone: {
                  minlength: 'Please enter at least 10 digits.'
              }
          }
    });
   
    $('#cashVoucher').validate();
   
    // Set the calendar start date as today Date
    $('.selectDate').datepicker({
        startDate: today
    });
    $('#patientdob').datepicker({
       endDate: new Date()
    });
    $('#dob').datepicker({
       endDate: new Date()
    });
    $('#voucherDate').datepicker({
        endDate: new Date()
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
        }else if ($('#optionsRadios5').is(':checked')){
         
            $('#timeOnSchedule').hide();
            $('#showOnlySchedule').show();
             $('#showOnSchedule').show();
        }else if ($('#optionsRadios4').is(':checked')){
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
    
    
    /* -------------- Ajax Code for permission settiing-------------------------------------- */
    
     $(".permission_status").click(function(){ 
                
                var roleId = $(this).find('.check_permission').attr('role_id');
                var permissionId = $(this).find('.check_permission').attr('permission_id');
                var status;
                
                if($(this).find('.check_permission').is(':checked'))
                {
                     status = 1;
                }
                else
                {
                     status = 0;
                }
                
                $.ajaxSetup({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post("./updatePermission",
                {
                   data: {"status": status, "roleId": roleId, "permissionId": permissionId},
                },
               function(data, status){    
                   
                });
            });
            
            $('.panel-custom').on('click', function(){
               $(this).find('.fa').toggleClass('fa-minus'); 
            });
            
            /* ---------------------End Here ------------------------*/
            
        /*----------------------------Ajax Code for change user status -------------------------*/
         $(".user_status").click(function(){ 
                
                var userId = $(this).find('.check_div').attr('user_id');
                var status;
                if($(this).find('.check_div').is(':checked'))
                {
                     status = 1;
                }
                else
                {
                     status = 0;
                }
                
                $.ajaxSetup({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post("./updateUserStatus",
                {
                    data: { "status": status, "userId": userId },
                },
               function(data, status){    
                    
                });
              
              //$(this).toggleClass("on");
            });
            /* ----------------------- End Here ------------------------------*/
    
});
// Code for the common default-datatables
(function($) {

    'use strict';

    var datatableInit = function() {

        $('#datatable-default').dataTable({
            aoColumnDefs : [{
                orderable : false, aTargets : [0] //disable sorting for the 1st column
                }], 
            order : []
        });

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
    
	$(document).on('click', '.confirmation-callback', function(){
		$(this).confirmation('show');
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

    $("#addApptRequest").on("submit", function(event) {
        var count = 0;
        $('.commentdiv .error').remove();
        if($('#addApptRequest').find('#patientMainDiv').is(':visible')){
            if ($("#patient_id").val() === undefined || $("#patient_id").val() === "")
                 {
                     if( $("#patientMainDiv").find('span.comment').length == 0){
                         $('#patient_id').parent("#patientMainDiv").append('<span class="help-block comment error"><strong>Please Select Patient</strong></span>');                                                           
                     }
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
                    $('#patientMedical').submit();
//			new PNotify({
//				title: 'Congratulations',
//				text: 'You completed the wizard form.',
//				type: 'custom',
//				addclass: 'notification-success',
//				icon: 'fa fa-check'
//			});
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
$('.phone').usphone();   
$('#durationExample').timepicker({
        'minTime': '09:00am',
        'maxTime': '05:00pm',
        'showDuration': true
    });   
    
 /*
  * Jquery to sum the column price and display in footer for sales report module. 
  */   
    $(document).ready(function() {
        var $table = $('#sales_report');
        $table.dataTable( {
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
    //            total = api
    //                .column( 6 )
    //                .data()
    //                .reduce( function (a, b) {
    //                    return intVal(a) + intVal(b);
    //                } );

                // Total price over this page
                priceTotal = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Total price over this page
                discountTotal = api
                    .column( 7, { page: 'current'} )
                    .data()
                    .reduce( function (c, d) {
                        return intVal(c) + intVal(d);
                    }, 0 );

                // Total Amount over this page
                totalAmount = api
                    .column( 8, { page: 'current'} )
                    .data()
                    .reduce( function (e, f) {
                        return intVal(e) + intVal(f);
                    }, 0 );

                // Update footer
                $( api.column( 6 ).footer() ).html(
                    '$'+priceTotal
                );
                $( api.column( 7 ).footer() ).html(
                    '$'+discountTotal
                );
                $( api.column( 8 ).footer() ).html(
                    '$'+totalAmount
                );
            },
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
        } );
    } );


/*
  * Jquery to sum the column price and display in footer for Petty Cash Logs. 
  */   
    $(document).ready(function() {
        var $table = $('#pettyCashLogs');
        $table.dataTable( {
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
    //            total = api
    //                .column( 6 )
    //                .data()
    //                .reduce( function (a, b) {
    //                    return intVal(a) + intVal(b);
    //                } );

                // Total price over this page
                priceTotal = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(b);
                    }, 0 );

                // Update footer
                $( api.column( 6 ).footer() ).html(
                    '$'+priceTotal
                );
            },
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
        } );
    } );
