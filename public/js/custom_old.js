/*
 Name: 			Theme Base
 Written by: 	Okler Themes - (http://www.okler.net)
 Theme Version: 	1.4.1
 */


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
                    {
                        sExtends: 'xls',
                        sButtonText: 'Excel'
                    },
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

$(document).ready(function() {
    $('#external-events').hide();

    $(document).on("click", ".edit-row", function(ev) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "./editappointment",
            data: {"id": $(this).parent().siblings(":first").text()},
            success: function(response) {
                var combine = JSON.parse(response);
                $('#appointment_id').val(combine.appointment.id);
                $('select[name="patient_id"] option[value="' + combine.patient.id + '"]').attr('selected', 'selected');
                $('select[name="doctor_id"] option[value="' + combine.doctor.id + '"]').attr('selected', 'selected');
                $('textarea[name="comment"]').val(combine.appointment.comment);
                $('#first-name').val(combine.patient.firstName);
                $('#last-name').val(combine.patient.lastName);
                $('#email').val(combine.patient.email);
                $('#phone').val(combine.patient.phone);
                $('#address1').val(combine.patient.address1);
                $('input:radio[name="gender"][value="' + combine.patient.gender + '"]').prop('checked', true);
                $('input[data-plugin-datepicker]').datepicker('setDate', moment(combine.appointment.apptTime).format('MM/DD/YYYY'));
                $('input[data-plugin-timepicker]').timepicker('setTime', moment(combine.appointment.apptTime).format('hh:mm A'));
                $('#dob').datepicker('setDate', moment(combine.patient.dob).format('MM/DD/YYYY'));

            }
        });

        $.magnificPopup.open({
            items: {
                src: '#modalForm',
                type: 'inline'
            }
        });

    });


    $(document).on("click", ".remove-row", function(ev) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#dialogConfirm').val($(this).parent().siblings(":first").text());


        $.magnificPopup.open({
            items: {
                src: '#dialog',
                type: 'inline'
            }
        });

    });

    $('#dialogCancel').click(function()
    {
        location.reload();
    });

    $(document).on("click", "#dialogConfirm", function(ev) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "./deleteappointment",
            data: {"id": $('#dialogConfirm').val()},
            success: function(response) {
                console.log(response);
                location.reload();
            }
        });
    });


    $(document).on("click", ".fc-event-inner", function(ev) {
        var text = $(this).text().substring($(this).text().indexOf('#') + 1);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "./editappointment",
            data: {"id": text},
            success: function(response) {
                var combine = JSON.parse(response);
                $('#appointment_id').val(combine.appointment.id);
                $('select[name="patient_id"] option[value="' + combine.patient.id + '"]').attr('selected', 'selected');
                $('select[name="doctor_id"] option[value="' + combine.doctor.id + '"]').attr('selected', 'selected');
                $('textarea[name="comment"]').val(combine.appointment.comment);
                $('#first-name').val(combine.patient.firstName);
                $('#last-name').val(combine.patient.lastName);
                $('#email').val(combine.patient.email);
                $('#phone').val(combine.patient.phone);
                $('#address1').val(combine.patient.address1);
                $('input:radio[name="gender"][value="' + combine.patient.gender + '"]').prop('checked', true);
                $('input[data-plugin-datepicker]').datepicker('setDate', moment(combine.appointment.apptTime).format('MM/DD/YYYY'));
                $('input[data-plugin-timepicker]').timepicker('setTime', moment(combine.appointment.apptTime).format('hh:mm A'));
                $('#dob').datepicker('setDate', moment(combine.patient.dob).format('MM/DD/YYYY'));
            }
        })
        //alert(text);

        $.magnificPopup.open({
            items: {
                src: '#modalForm',
                type: 'inline'
            }
        });

    });

    $(".modal-confirm").click(function(event) {
        event.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "./saveappointment",
            data: $('form.form-horizontal').serialize(),
            success: function(msg) {
                //alert(msg);

                $("#form-content").modal('hide');
                $.magnificPopup.close({
                    items: {
                        src: '#modalForm',
                        type: 'inline'
                    }
                });
                location.reload();
            },
            error: function() {
                alert("failure");
            }
        });
    });


    $(".modal-dismiss").click(function(event) {
        event.preventDefault();
        location.reload();
    });
    
});