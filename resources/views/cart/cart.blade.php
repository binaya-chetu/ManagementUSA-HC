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
                <header class="panel-heading">
                    <div class="panel-actions">
					@if(isset($cart))
						<a href="#"> 
						<button type="button" class="btn btn-success">
							<span class="fa fa-check"></span> Checkout
						</button>
						</a>
						<a href="/cart/removeItem/{{$cart->id}}"> 
						<button type="button" class="btn btn-danger">
							<span class="fa fa-remove"></span> Empty cart
						</button>
						</a>
					@endif	
                    </div>
                    <h2 class="panel-title">Cart Item </h2>
                </header>	
                <div class="panel-body">
            <table class="table table-hover solidTdTags">
                <thead>
                <tr class="background-{{ isset($category_type)? strtolower($category_type->name) : 'default' }}">
                    <th>Product</th>
                    <th class="text-center">Duration</th>
                    <th class="text-center">Price</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($category))
					<tr>
						<td><strong>{{ $category->cat_name }} ( {{ $category_type->name }} )</strong></td>
						<td class="text-center">{{ $category->duration_months }}</td>
						<td class="text-center">{{ $category_sum->total_amount }}</td>
					</tr>
					<tr>
						<td col-span="2">
							<table class="table table-bordered table-striped mb-none" id="datatable-details">
								<thead>
									<tr>
										<th>sku</th>
										<th>Product Name</th>
										<th>Unit</th>
										<th>Count</th>
										<th>Price</th>
										<th>Package Price</th>
									</tr>
								</thead>
								<tbody>								
								@foreach($cart_items as $item)
									<tr>
										<td>{{ $item->sku }}</td>
										<td>{{ $item->name }}</td>
										<td class="center">{{ $item->unit_of_measurement }}</td>
										<td class="center">{{ $item->p_count }}</td>
										<td class="center">{{ $item->price }}</td>
										<td class="center">{{ $item->spl_price }}</td>
									</tr>
								@endforeach	
								</tbody>
							</table>					
						</td>
					</tr>
					<tr>
						<td col-span="3">
							Individual Purchase price
						</td>
						<td></td>
						<td class="center">
						{{ $category_sum->totalUnitPrice }}
						</td>
					</tr>
					<tr>
						<td col-span="3">
							Total discount
						</td>
						<td></td>
						<td class="center">
						{{ $category_sum->totalUnitPrice - $category_sum->total_amount }}
						</td>
					</tr>
					<tr>
						<td col-span="3">
							Package cost
						</td>
						<td></td>
						<td class="center">
						{{ $category_sum->total_amount }}
						</td>
					</tr>
                @else 
                    <tr> <td class="col-sm-8 col-md-6"><h5>Your Cart is empty.</h5></td>
                    <td class="col-sm-8 col-md-6" colspan=2><h5><a href="/categories/listCategories"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Continue Shopping
                            </button>
                        </a></h5></td>
                    </tr>
                @endif
                </tbody>
            </table>
           </div>
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