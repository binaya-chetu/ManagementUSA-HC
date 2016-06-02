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
                    <tr>
                        <td class="table-text table-text-id"><div>1</div></td>
                        <td class="table-text">Maria</td>
                        <td class="table-text">maria@gmail.com</td>
                        <td class="table-text">+1-678-456-787</td>                        
                        <td class="table-text">Oklahoma City</td>
                        <td class="table-text"> 03-06-2016 02:00pm</td>
                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>
                    <tr>
                        <td class="table-text table-text-id"><div>1</div></td>
                        <td class="table-text">Neo</td>
                        <td class="table-text">neo@gmail.com</td>
                        <td class="table-text">+1-678-467-767</td>                        
                        <td class="table-text">Tulsa</td>
                        <td class="table-text"> 02-06-2016 04:00pm</td>
                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>
                    <tr>
                        <td class="table-text table-text-id"><div>1</div></td>
                        <td class="table-text">philip</td>                        
                        <td class="table-text">philip@gmail.com</td>
                        <td class="table-text">+1-355-464-756</td>
                        <td class="table-text">Tulsa</td>
                        <td class="table-text"> 01-06-2016 03:00pm</td>
                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>
                    <tr>
                        <td class="table-text table-text-id"><div>1</div></td>
                        <td class="table-text">xyz</td>                        
                        <td class="table-text">xyz@gmail.com</td>
                        <td class="table-text">+1-456-234-423</td>
                        <td class="table-text">Oklahoma City</td>
                        <td class="table-text"> 31-05-2016 11:00am</td>
                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </section>
</section>

@endsection