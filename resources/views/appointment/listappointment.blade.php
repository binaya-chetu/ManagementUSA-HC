@extends('layouts.common')

@section('content')

@include('appointment.viewHeader')

<section role="main" class="content-body">
    <header class="page-header">
        <h2>List Appointments</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>List Appointments</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">List Appointments</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a href="{{ url('/appointment/1') }}"><button id="addToTable" class="btn btn-primary" style="background: #428bca">Add <i class="fa fa-plus"></i></button></a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>App Date and Time</th>
                        <th>Status</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ $appointment->id }}</div></td>
                        <td class="table-text"><div>{{ $appointment->apptTime }}</div></td>
                        <td class="table-text"><div>{{ $appointment->status }}</div></td>
                        <td class="table-text"><div>{{ $appointment->patient->firstName }} {{ $appointment->patient->lastName }}</div></td>
                        <td class="table-text"><div>{{ $appointment->doctor->firstName }} {{ $appointment->doctor->lastName }}</div></td>
                        <td class="table-text"><div>{{ $appointment->comment }}</div></td>
                        <td class="actions">
                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                            <a href="javascript:void(0)" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </section>
</section>
<div id="dialog" class="modal-block mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Are you sure?</h2>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <p>Are you sure that you want to delete this row?</p>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button id="dialogConfirm" class="btn btn-primary" value="10">Confirm</button>
                    <button id="dialogCancel" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
</div>
<!-- Modal Form -->
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/saveappointment') }}">   
        {!! csrf_field() !!}
        <section class="panel panel-primary">
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
                        <select  class="form-control chosen" id="doctor_id" name="doctor_id" disabled="true">
                            <option value="" disabled>Choose Doctor</option>
                            @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->firstName }} {{ $doctor->lastName }}</option>
                            @endforeach


                        </select>    
                        <input type="hidden" name="doctor_id">
                        @if ($errors->has('doctor_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('doctor_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}" >
                    <label class="col-md-4 control-label">Patient</label>

                    <div class="col-md-6">
                        <select  class="form-control chosen" id="patient_id" name="patient_id" style="width:100%;" disabled="true">
                             <option value="" disabled>Choose Patient</option>
                            @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->firstName }} {{ $patient->lastName }}</option>
                            @endforeach

                            <input type="hidden"  name="clinic" value="{{ Auth::user()->id }}">
                        </select>    
                        <input type="hidden" name="patient_id">
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
                        <textarea name="address1" id="address1" class="form-control" rows="3" placeholder="Primary Address">{{ old('address1') }}</textarea> 
                    </div> 
                </div> 
                <!-- End -->


                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Comment</label>

                    <div class="col-md-6">
                        <textarea  class="form-control" name="comment" value="{{ old('comment') }}"></textarea>

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

@endsection