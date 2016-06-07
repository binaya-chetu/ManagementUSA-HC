<!-- @extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">     
        <h2> {{ $category[0]->cat_name }} </h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>List Categories</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">
       
           
        </div>
            </div>
        </section>    
@endsection -->

<style>
	.bronze{ background:#cd7f32; }
	.silver{ background:#C0C0C0;}
	.gold{ background:#DAA520; }
	.packages-table .table{ color:#333;}
	.packages-table .table-bordered > thead > tr > th, .packages-table .table-bordered > tbody > tr > td{text-align:center; vertical-align:middle !important;}

	.packages-table th:first-child{ text-align:center;}
	.packages-table .table-bordered > tbody > tr > td:first-child{ text-align:left; }
	.pricing-table h3.bronze {
	   background-color: #cd7f32;
	}
	.pricing-table h3.silver {
	   background-color: #C0C0C0;
	}
	.pricing-table h3.gold {
	   background-color: #DAA520;
	}
</style>

<section class="body">
	<div class="inner-wrapper">
	<section role="main" class="content-body">
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
					<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
				</div>
				<h2 class="panel-title"></h2>
			</header>
			<div class="panel-body">						
				<div class="table-responsive packages-table">
					<table class="table table-bordered pricing-table table-condensed mb-none">
						<thead>
							<tr>
								<th colspan="3">
									<h3>{{ $category[0]->cat_name }}</h3>
								</th>
								<th class="bronze plan" colspan="2">
									<h3 class="bronze">Bronze<span>${{ $details['Bronze']['total_price'] }}</span></h3>
									<a class="btn btn-lg btn-primary" href="#">Buy Now</a>
								</th>
								<th class="silver plan" colspan="2">
									<h3 class="silver">Silver<span>${{ $details['Silver']['total_price'] }}</span></h3>
									<a class="btn btn-lg btn-primary" href="#">Buy Now</a>
								</th>
								<th class="gold plan" colspan="2">
									<h3 class="gold">Gold<span>${{ $details['Gold']['total_price'] }}</span></h3>
									<a class="btn btn-lg btn-primary" href="#">Buy Now</a>
								</th>								
							</tr>
							<tr>
								<th>Nomenclature</th>
								<th >Unit of Measure</th>
								<th >Unit Price</th>
								<th class="bronze">Quantity Bronze</th>
								<th class="bronze">Package</th>
								<th class="silver">Quantity Silver</th>
								<th  class="silver">Package</th>
								<th class="gold">Quantity Gold</th>
								<th class="gold">Package</th>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $i => $v)

							<tr>
								<td> {{ $i }}</td>
								<td>{{ $v['unit_of_measurement'] }}</td>
								<td>{{ $v['price'] }}</td>
								<td class="bronze">
									@if(isset($v['Bronze']['count'])) {{ $v['Bronze']['count'] }} @endif
								</td>
								<td class="bronze">
									@if(isset($v['Bronze']['spl_price'])) {{ $v['Bronze']['spl_price']}} @endif
								</td>
								<td class="silver">
									@if(isset($v['Silver']['count'])) {{ $v['Silver']['count'] }} @endif
								</td>
								<td class="silver">
									@if(isset($v['Silver']['spl_price'])) {{ $v['Silver']['spl_price'] }} @endif
								</td>
								<td class="gold">
									@if(isset($v['Gold']['count'])) {{ $v['Gold']['count'] }} @endif
								</td>
								<td class="gold">
									@if(isset($v['Gold']['spl_price'])) {{ $v['Gold']['spl_price'] }} @endif
								</td>
							</tr>										
							@endforeach									
							<tr>
								<td colspan="3"><strong>Individual Purchage price</strong></td>
								<td class="bronze" colspan="2">
									<strong>
										{{ $details['Bronze']['ori_price'] }}
									</strong>
								</td>
								<td class="silver"  colspan="2">
									<strong>
										{{ $details['Silver']['ori_price'] }}
									</strong>
								</td>
								<td class="gold" colspan="2">
									<strong>
										{{ $details['Gold']['ori_price'] }}
									</strong>
								</td>
							</tr>
							<tr>
								<td colspan="3"><strong>Save</strong></td>
								<td class="bronze" colspan="2">
									<strong>
										{{ $details['Bronze']['ori_price'] - $details['Bronze']['total_price']  }}
									</strong>
								</td>
								<td class="silver"  colspan="2">
									<strong>
										{{ $details['Silver']['ori_price'] - $details['Silver']['total_price']  }}
									</strong>
								</td>
								<td class="gold" colspan="2">
									<strong>
										{{ $details['Gold']['ori_price'] - $details['Gold']['total_price']  }}
									</strong>
								</td>
							</tr>
							<tr>
								<td colspan="3"><strong>Package Total</strong></td>
								<td class="bronze" colspan="2"><strong>{{ $details['Bronze']['total_price'] }}</strong></td>
								<td class="silver"  colspan="2"><strong>{{ $details['Silver']['total_price'] }}</strong></td>
								<td class="gold"  colspan="2"><strong>{{ $details['Gold']['total_price'] }}</strong></td>
							</tr>
							
							 
						</tbody>
					</table>
				</div>
			</div>
		</section>

		<!-- end: page -->
	</section>
	</div>

	<aside id="sidebar-right" class="sidebar-right">
		<div class="nano">
			<div class="nano-content">
				<a href="#" class="mobile-close visible-xs">
					Collapse <i class="fa fa-chevron-right"></i>
				</a>

				<div class="sidebar-right-wrapper">

					<div class="sidebar-widget widget-calendar">
						<h6>Upcoming Tasks</h6>
						<div data-plugin-datepicker data-plugin-skin="dark" ></div>

						<ul>
							<li>
								<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
								<span>Company Meeting</span>
							</li>
						</ul>
					</div>

					<div class="sidebar-widget widget-friends">
						<h6>Friends</h6>
						<ul>
							<li class="status-online">
								<figure class="profile-picture">
									<img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
								</figure>
								<div class="profile-info">
									<span class="name">Joseph Doe Junior</span>
									<span class="title">Hey, how are you?</span>
								</div>
							</li>
							<li class="status-online">
								<figure class="profile-picture">
									<img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
								</figure>
								<div class="profile-info">
									<span class="name">Joseph Doe Junior</span>
									<span class="title">Hey, how are you?</span>
								</div>
							</li>
							<li class="status-offline">
								<figure class="profile-picture">
									<img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
								</figure>
								<div class="profile-info">
									<span class="name">Joseph Doe Junior</span>
									<span class="title">Hey, how are you?</span>
								</div>
							</li>
							<li class="status-offline">
								<figure class="profile-picture">
									<img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
								</figure>
								<div class="profile-info">
									<span class="name">Joseph Doe Junior</span>
									<span class="title">Hey, how are you?</span>
								</div>
							</li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</aside>
</section>

