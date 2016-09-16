
@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ URL::asset('vendor/jquery-timepicker/jquery.timepicker.css') }}" />
<script src="{{ URL::asset('vendor/jquery-timepicker/jquery.timepicker.js') }}"></script>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Request Follow-Ups</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('apptsetting.requestFollowUp') !!}

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
                    <?php
                    $i = 1;
                   
                    if (count($requestFollowups)>0) {
                        ?>
                        @foreach ($requestFollowups as $requestFollowup)
                            <tr>
                            <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                            <td class="table-text"><div>{{ $requestFollowup['patient']->first_name }}  {{ $requestFollowup['patient']->last_name }}</div></td>
                            <td class="table-text"><div>{{  $requestFollowup['patient']->email }}</div></td>
                            <td class="table-text"><div>{{  $requestFollowup['patient']->phone }} <?php   
                                $phoneArray = $requestFollowup->toArray();  
                                $phoneArray1 = array_column($phoneArray, 'patient_detail'); 
                                $phoneList = array_column($phoneArray1, 'phone'); 
                                $phone = implode(',', $phoneList);
                                echo $phone;
                                ?> </div>
                            </td>
                            <td class="table-text"><div>{{ $resources[$requestFollowup->appt_source] }}</div></td>
                            <td class="table-text"><div>
                             <?php   
                                $reasonArr = $requestFollowup->toArray();
                                $reasonArray = array_column($reasonArr, 'reason_code'); 
                                $reasonList = array_column($reasonArray, 'reason'); 
                                $reason = implode(',', $reasonList);
                                echo $reason;
                                ?> 
                                
                            </div></td>
                            <td class="table-text"><div>{{ date('d F Y H:ia', strtotime($requestFollowup->created_at)) }}</div></td>
                            <td class="actions" style = "text-align:center">
                                <a href="javascript:void(0)" class="on-default request-follow-up" rel="<?php echo $requestFollowup->user_id.'/'.$requestFollowup->id; ?>"><i class="fa fa-pencil"></i></a>
                                 
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </section>
    </section>
    <!-- Modal Form -->
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">  
                   @include('apptsetting.editRequestfollowup')      
</div>
<?php } ?>
<script>
//$(document).on("click", ".request-follow-up", function(ev) {
//    $.ajaxSetup({
//        headers: {
//            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//        }
//    });
//    $.magnificPopup.open({
//        items: {
//            src: '#modalCall',
//            type: 'inline'
//        }
//    });
//    $('#appointment_request_id').val($(this).attr('rel'));
//});


$('#durationExample').timepicker({
    'minTime': '09:00am',
    'maxTime': '05:00pm',
    'showDuration': true
});

</script>

@endsection





