@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
     <header class="page-header">
        <h2>Cart</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{url('/')}}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
	<div class="row">
            <div class="col-lg-12">	
                <section class="panel panel-primary">
                    @if(isset($category_list) && !empty($category_list))
                    <header class="panel-heading">
                        <div class="panel-actions">				
                            @if(isset($category_list))
                            <a href="/sale/checkout/{{ base64_encode(array_values($category_list)[0]['patient_id']) }}"> 
                                <button type="button" class="btn btn-success">
                                    <span class="fa fa-check"></span> Checkout
                                </button>
                            </a>
                            <a href="/cart/emptyCart/{{ base64_encode(array_values($category_list)[0]['patient_id']) }}"> 
                                <button type="button" class="btn btn-danger">
                                    <span class="fa fa-remove"></span> Empty cart
                                </button>
                            </a>
                            @endif	
                        </div>
                        <h2 class="panel-title">Cart Item </h2>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            @if(Session::has('flash_message'))
                            <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                            @elseif(Session::has('error_message'))
                            <div class="col-sm-12"><div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span><em> {!! session('error_message') !!}</em></div></div>					
                            @endif				
                        </div>
                        <table class="table table-bordered mb-none" id="cartItemList">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Agent</th>
                                    <th>Patient</th>
                                    <th class="text-center">Duration</th>
                                    <th class="text-center">Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>					
                                @foreach($category_list as $i => $cat)
                                <tr class="gradeX background-{{ isset($cat['category_type'])? strtolower($cat['category_type']) : 'default' }}" data-details-table = '{{ $i }}'>
                                    <td>{{ $cat['category'] }}</td>
                                    <td>{{ $cat['user'] }}</td>
                                    <td>{{ $cat['patient'] }}</td>
                                    <td class="center">{{ $cat['duration'] }}</td>
                                    <td class="center">${{ number_format($discouonted_package_price[$i], 2) }}</td>
                                    <td class="center">
                                        <a data-href="/cart/removeItem/{{ base64_encode($i) }}" href="javascrpt:void(0)" class="on-default remove-row confirmation-callback" data-original-title="Remove from cart" title="Remove from cart">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>									
                                @endforeach
                            </tbody>
							<tfoot>
                                <tr class="noDetail">
                                    <td></td><td colspan="4">Total </td><td class="center">${{ number_format($total_cart_price, 2) }}</td>
                                </tr>							
							</tfoot>
                        </table>
                    </div>
                    <div id="rowDetails" style="display:none">
                        @foreach($category_detail_list as $ind => $val)	
                        <table class="table table-bordered table-striped mb-none datatable-details" data-details-src="{{ $ind }}">
                            <thead>
                                <tr>
                                    <th>sku</th>
                                    <th>Product Name</th>
                                    <th>Unit</th>
                                    <th>Count</th>
                                    <th>Individual Price</th>
                                    <th>Package Price</th>
                                </tr>
                            </thead>
                            <tbody>								
                                @foreach($val as $item)
                                <tr>
                                    <td>{{ $item['sku'] }}</td>
                                    <td>{{ $item['product'] }}</td>
                                    <td class="center">{{ $item['unit_of_measurement'] }}</td>
                                    <td class="center">{{ $item['count'] }}</td>
                                    <td class="center">{{ $item['original_price'] }}</td>
                                    <td class="center">{{ $item['discount_price'] }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td colspan="4"><strong>Total price</strong></td>
                                    <td>{{ $original_package_price[$ind] }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="4"><strong>Total discouont</strong></td>
                                    <td>{{ $package_discount[$ind] }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="4"><strong>Discounted package price</strong></td>
                                    <td>{{ $discouonted_package_price[$ind] }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endforeach				
                    </div>
                    @else
                    <table class="table table-bordered">
                        <tr><td class="col-sm-8 col-md-6"><h5>Your Cart is empty.</h5></td>
                            <td class="col-sm-8 col-md-6" colspan=2><h5><a href="/sale/index"> <button type="button" class="btn btn-default">
                                            <span class="fa fa-shopping-cart"></span> Continue Shopping
                                        </button>
                                    </a></h5></td>
                        </tr>
                    </table>	
                    @endif
                </section>
                <!-- end: page -->		
            </div>
    </div>
 </section>
@endsection

<style>
    .desc_tab {
        text-align: center;
    }
</style>