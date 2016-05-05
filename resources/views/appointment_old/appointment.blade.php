@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap-timepicker/css/bootstrap-timepicker.css') }}">
<script src="{{ URL::asset('vendor/fullcalendar/lib/moment.min.js') }}"></script>
<script src="{{ URL::asset('vendor/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>	
<script src="{{ URL::asset('js/custom.js') }}"></script>

<script>
$(document).ready(function() {
    $('input[data-plugin-datepicker]').datepicker('setDate', moment().format('MM/DD/YYYY'));
    var i = 1;
    var j = 1;
    $("#addAppPatient").click(function() {
        if (i == 1)
        {
//                    $('#patient_come').append('  <div class="form-group"> <label for="firstName" class="col-sm-4 control-label">First Name</label>  <div class="col-sm-6"> <input type="hidden" name="id"> <input type="text" name="firstName" id="first-name" class="form-control" placeholder="First Name" value="{{ old('firstName') }}"> <span class="help-block firstName"></span>	 </div> </div> <div class="form-group"> <label for="lastName" class="col-sm-4 control-label">Last Name</label> <div class="col-sm-6"> <input type="text" name="lastName" id="last-name" class="form-control" placeholder="Last Name" value="{{ old('lastName') }}"> <span class="help-block lastName"></span>	</div> </div> <div class="form-group"> <label for="email" class="col-sm-4 control-label">Email</label> <div class="col-sm-6"> <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}"> <span class="help-block email"></span>	 </div> </div> <div class="form-group"> <label for="status" class="col-sm-4 control-label">Status</label> <div class="col-sm-6"> <input type="text" name="status" id="status" class="form-control" placeholder="Status" value="{{ old('status') }}"> </div> </div> <div class="form-group"> <label for="phone" class="col-sm-4 control-label">Phone</label> <div class="col-sm-6"> <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}"> </div> </div> <div class="form-group"> <label for="phone" class="col-sm-4 control-label">Date</label> <div class="col-md-6"> <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span> <input type="text" name="dob" data-plugin-datepicker class="form-control" value="{{ old('dob') }}"> </div> @if ($errors->has('dob')) <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> </span> @endif </div> </div> <div class="form-group"> <label class="col-sm-4 control-label">Gender</label> <div class="col-sm-6"> <div class="col-sm-3"> <div class="radio-custom radio-primary"> <input id="awesome" name="gender" type="radio" value="awesome" checked="true" required /> <label for="awesome">Male</label> </div> </div> <div class="col-sm-3"> <div class="radio-custom radio-primary"> <input id="very-awesome" name="gender" type="radio" value="very-awesome" /> <label for="very-awesome">Female</label> </div> </div> </div> </div> <div class="form-group"> <label for="address1" class="col-sm-4 control-label">Primary Address</label> <div class="col-sm-6"> <textarea name="address1" id="address1" class="form-control" rows="3" placeholder="Primary Address">{{ old('address1') }}</textarea> </div> </div> <div class="form-group"> <label for="address2" class="col-sm-4 control-label">Secondary Address</label> <div class="col-sm-6"> <textarea name="address2" id="address2" class="form-control" rows="3" placeholder="Primary Address">{{ old('address2') }}</textarea> </div> </div> <div class="form-group"> <label for="city" class="col-sm-4 control-label">City</label> <div class="col-sm-6"> <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{ old('city') }}"> </div> </div> <div class="form-group"> <label for="state" class="col-sm-4 control-label">State</label> <div class="col-sm-6"> <input type="text" name="state" id="state" class="form-control" placeholder="State" value="{{ old('state') }}"> </div> </div> <div class="form-group"> <label for="zipCode" class="col-sm-4 control-label">Zip Code</label> <div class="col-sm-6"> <input type="text" name="zipCode" id="zipCode" class="form-control" placeholder="Zip Code" value="{{ old('zipCode') }}"> </div> </div> <div class="form-group"> <label for="employer" class="col-sm-4 control-label">Employer</label> <div class="col-sm-6"> <input type="text" name="employer" id="employer" class="form-control" placeholder="Employer" value="{{ old('text') }}"> </div> </div> <div class="form-group"> <label for="occupation" class="col-sm-4 control-label">Occupation</label> <div class="col-sm-6"> <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation" value="{{ old('occupation') }}"> </div> </div>');
        $('#patient_come').append('  <div class="form-group"> <label for="firstName" class="col-sm-4 control-label">First Name</label> <div class="col-sm-6"> <input type="hidden" name="id"> <input type="text" name="firstName" id="first-name" class="form-control" placeholder="First Name" value="{{ old('firstName') }}"> <span class="help-block firstName"></span> </div> </div> <div class="form-group"> <label for="lastName" class="col-sm-4 control-label">Last Name</label> <div class="col-sm-6"> <input type="text" name="lastName" id="last-name" class="form-control" placeholder="Last Name" value="{{ old('lastName') }}"> <span class="help-block lastName"></span></div> </div> <div class="form-group"> <label for="email" class="col-sm-4 control-label">Email</label> <div class="col-sm-6"> <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}"> <span class="help-block email"></span> </div> </div> <div class="form-group"> <label for="phone" class="col-sm-4 control-label">Phone</label> <div class="col-sm-6"> <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}"> </div> </div> <div class="form-group"> <label for="phone" class="col-sm-4 control-label">Date</label> <div class="col-md-6"> <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span> <input type="text" name="dob" data-plugin-datepicker class="form-control" value="{{ old('dob') }}"> </div> @if ($errors->has('dob')) <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> </span> @endif </div> </div> <div class="form-group"> <label class="col-sm-4 control-label">Gender</label> <div class="col-sm-6"> <div class="col-sm-3"> <div class="radio-custom radio-primary"> <input id="awesome" name="gender" type="radio" value="Male" checked="true" required /> <label for="awesome">Male</label> </div> </div> <div class="col-sm-3"> <div class="radio-custom radio-primary"> <input id="very-awesome" name="gender" type="radio" value="Female" /> <label for="very-awesome">Female</label> </div> </div> </div> </div> <div class="form-group"> <label for="address1" class="col-sm-4 control-label">Primary Address</label> <div class="col-sm-6"> <textarea name="address1" id="address1" class="form-control" rows="3" placeholder="Primary Address">{{ old('address1') }}</textarea> </div> </div> ');
                $('input[data-plugin-datepicker]').datepicker('setDate', moment().format('MM/DD/YYYY'));
        $('#patient_id').val('');
        $('#addAppPatient').html('Del Patient <i class="fa fa-minus"></i>');
        $('#patient_id').hide();
        i = 2;
    } else
    {
        $('#patient_come').empty();
        $('#patient_id').show();
        $("#patient_id").prop("selectedIndex", 1);
        $('#addAppPatient').html('Add Patient <i class="fa fa-plus"></i>');
        //$("#patient_id option:first").attr('selected','selected');
        i = 1;
    }
    return false;
});
$(".form-horizontal").on("submit", function() {
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
                if (j == 1)
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
                            data: $('form.form-horizontal').serialize(),
                            success: function(response) {
                                //console.log("Come");    
                                //console.log(response);
                                window.location.href = '{{url("/listappointment")}}';
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
})
});
</script>    
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Create Appointment</h2>

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

    <div class="row">

        <div class="col-md-12">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/addappointment') }}">
                {!! csrf_field() !!}
                <section class="panel panel-primary">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                            <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                        </div>
                        <h2 class="panel-title">Create Appointment</h2>
                    </header>

                    <div class="panel-body">


                        <div class="form-group{{ $errors->has('appDate') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Choose Date & Time</label>

                            <div class="col-md-3">

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="appDate" data-plugin-datepicker class="form-control" value="{{ old('appDate') }}">

                                </div>
                                @if ($errors->has('appDate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('appDate') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    <input type="text" name="appTime" data-plugin-timepicker class="form-control">
                                </div>
                            </div>
                            <input type="hidden"  name="marketer" value="1">
                            <input type="hidden"  name="status" value="Not Required">
                            <input type="hidden"  name="createdBy" value="{{ Auth::user()->id }}">
                            <input type="hidden"  name="lastUpdatedBy" value="{{ Auth::user()->id }}">
                        </div>   

                        <div class="form-group{{ $errors->has('doctor_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Doctor</label>

                            <div class="col-md-6">
                                <select  class="form-control" name="doctor_id">
                                    <option value="" disabled>Choose Doctor</option>
                                    @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->firstName }} {{ $doctor->lastName }}</option>
                                    @endforeach


                                </select>    
                                @if ($errors->has('patient_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('doctor_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Patient</label>

                            <div class="col-md-4">
                                <select  class="form-control" name="patient_id" id="patient_id">
                                    <option value="" disabled>Choose Patient</option>
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

                            <div class="col-sm-2">
                                <div class="mb-md">
                                    <button id="addAppPatient" data-token="{{ csrf_token() }}" class="btn btn-primary" style="background: #428bca">Add Patient <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <div id="patient_come">

                        </div><br/>



                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Comment</label>
                            <div class="col-md-6 commentdiv">
                                <textarea  class="form-control" name="comment" id="commentid">{{ old('comment') }}</textarea>

                                @if ($errors->has('comment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <footer class="panel-footer">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Add Appointment
                                </button>
                            </div>
                        </div>

                    </footer>	
                </section>
            </form>

        </div>
    </div>
</section>    
@endsection
