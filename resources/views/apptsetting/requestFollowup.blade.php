
@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ URL::asset('vendor/jquery-timepicker/jquery.timepicker.css') }}" />
<script src="{{ URL::asset('vendor/jquery-timepicker/jquery.timepicker.js') }}"></script>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Request Follow-Ups</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Request Follow-Ups</span></li>
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

            <h2 class="panel-title">Request Follow-Ups</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                @if(Session::has('flash_message'))
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @endif
               
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Phone</th>
                        <th>Lead Source</th>
                        <th>Reason</th>
                        <th>Created At </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;
                      if(!empty($requestFollowups)){
                    ?>
                  
                    @foreach ($requestFollowups as $requestFollowup)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                        <td class="table-text"><div>{{ $requestFollowup->first_name }}  {{ $requestFollowup->last_name }}</div></td>
                        <td class="table-text"><div>{{ $requestFollowup->email }}</div></td>
                        <td class="table-text"><div>{{ $requestFollowup->phone }}</div></td>
                        <td class="table-text"><div>{{ $resources[$requestFollowup->appt_source] }}</div></td>
                        <td class="table-text"><div>{{ $requestFollowup->reason }}</div></td>
                        <td class="table-text"><div>{{ date('d F Y H:ia', strtotime($requestFollowup->created_at)) }}</div></td>
                        <td class="actions" style = "text-align:center">
                            <a href="javascript:void(0)" class="on-default request-follow-up"  rel="{{ $requestFollowup->user_id }}"><i class="fa fa-pencil"></i></a>
                        </td>
                        
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </section>
</section>
<div id="modalCall" class="modal-block modal-block-primary mfp-hide">    
    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Request Followup</h2>
        </header>
        {{ Form::open(array('url' => '/apptsetting/saveRequestFollowUp', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'callStatus')) }}
        <div class="panel-body">
                     <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-6">
                                {{ Form::hidden('patient_id') }}
                                {{ Form::hidden('appointment_request_id') }}
                                {{ Form::hidden('appointment_id') }}
                                {{ Form::text('first_name', $requestFollowup->first_name , ['class' => 'form-control required', 'id' => 'first_name', 'placeholder' => 'First Name']) }}
                                @if ($errors->has('patient_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('last_name', $requestFollowup->last_name , ['class' => 'form-control ', 'id' => 'last_name', 'placeholder' => 'Last Name']) }}
                                @if ($errors->has('patient_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    {{ Form::email('email', $requestFollowup->email, ['class' => 'form-control ', 'id' => 'email', 'placeholder' => 'Email']) }}
                                </div>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            {{ Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-6">
                                {{ Form::text('phone', $requestFollowup->phone , ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14']) }}
                            </div>
                            @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group"> 
                                   {{ Form::label('dob', 'DOB', array('class' => 'col-sm-3 control-label')) }}
                                   <div class="col-md-6"> 
                                       <div class="input-group"> 
                                           <span class="input-group-addon"> <i class="fa fa-calendar"></i> 
                                           </span> 
                                           {{ Form::text('dob', old('dob') , ['class' => 'form-control', 'data-plugin-datepicker', 'id' => 'dob']) }}
                                       </div> 
                                       @if ($errors->has('dob')) 
                                       <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> 
                                       </span>
                                       @endif 
                                   </div> 
                          </div> 
                       
                 
                 <div class="form-group">
                        {{ Form::label('status', 'Status', array('class' => 'col-sm-3 control-label call_label mandatory')) }}
                        <div class="col-sm-8">
                            <div class="col-sm-4">
                                <div class="radio-custom radio-primary">
                                    {{ Form::radio('status', '0', false, ['id' => 'awesome', 'class' => 'callStatus required']) }}
                                    <label for="awesome">Set
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="radio-custom radio-primary">
                                    {{ Form::radio('status', '1', false, ['id' => 'very-awesome', 'class' => 'callStatus required']) }}
                                    <label for="very-awesome">No Set
                                    </label>
                                </div>
                            </div>
                        </div>
                 </div> 
                <div  id="nosetAppointment">
                        <div class="form-group">
                            {{ Form::label('reason_id', 'Reason Code', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-md-6">
                                {{ Form::select('reason_id', ['' => 'Choose the Reason Code'] + $noSetReasonCode, null, ['class' => 'form-control required']) }}

                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('comment', 'Comment for No Set', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-md-6">
                                {{ Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3']) }}

                            </div>
                        </div>
                    </div>
                   <div  id="setAppointment">
                          <div class="form-group">
                        {{ Form::label('setDate', 'Set Date', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                               
                                {{ Form::text('appDate', old('appDate'), ['class' => 'form-control required selectDate', 'data-plugin-datepicker','id' =>'calendarDate']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                               {{ Form::text('appTime', null, ['class' => 'form-control required', 'placeholder' => 'Choose Time', 'id' => 'durationExample']) }}  
                             
                            </div>
                        </div>
                   
                        {{ Form::hidden('createdBy', Auth::user()->id) }}
                        {{ Form::hidden('lastUpdatedBy', Auth::user()->id) }}
                        {{ Form::hidden('user_id', null, ['id' => 'user_id']) }}  
                           
                    </div>
                        <div class="form-group">
                            {{ Form::label('reason_id', 'Reason for Visit', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-md-6">
                                {{ Form::select('reason_id', ['' => 'Choose the Reason'] + $reasonCode, null, ['class' => 'form-control required']) }}
                            </div>
                        </div>
                     
                        <div class="form-group">
                            {{ Form::label('comment', 'Comment for Set', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-md-6">
                                {{ Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3']) }}

                            </div>
                        </div>
                    </div>

        </div>
        
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    {{ Form::button( 'Set Appointment', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type' => 'submit')) }}
                </div>
            </div>
        </footer>
        {{ Form::close() }}
    </section>
    
</div>

                      <?php } ?>
<script>
 $(document).on("click", ".request-follow-up", function(ev) {
        $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.magnificPopup.open({
        items: {
        src: '#modalCall',
        type: 'inline'
        }
        });
        });
  $('.request-follow-up').on('click', function() {
        $('#user_id').val($(this).attr('rel'));
    });
    

     $('#durationExample').timepicker({
        'minTime': '09:00am',
        'maxTime': '05:00pm',
        'showDuration': true
    });        

</script>

@endsection





