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
                        <a class="panel-action panel-action-toggle" data-panel-toggle="" href="#"></a>
                        <a class="panel-action panel-action-dismiss" data-panel-dismiss="" href="#"></a>
                    </div>
                    <h2 class="panel-title">Cart Item </h2>
                </header>	
                <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th></th>
                    <th class="text-center">Duration</th>
                    <th class="text-center">Price</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @if(isset($items->id))
                    <tr>
                        <td class="col-sm-8 col-md-7">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{ URL::asset('images/bronze.jpg')}}" style="width: 100px; height: 100px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading">&nbsp;&nbsp;<a href="#">{{ $items->category->cat_name }}</a></h4>
                                </div>
                                
                                <table border="1" class="desc_tab">
                                    <thead>
                                        <tr>
                                            <th> Product Name </th>
                                            <th> Product SKU </th>
                                            <th> Single </th>
                                            <th> Quantity </th>
                                            <th> Single Total </th>
                                            <th> Package Price </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $single_total = 0; ?>
                                        @foreach($cart_items as $cart_item)
                                        <tr>
                                            <td>{{ $cart_item->product->name }}</td>
                                            <td>{{ $cart_item->product_sku }}</td>
                                            <td>${{ $cart_item->product->price }}</td>
                                            <td>{{ $cart_item->quantity }}</td>
                                           <?php $single_total += $cart_item->product->price * $cart_item->quantity; ?>
                                            <td>${{ $cart_item->product->price * $cart_item->quantity }}</td>
                                            <td>${{ $cart_item->total_price }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6">   &nbsp;&nbsp;&nbsp; </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>Individual Purchase Price &nbsp;&nbsp;&nbsp;${{ $single_total }}</strong></td>
                                            <td colspan="2"><strong>Save &nbsp;&nbsp;&nbsp;${{ $single_total - $items->package_price }}</strong></td>
                                            <td colspan="2"><strong>Package Price &nbsp;&nbsp;&nbsp;${{ $items->package_price }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center">{{ $items->category->duration_months }}</td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{ $items->package_price }}</strong></td>
                        <td class="col-sm-1 col-md-1">
                            <a href="/removeItem/{{$items->id}}"> <button type="button" class="btn btn-danger">
                                    <span class="fa fa-remove"></span> Remove
                                </button>
                            </a>
                        </td>
                    </tr>
                
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td> </td>
                    <td><h4>Discount</h3></td>
                    <td class="text-right"><h3><strong>${{ $items->discount_price }}</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td> </td>
                    <td><h4>Total Amount</h3></td>
                    <td class="text-right"><h3><strong>${{ $items->total_amount }}</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <button type="submit" class="btn btn-primary">
                            Checkout  <span class="fa fa-play"></span>
                        </button>
                    </td>
                </tr>
                @else 
                    <tr> <td class="col-sm-8 col-md-6"><h5>Your Cart is empty.</h5></td>
                    <td class="col-sm-8 col-md-6"><h5><a href="/categories/listCategories"> <button type="button" class="btn btn-default">
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