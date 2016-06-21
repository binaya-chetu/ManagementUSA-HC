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
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($requestFollowups as $requestFollowup)
                    <tr>
                        <td class="table-text table-text-id"><div>{{ $i++ }}</div></td>
                        <td class="table-text"><div>{{ $requestFollowup->first_name }}{{ $requestFollowup->last_name }}</div></td>
                        <td class="table-text"><div>{{ $requestFollowup->email }}</div></td>
                         <td class="table-text"><div>{{ $requestFollowup->phone }}</div></td>
                          <td class="table-text"><div>{{ $requestFollowup->location }}</div></td>
                        <td class="actions">
                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                            <a href="javascript:void(0)" class="on-default edit-row" rel="{{ $requestFollowup->id }}"><i class="fa fa-pencil"></i></a>
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
        
</div>

<div id="modal-add-view-appointment" class="modal-block modal-block-primary mfp-hide">  
        
</div>
@endsection