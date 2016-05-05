var ajax_url = window.location.origin;
/* Add here all your JS customizations */
$(function() {
    // setTimeout() function will be fired after page is loaded
    // it will wait for 5 sec. and then will fire
    // $("#successMessage").hide() function

    // timeout for alert message
    setTimeout(function() {
        $('.alert').css('display', 'none');
    }, 8000);


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
    $('#addRole').validate({
        
    });

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
//		onCancel: function() {
//			alert('Some error occured to delete' );
//		}
	});      
   });