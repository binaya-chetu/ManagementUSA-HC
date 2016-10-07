@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>All Payment Documents</h2>
        <div class="right-wrapper pull-right">
           {!! Breadcrumbs::render('frontpdfform.pdf_list') !!}
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        <div class="col-lg-12">	
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a class="panel-action panel-action-toggle" data-panel-toggle="" href="#"></a>
                        <a class="panel-action panel-action-dismiss" data-panel-dismiss="" href="#"></a>
                    </div>
                    <h2 class="panel-title">Payment Documents</h2>
                </header>	
                <div class="panel-body">
                @if(Session::has('flash_message'))
                    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
                @endif
                @if(Session::has('error_message'))
                    <div class="alert alert-warning"><span class="glyphicon glyphicon-ok"></span><em>{!! session('error_message') !!}</em></div>
                @endif
                    <div class="col-md-12">
                        <li><a target="_blank" href="/sale/generateInvoice/{{ base64_encode($order_id) }}">Generate Invoice</a></li>
                        
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>    
@endsection