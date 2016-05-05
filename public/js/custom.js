/*
 Name: 			Theme Base
 Written by: 	Okler Themes - (http://www.okler.net)
 Theme Version: 	1.4.1
 */
$(document).ready(function() {
    $('#external-events').hide();
    $('select.chosen').chosen();
    /*
     * Below functions are called for add appointment.
     */
    $('input[data-plugin-datepicker]').datepicker('setDate', moment().format('MM/DD/YYYY'));
    var i = 1;
    var j = 1;
    $("#addAppPatient").click(function() {
        if (i == 1)
        {
//                    $('#patient_come').append('  <div class="form-group"> <label for="firstName" class="col-sm-4 control-label">First Name</label>  <div class="col-sm-6"> <input type="hidden" name="id"> <input type="text" name="firstName" id="first-name" class="form-control" placeholder="First Name" value="{{ old('firstName') }}"> <span class="help-block firstName"></span>	 </div> </div> <div class="form-group"> <label for="lastName" class="col-sm-4 control-label">Last Name</label> <div class="col-sm-6"> <input type="text" name="lastName" id="last-name" class="form-control" placeholder="Last Name" value="{{ old('lastName') }}"> <span class="help-block lastName"></span>	</div> </div> <div class="form-group"> <label for="email" class="col-sm-4 control-label">Email</label> <div class="col-sm-6"> <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}"> <span class="help-block email"></span>	 </div> </div> <div class="form-group"> <label for="status" class="col-sm-4 control-label">Status</label> <div class="col-sm-6"> <input type="text" name="status" id="status" class="form-control" placeholder="Status" value="{{ old('status') }}"> </div> </div> <div class="form-group"> <label for="phone" class="col-sm-4 control-label">Phone</label> <div class="col-sm-6"> <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}"> </div> </div> <div class="form-group"> <label for="phone" class="col-sm-4 control-label">Date</label> <div class="col-md-6"> <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span> <input type="text" name="dob" data-plugin-datepicker class="form-control" value="{{ old('dob') }}"> </div> @if ($errors->has('dob')) <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> </span> @endif </div> </div> <div class="form-group"> <label class="col-sm-4 control-label">Gender</label> <div class="col-sm-6"> <div class="col-sm-3"> <div class="radio-custom radio-primary"> <input id="awesome" name="gender" type="radio" value="awesome" checked="true" required /> <label for="awesome">Male</label> </div> </div> <div class="col-sm-3"> <div class="radio-custom radio-primary"> <input id="very-awesome" name="gender" type="radio" value="very-awesome" /> <label for="very-awesome">Female</label> </div> </div> </div> </div> <div class="form-group"> <label for="address1" class="col-sm-4 control-label">Primary Address</label> <div class="col-sm-6"> <textarea name="address1" id="address1" class="form-control" rows="3" placeholder="Primary Address">{{ old('address1') }}</textarea> </div> </div> <div class="form-group"> <label for="address2" class="col-sm-4 control-label">Secondary Address</label> <div class="col-sm-6"> <textarea name="address2" id="address2" class="form-control" rows="3" placeholder="Primary Address">{{ old('address2') }}</textarea> </div> </div> <div class="form-group"> <label for="city" class="col-sm-4 control-label">City</label> <div class="col-sm-6"> <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{ old('city') }}"> </div> </div> <div class="form-group"> <label for="state" class="col-sm-4 control-label">State</label> <div class="col-sm-6"> <input type="text" name="state" id="state" class="form-control" placeholder="State" value="{{ old('state') }}"> </div> </div> <div class="form-group"> <label for="zipCode" class="col-sm-4 control-label">Zip Code</label> <div class="col-sm-6"> <input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip Code" value="{{ old('zipCode') }}"> </div> </div> <div class="form-group"> <label for="employer" class="col-sm-4 control-label">Employer</label> <div class="col-sm-6"> <input type="text" name="employer" id="employer" class="form-control" placeholder="Employer" value="{{ old('text') }}"> </div> </div> <div class="form-group"> <label for="occupation" class="col-sm-4 control-label">Occupation</label> <div class="col-sm-6"> <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation" value="{{ old('occupation') }}"> </div> </div>');
            //$('#patient_come').append('  <div class="form-group"> <label for="firstName" class="col-sm-4 control-label">First Name</label> <div class="col-sm-6"> <input type="hidden" name="id"> <input type="text" name="firstName" id="first-name" class="form-control" placeholder="First Name" value="{{ old('firstName') }}"> <span class="help-block firstName"></span> </div> </div> <div class="form-group"> <label for="lastName" class="col-sm-4 control-label">Last Name</label> <div class="col-sm-6"> <input type="text" name="lastName" id="last-name" class="form-control" placeholder="Last Name" value="{{ old('lastName') }}"> <span class="help-block lastName"></span></div> </div> <div class="form-group"> <label for="email" class="col-sm-4 control-label">Email</label> <div class="col-sm-6"> <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}"> <span class="help-block email"></span> </div> </div> <div class="form-group"> <label for="phone" class="col-sm-4 control-label">Phone</label> <div class="col-sm-6"> <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}"> </div> </div> <div class="form-group"> <label for="phone" class="col-sm-4 control-label">Date</label> <div class="col-md-6"> <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span> <input type="text" name="dob" data-plugin-datepicker class="form-control" value="{{ old('dob') }}"> </div> @if ($errors->has('dob')) <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> </span> @endif </div> </div> <div class="form-group"> <label class="col-sm-4 control-label">Gender</label> <div class="col-sm-6"> <div class="col-sm-3"> <div class="radio-custom radio-primary"> <input id="awesome" name="gender" type="radio" value="Male" checked="true" required /> <label for="awesome">Male</label> </div> </div> <div class="col-sm-3"> <div class="radio-custom radio-primary"> <input id="very-awesome" name="gender" type="radio" value="Female" /> <label for="very-awesome">Female</label> </div> </div> </div> </div> <div class="form-group"> <label for="address1" class="col-sm-4 control-label">Primary Address</label> <div class="col-sm-6"> <textarea name="address1" id="address1" class="form-control" rows="3" placeholder="Primary Address">{{ old('address1') }}</textarea> </div> </div> ');
            $('#patient_come').show();
            $('input[data-plugin-datepicker]').datepicker('setDate', moment().format('MM/DD/YYYY'));
            $('#patient_id').val('');
            $('#addAppPatient').html('Del Patient <i class="fa fa-minus"></i>');
            $('.patient_id').hide();
            i = 2;
        } else
        {
            $('#patient_come').hide();
            $('.patient_id').show();
            $("#patient_id").prop("selectedIndex", 1);
            $('#addAppPatient').html('Add Patient <i class="fa fa-plus"></i>');
            //$("#patient_id option:first").attr('selected','selected');
            i = 1;
        }
        return false;
    });

    $(".add-appointment").on("submit", function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if ($("#patient_id").val() === null)
        {
            if ($("#first-name").val() === "" || $("#last-name").val() === "" || $("#email").val() === "" || $("#commentid").val().trim() === "")
            {
                if ($("#first-name").val() === "")
                {
                    $(".firstName").html('<strong style="color:#a94442;">The First Name field is required.</strong>');
                    $("#first-name").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                }
                if ($("#last-name").val() === "")
                {
                    $(".lastName").html('<strong style="color:#a94442;">The Last Name field is required.</strong>');
                    $("#last-name").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                }
                if ($("#email").val() === "")
                {
                    $(".email").html('<strong style="color:#a94442;">The Email field is required.</strong>');
                    $("#email").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                }

                if ($("#commentid").val().trim() === "")
                {
                    if (j == 1 && $("#commentid").val().trim() === "")
                    {
                        $(".commentdiv").append('<span class="help-block comment"><strong style="color:#a94442;">The Comment field is required.</strong></span>');
                        $("#commentid").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                        j = 2;
                    }

                }
                return false;
            } else
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "../uniquePatientEmail",
                    data: {'email': $("#email").val()},
                    success: function(response) {
                        if (response === "Found")
                        {
                            $(".email").html('<strong style="color:#a94442;">The Email already exist.</strong>');
                            $("#email").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                            return false;
                        } else {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: "POST",
                                url: "../editpatientappointment",
                                data: $('form.form-horizontal').serialize(),
                                success: function(response) {
                                    //console.log("Come");    
                                    //console.log(response);
                                    var url = document.location.href;
                                    shortURL = url.substring(0, url.lastIndexOf("/"));
                                    lastURL  = shortURL.substring(0, shortURL.lastIndexOf("/")) + '/listappointment';
                                    window.location.href = lastURL;
                                    return false;
                                }
                            });
                        }
                    }
                });
            }
            return false;
        } else
        {

        }

        //Code: Action (like ajax...)
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

        $.ajax({
            type: "POST",
            url: "./editappointment",
            data: {"id": $(this).parent().siblings(":first").text()},
            success: function(response) {
                var combine = JSON.parse(response);
                $('#appointment_id').val(combine.appointment.id);
                $("#patient_id").val(combine.patient.id).attr('selected', 'selected').trigger("chosen:updated");
                ;
                $("#doctor_id").val(combine.doctor.id).attr('selected', 'selected').trigger("chosen:updated");
                ;
                $('input[name=doctor_id]').val(combine.doctor.id);
                $('input[name=patient_id]').val(combine.patient.id);
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

    $('.list-edit').on('change', function() {
        alert(this.value);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    })

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
                $("#patient_id").val(combine.patient.id).attr('selected', 'selected').trigger("chosen:updated");
                ;
                $("#doctor_id").val(combine.doctor.id).attr('selected', 'selected').trigger("chosen:updated");
                ;
                $('input[name=doctor_id]').val(combine.doctor.id);
                $('input[name=patient_id]').val(combine.patient.id);
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
            url: "../saveappointment",
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

    /*
     * Add Patient From View
     */
    $(".modal-add-appointment").click(function(event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if ($("#patient_id").val() === null)
        {
            if ($("#first-name").val() === "" || $("#last-name").val() === "" || $("#email").val() === "" || $("#commentid").val().trim() === "")
            {
                if ($("#first-name").val() === "")
                {
                    $(".firstName").html('<strong style="color:#a94442;">The First Name field is required.</strong>');
                    $("#first-name").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                }
                if ($("#last-name").val() === "")
                {
                    $(".lastName").html('<strong style="color:#a94442;">The Last Name field is required.</strong>');
                    $("#last-name").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                }
                if ($("#email").val() === "")
                {
                    $(".email").html('<strong style="color:#a94442;">The Email field is required.</strong>');
                    $("#email").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                }

                if ($("#commentid").val().trim() === "")
                {
                    if (j == 1 && $("#commentid").val().trim() === "")
                    {
                        $(".commentdiv").append('<span class="help-block comment"><strong style="color:#a94442;">The Comment field is required.</strong></span>');
                        $("#commentid").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                        j = 2;
                    }

                }
                return false;
            } else
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "./uniquePatientEmail",
                    data: {'email': $("#email").val()},
                    success: function(response) {
                        if (response === "Found")
                        {
                            $(".email").html('<strong style="color:#a94442;">The Email already exist.</strong>');
                            $("#email").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                            return false;
                        } else {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: "POST",
                                url: "./editpatientappointment",
                                data: $('form.add-appointment-submit').serialize(),
                                success: function(msg) {
                                    //alert(msg);

                                    $("#form-content").modal('hide');
                                    $.magnificPopup.close({
                                        items: {
                                            src: '#modal-add-view-appointment',
                                            type: 'inline'
                                        }
                                    });
                                    location.reload();
                                },
                                error: function() {
                                    alert("failure");
                                }
                            });
                        }
                    }
                });
            }
            return false;
        } else
        {
            if ($("#commentid").val().trim() === "")
                {
                    if (j == 1 && $("#commentid").val().trim() === "")
                    {
                        $(".commentdiv").append('<span class="help-block comment"><strong style="color:#a94442;">The Comment field is required.</strong></span>');
                        $("#commentid").css({"border-color": "#a94442", "border-width": "1px", "border-style": "solid"});
                        j = 2;
                    }
                    return false;
                }
            else    
            $(".add-appointment-submit").submit();
        }


        /*
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
         }); */
    });



    $(".modal-dismiss").click(function(event) {
        event.preventDefault();
        location.reload();
    });



});


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
