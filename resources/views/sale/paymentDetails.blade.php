@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
     <header class="page-header">
        <h2>Payment Details</h2>
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
			@if(isset($payment) && !empty($payment))
				<header class="panel-heading">

				</header>
				<div class="panel-body">			
					<table class="table table-bordered mb-none" id="cartItemList">
						<thead>
							<tr>
								<th>Agent Name</th>
								<th>Payment Type</th>
								<th>Total Amount</th>
								<th>Amount Paid</th>
								<th>Package Count</th>
							</tr>
						</thead>
						<tbody>	
						@foreach($payment as $i => $row)
							<tr class="gradeX" data-details-table = '{{ $i }}'>
								<td>{{ $row['agent'] }}</td>
								<td>{{ $row['payment_type'] }}</td>
								<td>{{ $row['total_amount'] }}</td>
								<td>{{ $row['paid_amount'] }}</td>
								<td>{{ $row['package_count'] }}</td>
							</tr>									
						@endforeach
						</tbody>
					</table>
				</div>			
				<div id="rowDetails" style="display:none">
				@foreach($orders as $ind => $val)	
					<table class="table table-bordered mb-none datatable-details table-condensed" data-details-src="{{ $ind }}">
						<tbody>							
							<tr><td colspan="3">
							<div class="panel-group" id="paymentDetailAccordion" role="tablist" aria-multiselectable="true">
								@foreach($val as $in => $order)
								<div class="panel panel-default">
									<div class="background-{{ isset($order['package_type'])? strtolower($order['package_type']) : 'default' }}" role="tab" id="heading_{{ $in }}">
										<div class="panel-title">
											<a class="btn" data-toggle="collapse" data-parent="#paymentDetailAccordion" href="#sec_{{ $in }}" aria-expanded="true" aria-controls="sec_{{ $in }}" style="display:block">
												<span style="float:left">{{ $order['category'] }}</span>
												<span><strong>Price: </strong>{{$order['price'] }}</span>
												<span style="float:right"><strong>Discount Price: </strong>{{ $order['discount_price'] }}</span>
											</a>
										</div>
									</div>
									<div id="sec_{{ $in }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{{ $in }}">
									  <div class="panel-body">
										<table class="table table-bordered table-striped mb-none datatable-details">
											<thead>
												<tr>
													<th>sku</th>
													<th>Product Name</th>
													<th>Count</th>
													<th>Individual Price</th>
													<th>Package Price</th>
												</tr>
											</thead>
											<tbody>								
											@foreach($order['details'] as $item)
												<tr>
													<td>{{ $item->product_sku }}</td>
													<td>{{ $item->product }}</td>
													<td class="center">{{ $item->quantity }}</td>
													<td class="center">{{ $item->unit_price }}</td>
													<td class="center">{{ $item->discount_price }}</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									  </div>
									</div>
								</div>
								@endforeach
							</div>
							</td></tr>
						</tbody>
					</table	>
				@endforeach
				</div>
            @else
				<table class="table table-bordered">
					<tr><td class="col-sm-8 col-md-6"><h5>No data to show.</h5></td></tr>
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