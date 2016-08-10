@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Inventory Details</h2>

        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('inventory.index') !!}
            
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">
                Inventory Details
            </h2>
        </header>
        <div class="panel-body">
          <div class="row">
            @if(Session::has('flash_message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
            @endif
           </div>
            
            <table class="table table-bordered table-striped mb-none" id="table-tools" data-swf-path="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>SKU</th>
                        <th>Product Name</th>
                        <th>Unit Of Measurement</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{--*/ $i = 0 /*--}}
                    @foreach ($inventories as $inventory)
                    <tr class="gradeX">
                        <td>{{ ++$i }}</td>
                        <td>{{ $inventory->sku }}</td>
                        <td>{{ $inventory->name }}</td>
                        <td>{{ $inventory->unit_of_measurement }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td class="actions">
                            <a href="/inventory/edit/{{ base64_encode($inventory->id) }}" class="on-default" title="Edit"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection