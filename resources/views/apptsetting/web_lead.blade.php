@extends('layouts.common')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Web Leads</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('apptsetting.webLead') !!}

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

            <div class="row">
                <div class="col-md-12">
                    <div class="tabs tabs-primary">
<!--                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#marketing" data-toggle="tab"><i class="fa fa-star"></i> Web Leads</a>
                            </li>
                            <li>
                                <a href="#follow" data-toggle="tab">Follow-up ({{ count($follows)}}) </a>
                            </li>
                        </ul>-->
                        <div class="tab-content">
                            <div id="marketing" class="tab-pane active">
                                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>Name</th>                        
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>Requested Time</th>
<!--                                            <th>Actions</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($webLeads as $web)
                                        <tr>
                                            <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                                            <td class="table-text">{{ $web->first_name }} {{ $web->last_name }}</td>
                                            <td class="table-text">{{ $web->email }}</td>
                                            <td class="table-text">{{ $web->phone }}</td>                        
                                            <td class="table-text">{{ $web->location }}</td>
                                            <td class="table-text"> {{ date('Y-m-d h:ia', strtotime($web->requested_date)) }}</td>
<!--                                            <td class="actions">
                                                <a href="javascript:void(0);" class="on-editing save-row lead_popup" title="Edit" rel="{{ $web->id }}"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                                            </td>-->
                                        </tr>
                                        @endforeach                    
                                    </tbody>
                                </table>

                            </div>
                            <div id="follow" class="tab-pane">
                                <p>Recent</p>
                                <table class="table table-bordered table-striped mb-none" id="datatable-default">

                                    <thead>
                                        <tr>
                                            <th>S. No.s</th>
                                            <th>Name</th>                        
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>Requested Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $j = 1; ?>
                                        @foreach ($follows as $follow)
                                        <tr>
                                            <td class="table-text table-text-id"><div>{{ $j++ }}</div></td>
                                            <td class="table-text">{{ $follow->web_lead->first_name }} {{ $follow->web_lead->last_name }}</td>
                                             <td class="table-text">{{ $follow->web_lead->email }}</td>
                                            <td class="table-text">{{ $follow->web_lead->phone }}</td>                        
                                            <td class="table-text">{{ $follow->web_lead->location }}</td>
                                            <td class="table-text"> {{ date('Y-m-d h:ia', strtotime($follow->web_lead->requested_date)) }}</td>
                                            <td class="actions">
                                            </td>
                                        </tr>  
                                        @endforeach  
                                    </tbody>
                                </table> 

                            </div>
                        </div>
                    </div>
                </div>                
            </div>

        </div>
    </section>
</section>
<!-- Modal Form -->
<div id="modalCall" class="modal-block modal-block-primary mfp-hide">    
    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Web Leads Followup</h2>
        </header>
        {{ Form::open(array('url' => '#', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'callStatus')) }}
        <div class="panel-body">
            <div class="form-group"> 
                {{ Form::label('status', 'Status', array('class' => 'col-sm-4 control-label call_label mandatory')) }}
                <div class="col-sm-8"> 
                    <div class="col-sm-6"> 
                        <div class="radio-custom radio-primary"> 
                            {{ Form::radio('status', '1', false, ['id' => 'awesome', 'class' => 'callStatus required']) }}

                            <label for="awesome">Set
                            </label>
                            {{ Form::hidden('appt_id', null, ['id' => 'apptId']) }}  
                            {{ Form::hidden('appt_type', 1) }}
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
                    {{ Form::label('follow-up', 'Follow-up after one week', array('class' => 'col-sm-4 control-label')) }}

                    <div class="col-md-6">
                        {{ Form::checkbox('followup_status',null, false, ['class' => 'followup_check']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('comment', 'Comment', array('class' => 'col-sm-4 control-label mandatory')) }}
                    <div class="col-md-6">
                        {{ Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3']) }}                        

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
        {{ Form::close() }}
    </section>
    
</div>
<script>
    $('document').ready(function() {
        $('#reasonCode').hide();
        $('#callStatus').validate();
    });
    $('.callStatus').on('click', function() {
        var call_value = $(this).val();
        if (call_value == 1) {
            $('#reasonCode').hide();
        } else {
            $('#reasonCode').show();
        }
    });

</script>
@endsection