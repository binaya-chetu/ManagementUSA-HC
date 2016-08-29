@extends('layouts.common')

@section('content')
 <!--link rel="stylesheet" href="{{ URL::asset('vendor/dropzone/css/dropzone.css') }}" /-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Lab Appointments</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('appointment.labAppointments') !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right">
                <i class="fa fa-chevron-left"></i>
            </a>
        </div>
    </header>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Lab Appointments</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                @if(Session::has('flash_message'))
					<div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @elseif(Session::has('error_message'))
					<div class="col-sm-12"><div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span><em> {!! session('error_message') !!}</em></div></div>					
				@endif				
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>App Date and Time</th>
                        <th>Patient</th>                        
                        <th>Source</th>
                        <th>Reason of visit</th>
                        <th>Patient status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                        <td class="table-text"><div>{{ $appointment->apptTime }}</div></td>

                        <td class="table-text"><div><a class="defaultColor" href="/appointment/patientMedical/{{ base64_encode($appointment['patient']->id) }}">{{ $appointment['patient']->first_name }} {{ $appointment['patient']->last_name }}</a></div></td>
                        
                        <td class="table-text"><div>
                                <?php
                                switch ($appointment->appt_source) {
                                    case 1: echo "Web Lead";
                                        break;
                                    case 2: echo "Tele Marketing";
                                        break;
                                    case 3: echo "Walk-ins";
                                        break;
                                    default: echo "Unknown";
                                        break;
                                }
                                ?>
                            </div></td>
                        <td class="table-text"><div><?php 
                                $reasonArr = $appointment->patient->reason->toArray();
                                $reasonArray = array_column($reasonArr, 'reason_code');
                                $reasonList = array_column($reasonArray, 'reason');
                                $reason = implode(',', array_unique($reasonList)); 
                                echo $reason; ?>                                
                            </div></td>
                        <td class="table-text"><div><?php
                                switch ($appointment->patient_status) {
                                    case 1: echo "Show";
                                        break;
                                    case 2: echo "Send To Lab";
                                        break;
                                    case 3: echo "Waiting for Lab Report";
                                        break;
                                    case 4: echo "Lab Report Ready";
                                        break;
                                    default: echo "None";
                                        break;
                                }
                                ?></div></td>
                        <td class="actions"> 					
                            <a href="javascript:void(0)" class="on-default patient_status" data-patientId="{{ $appointment->patient_id }}" rel="{{ $appointment->id }}"><i class="fa fa-pencil"></i></a>
<!--                            <a href="javascript:void(0)" data-href="/appointment/delete/{{ base64_encode($appointment->id) }}" class="on-default remove-row confirmation-callback"><i class="fa fa-trash-o"></i></a> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>
<div id="modal-change-patient-status" class="modal-block modal-block-primary mfp-hide">  
    {{ Form::open(array('url' => '/appointment/savePatientStatus', 'method' => "post", 'class'=>'form-horizontal form-bordered dropzone', 'files' => true, 'id' => 'changeStatus')) }}
    {!! csrf_field() !!}
    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Select Patient Status</h2>		
        </header>
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label('status', 'Patient Status', array('class' => 'col-sm-4 control-label mandatory')) }}
                <div class="col-md-6">
                    <?php $states = [ '3' => 'Waiting For Lab Report', '4' => 'Ready Lab Report']; ?>
                    {{ Form::select('patient_status', ['' => 'Please Select Patient Status'] + $states, null, ['class' => 'form-control input required']) }}
                </div>
                {{ Form::hidden('appointment_id', 0, array('id' => 'patient_appt_id')) }}
                {{ Form::hidden('patient_id', 0, array('id' => 'patient_id')) }}
            </div>
			<div class="form-group">
			
<!--div id="dropzonePreview" class="form-group dz-default dz-message dropzone-previews">
  <span>Drop files</span>
</div-->

			
			</div>
			
			<!--div class="form-group" id="labFilesUpload">
				{{ Form::label('labFiles', 'Upload Lab report files', array('class' => 'col-sm-4 control-label')) }}
				<div class="col-md-6">                                   
					{{ Form::file('labFiles', null, ['class' => 'form-control input', 'multiple' => 'multiple']) }}
				</div>	
			</div-->      
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-8 text-right">
                    {{ Form::button('Submit', ['class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit']) }}    
                    <button class="btn btn-default closePop">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
    {{ Form::close() }}  
	
	
 <!--script src="{{ URL::asset('vendor/dropzone/dropzone.min.js') }}"></script>
 <script>
 Dropzone.options.changeStatus = { // The camelized version of the ID of the form element

  // The configuration we've talked about above
  paramName: 'labFiles',
  autoProcessQueue: false,
  uploadMultiple: true,
  parallelUploads: 100,
  maxFiles: 100,
  
  addRemoveLinks: true,

  // The setting up of the dropzone
  init: function() {
    var myDropzone = this;

    // First change the button to actually tell Dropzone to process the queue.
    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
      // Make sure that the form isn't actually being sent.
      e.preventDefault();
      e.stopPropagation();
      myDropzone.processQueue();
    });

    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
    // of the sending event because uploadMultiple is set to true.
    this.on("sendingmultiple", function() {
      // Gets triggered when the form is actually being sent.
      // Hide the success button or the complete form.
    });
    this.on("successmultiple", function(files, response) {
      // Gets triggered when the files have successfully been sent.
      // Redirect user or notify of success.
    });
    this.on("errormultiple", function(files, response) {
      // Gets triggered when there was an error sending the files.
      // Maybe show form again, and notify user of error
    });
  }

}
 </script-->
</div>


<!--script src="{{ URL::asset('vendor/custom_fileupload/js/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('vendor/custom_fileupload/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('vendor/custom_fileupload/js/jquery.fileupload.js') }}"></script>
<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
    });
});
</script-->	

@endsection