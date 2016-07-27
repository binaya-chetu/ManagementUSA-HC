@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Order Details</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('accounting.show', $order->id) !!}
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">	
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Order Details </h2>
                </header>	
                <div class="panel-body">
                    <table class="table table-bordered table-striped mb-none" id="datatable-details">
                        <thead>
                            <tr>
                                <th>Sku</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Package Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetail as $item)
                            <tr>
                                <td>{{ $item->product_sku }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td class="center">${{ $item->unit_price }}</td>
                                <td class="center">{{ $item->quantity }}</td>
                                <td class="center">{{--*/ $price = ($item->unit_price)*($item->quantity) /*--}} ${{ $price }}</td>
                                <td class="center">${{ $item->total_amount }}</td>
                            </tr>
                            @endforeach	
                            <tr>
                                <td colspan="4">
                                    <strong>Sub Total Amount<strong>
                                </td>
                                <td colspan="2" class="center">
                                <strong>${{ $order->subtotal_amount }}<strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <strong>Discount<strong>
                                </td>
                                
                                <td colspan="2" class="center">
                                <strong>${{ $order->discount_amount }}<strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <strong>Total Amount<strong>
                                </td>
                                
                                <td colspan="2" class="center">
                                    <strong>${{ $order->total_amount }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9">
                            <a href="#" class="btn btn-default" onclick="window.history.go(-1)">Back</a>
                        </div>
                    </div>
                </footer>
            </section>

        </div>
    </div>
</section>
@endsection

<style>
    .desc_tab {
        text-align: center;
    }
</style>