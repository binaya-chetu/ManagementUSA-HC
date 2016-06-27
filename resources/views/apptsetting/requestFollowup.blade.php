
@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
                        <th>Sr.</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Phone</th>
                        <th>Lead Source</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($requestFollowups as $requestFollowup)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                        <td class="table-text"><div>{{ $requestFollowup->first_name }}  {{ $requestFollowup->last_name }}</div></td>
                        <td class="table-text"><div>{{ $requestFollowup->email }}</div></td>
                        <td class="table-text"><div>{{ $requestFollowup->phone }}</div></td>
                        <td class="table-text"><div>{{ $resources[$requestFollowup->appt_source] }}</div></td>
                        <td class="table-text"><div>{{ $requestFollowup->location }}</div></td>
                        <td class="actions" style = "text-align:center">
                            <a href="javascript:void(0)" class="on-default request-follow-up"  rel="{{ $requestFollowup->id }}"><i class="fa fa-pencil"></i></a>
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
            
                    <div class="form-group">
                        {{ Form::label('setDate', 'Set Date', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                {{ Form::text('created_date', date('m-d-Y'), ['class' => 'form-control required selectDate', 'data-plugin-datepicker']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                {{ Form::text('created_time', date('H:i:s'), ['class' => 'form-control required', 'data-plugin-timepicker']) }}
                            </div>
                        </div>
                   
                        {{ Form::hidden('createdBy', Auth::user()->id) }}
                        {{ Form::hidden('lastUpdatedBy', Auth::user()->id) }}
                        {{ Form::hidden('request_id', null, ['id' => 'request_id']) }}  
                           
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
        $('#request_id').val($(this).attr('rel'));
    });
    
</script>

@endsection





