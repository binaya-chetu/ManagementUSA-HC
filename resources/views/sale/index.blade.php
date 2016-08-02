@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">       
        <h2>Front Office Sale </h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('apptsetting.index') !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">
            {{ Form::open(array('url' => '/apptsetting/saveAppointment', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'addApptRequest')) }}
            {!! csrf_field() !!}            
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Front Office Sale</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        @if(Session::has('flash_message'))
                            <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                        @endif
                        @if(Session::has('error_message'))
                            <div class="col-sm-12"><div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><em> {!! session('error_message') !!}</em></div></div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                      
                        {{ Form::label('Select Patient', null, array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-md-6">
                                <select  class="form-control chosen" name="patient_id" id="patient_id">
                                    <option value="">Choose A Patient</option>
                                    @foreach ($patients as $patient)
                                        <option {{ old('patient_id') == $patient->id ? 'selected="selected"' :'' }} value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                       
                    </div>
					
				<div class="row">

<style>
.categoryCartList .toggle-content h4, .categoryCartList .toggle-content a{
    text-align: center;
    color: #fff;
	text-transform: capitalize	
}

.addPackageToCart{
	cursor: pointer;
}
</style>							
			
<div class="col-md-6 categoryCartList">
	<div class="toggle" data-plugin-toggle>
	@foreach ($lCat as $i => $cat)
		<section class="toggle" data-cat-value="{{ $cat['id'] }}">
			<label>{{ $cat['cat_name'] }}</label>
			<div class="toggle-content">
				<div class="col-md-4 col-sm-4 col-xs-4 bronze">
					<h4>bronze</h4>
					<h4><i data-cat-value="{{ $cat['id'] }}" data-pkg-val="{{ config("constants.BRONZE_PKG_ID") }}" class="fa fa-cart-plus addPackageToCart" aria-hidden="true" title="Add to cart"></i></h4>
					<a href="#">View Details</a>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 silver">
					<h4>Silver</h4>
					<h4><i data-cat-value="{{ $cat['id'] }}" data-pkg-val="{{ config("constants.SILVER_PKG_ID") }}" class="fa fa-cart-plus addPackageToCart" aria-hidden="true" title="Add to cart"></i></h4>
					<a href="#">View Details</a>	
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 gold">
					<h4>gold</h4>
					<h4><i data-cat-value="{{ $cat['id'] }}" data-pkg-val="{{ config("constants.GOLD_PKG_ID") }}" class="fa fa-cart-plus addPackageToCart" aria-hidden="true" title="Add to cart"></i></h4>
					<a href="#">View Details</a>	
				</div>
			</div>
		</section>
	@endforeach
	</div>
</div>	
						
<div class="col-md-6 categoryCartList">
	<div class="toggle" data-plugin-toggle>
		@foreach ($rCat as $i => $cat)
			<section class="toggle" data-cat-value="{{ $cat['id'] }}">
				<label>{{ $cat['cat_name'] }}</label>
				<div class="toggle-content">
					<div class="col-md-4 col-sm-4 col-xs-4 bronze">
						<h4>bronze</h4>
						<h4><i data-cat-value="{{ $cat['id'] }}" data-pkg-val="{{ config("constants.BRONZE_PKG_ID") }}" class="fa fa-cart-plus addPackageToCart" aria-hidden="true" title="Add to cart"></i></h4>
						<a href="#">View Details</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 silver">
						<h4>Silver</h4>
						<h4><i data-cat-value="{{ $cat['id'] }}" data-pkg-val="{{ config("constants.SILVER_PKG_ID") }}" class="fa fa-cart-plus addPackageToCart" aria-hidden="true" title="Add to cart"></i></h4>
						<a href="#">View Details</a>	
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 gold">
						<h4>gold</h4>
						<h4><i data-cat-value="{{ $cat['id'] }}" data-pkg-val="{{ config("constants.GOLD_PKG_ID") }}" class="fa fa-cart-plus addPackageToCart" aria-hidden="true" title="Add to cart"></i></h4>
						<a href="#">View Details</a>	
					</div>
				</div>
			</section>
		@endforeach
	</div>
</div>				
				
				
				
				
				






				</div>             
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4">
                            {{ Form::button(
                                    '<i class="fa fa-btn fa-user"></i>  Buy Now',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit'))
                            }}
                        </div>
                    </div>
                </footer>
            </section>
            {{ Form::close() }}

        </div>
    </div>
</section>
@endsection
