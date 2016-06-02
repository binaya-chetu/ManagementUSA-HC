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
                            <a href="#modalCall" class="on-editing save-row" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>
                    @endforeach                    
                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection