@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Web Leads</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Web Leads</span></li>
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

            <h2 class="panel-title">Web Leads</h2>
            
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
                        <th>S. No.</th>
                        <th>Name</th>                        
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Requested Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                     <?php $i=1; ?>
                    @foreach ($webLeads as $web)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                        <td class="table-text">{{ $web->first_name }} {{ $web->last_name }}</td>
                        <td class="table-text">{{ $web->email }}</td>
                        <td class="table-text">{{ $web->phone }}</td>                        
                        <td class="table-text">{{ $web->location }}</td>
                        <td class="table-text"> {{ date('Y-m-d h:ia', strtotime($web->requested_date)) }}</td>
                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row lead_popup" title="Edit" rel="{{ $web->id }}"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>
                    @endforeach                    
                </tbody>
            </table>
        </div>
    </section>
</section>
<!-- Modal Form -->
<div id="modalCall" class="modal-block modal-block-primary mfp-hide">    
    {{ Form::open(array('url' => '/apptsetting/saveApptFollowup', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'callStatus')) }}  
    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Web Leads Followup</h2>
        </header>
        <div class="panel-body">
            <div class="form-group"> 
                {{ Form::label('status', 'Status', array('class' => 'col-sm-4 control-label call_label mandatory')) }}
                <div class="col-sm-8"> 
                    <div class="col-sm-6"> 
                        <div class="radio-custom radio-primary"> 

                            {{ Form::radio('status', '1', false, ['id' => 'awesome', 'class' => 'callStatus required']) }}
                            <label for="awesome">Set
                            </label>
                        </div> 
                    </div> 
                    <div class="col-sm-6"> 
                        <div class="radio-custom radio-primary"> 

                            {{ Form::radio('status', '2', false, ['id' => 'very-awesome', 'class' => 'callStatus required']) }}
                            <label for="very-awesome">No Set
                            </label> 
                        </div> 
                    </div> 
                </div> 
            </div>
            <div  id="reasonCode">
                <div class="form-group">
                    {{ Form::label('reason_id', 'Reason Code', array('class' => 'col-sm-4 control-label mandatory')) }}
                    <div class="col-md-6">
                        {{ Form::select('reason_id', ['' => 'Choose the Reason Code'] + $reasonCode, ['class' => 'form-control required']) }}
                    </div>
                </div>
                  <div class="form-group">
                    {{ Form::label('follow_up_after', 'Follow-up Afetr', array('class' => 'col-sm-4 control-label')) }}
                    <div class="col-md-6">
                        {{ Form::checkbox('follow_up_after', null, ['class' => 'form-control']) }}                        
                        {{ Form::hidden('appt_id', null, ['id' => 'apptId']) }}                        
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('comment', 'Comment', array('class' => 'col-sm-4 control-label mandatory')) }}
                    <div class="col-md-6">
                        {{ Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3']) }}                        
                        {{ Form::hidden('appt_id', null, ['id' => 'apptId']) }}                        
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    {{ Form::button( 'Submit', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type' => 'submit')) }}
                    <button class="btn btn-default closePop">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
    {{ Form::close() }}
</div>

<script>
    $('document').ready(function() {
        $('#reasonCode').hide();
        $('#callStatus').validate();
    })
    
    $('.lead_popup').on('click', function() {
       // $('#apptId').val($(this).attr('rel'));
        
        $.magnificPopup.open({
            items: {
                src: '#modalCall',
                type: 'inline'
            }
        });
    });
    $('.callStatus').on('click', function() {
        var call_value = $(this).val();
        console.log(call_value);
        if (call_value == 1) {
            $('#reasonCode').hide();
        } else {
            $('#reasonCode').show();
        }
    });

</script>
@endsection