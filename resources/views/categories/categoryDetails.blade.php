<!-- @extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">     
        <h2> {{ $category->cat_name }} </h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('categories.categoryDetails', $category->id) !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">
       
           
        </div>
            </div>
        </section>    
@endsection -->

<section class="body">
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <section class="panel panel-primary">
                <header class="panel-heading">                   
                    <h2 class="panel-title">Package details<a class='saleAnchor' ><i class="fa fa-cart-plus cartLink" title="Go To Cart Page"><span class="badge">0</span></i></a> </h2>
                </header>
                <div class="panel-body">       
                {{ Form::open(array('url' => '/apptsetting/saveAppointment', 'method' => "post", 'class'=>'form-horizontal')) }}
                    @if(Session::has('flash_message'))
                    <div class="alert alert-warning"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
                    @endif
                    <div class="col-sm-12"><div class="alert showSellMessage"><em></em></div></div>
                    <div class="form-group">
                        {{ Form::label('Select Patient', null, array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-md-6">
                            <select  class="form-control chosen" name="patient_id" id='front_sale_patient'>
                                <option value="">Choose A Patient</option>
                                @foreach ($patients as $patient)
                                <option {{ old('patient_id') == $patient->id ? 'selected="selected"' :'' }} value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive packages-table">
                        <table class="table table-bordered pricing-table table-condensed mb-none">
                            <thead>
                                <tr>
                                    <th colspan="3">
                            <h3>{{ $category->cat_name }}</h3>
                            </th>
                            <th class="bronze plan" colspan="2">
                            <h3 class="bronze">Bronze<span>${{ $details['Bronze']['total_price'] }}</span></h3>
                                <input type="hidden" name="category_id" value="{{ $category->id }}" />
                                <input type="hidden" name="category_type" value="1" />
                                <p align="center"><a class='btn btn-lg btn-primary addPackageToCart' data-cat-value="{{ $category->id }}" data-pkg-val="{{ config("constants.BRONZE_PKG_ID") }}">Buy Now</a>
<!--                                    {{ Form::button('Buy Now', ['class' => 'btn btn-lg btn-primary']) }}-->
                                </p>
                            </th>
                            <th class="silver plan" colspan="2">
                            <h3 class="silver">Silver<span>${{ $details['Silver']['total_price'] }}</span></h3>
                                <p align="center"><a class='btn btn-lg btn-primary addPackageToCart' data-cat-value="{{ $category->id }}" data-pkg-val="{{ config("constants.SILVER_PKG_ID") }}">Buy Now</a>
                            </th>
                            <th class="gold plan" colspan="2">
                            <h3 class="gold">Gold<span>${{ $details['Gold']['total_price'] }}</span></h3>
                            <p align="center"><a class='btn btn-lg btn-primary addPackageToCart' data-cat-value="{{ $category->id }}" data-pkg-val="{{ config("constants.GOLD_PKG_ID") }}">Buy Now</a>
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
                    {{ Form::close() }}
                </div>
            </section>

            <!-- end: page -->
        </section>
    </div>
</section>

