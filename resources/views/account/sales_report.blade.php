@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Sale Report</h2>

        <div class="right-wrapper pull-right">
           {!! Breadcrumbs::render('user.listUsers') !!}

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
            @if(Request::segment(2) === 'dailySalesReport')
                Daily Sale Report
            @elseif(Request::segment(2) === 'weeklySalesReport')
                Weekly Sale Report
            @elseif(Request::segment(2) === 'monthlySalesReport')
                Monthly Sale Report
            @elseif(Request::segment(2) === 'yearlySalesReport')
                Yearly Sale Report
            @endif
            
            </h2>
        </header>
        <div class="panel-body">
          <div class="row">
            @if(Session::has('flash_message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
            @endif
           </div>
            
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="{{ URL::asset('vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf') }}">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Order Number</th>
                        <th>Invoice Number</th>
                        <th>Package</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total Amount</th>
                        <th>Agent</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($sales))
                    {{--*/ $i = 0 /*--}}
                    {{--*/ $subAmount = 0 /*--}}
                    {{--*/ $discountAmount = 0 /*--}}
                    {{--*/ $totalAmount = 0 /*--}}
                    @foreach ($sales as $sale)
                    <tr class="gradeX">
                        <td>{{ ++$i }}</td>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->invoice->invoice_number }}</td>
                        <td>{{ $sale->categories->cat_name }}</td>
                        <td>{{ $sale->categoryType->name }}</td>
                        <td>{{ $sale->categories->duration_months }}</td>
                        <td>{{--*/ $subAmount += $sale->subtotal_amount /*--}}{{ $sale->subtotal_amount }}</td>
                        <td>{{--*/ $discountAmount += $sale->discount_amount /*--}}{{ $sale->discount_amount }}</td>
                        <td>{{--*/ $totalAmount += $sale->total_amount /*--}}{{ $sale->total_amount }}</td>
                        <td>{{ $sale->agent->first_name }} {{ $sale->agent->last_name }}</td>
                        <td class="actions">
                            <a href="/accounting/show/{{ base64_encode($sale->id) }}" class="on-default" title="View Order Detail"><i class="fa fa-eye"></i></a> |
                            <a href="javascript:void(0)" data-href="/accounting/destroy/{{ base64_encode($sale->id) }}" class="on-default remove-row confirmation-callback"><i class="fa fa-trash-o"></i></a> 
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6">
                            <strong>Total<strong>
                        </td>
                        <td class="center">
                        <strong>{{ $subAmount }}<strong>
                        </td>
                        <td class="center">
                        <strong>{{ $discountAmount }}<strong>
                        </td>
                        <td class="center">
                            <strong>{{ $totalAmount }}</strong>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>
</section>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection