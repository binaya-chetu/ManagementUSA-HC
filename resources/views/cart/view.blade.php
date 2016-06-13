@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
<div class="row">
        <div class="col-lg-12">	
            <section class="panel panel-primary">
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
                @if(!empty($items[0]))
                @foreach($items as $item)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{ URL::asset('images/bronze.jpg')}}" style="width: 100px; height: 72px;"> </a>
                                <div class="media-body">
                                    &nbsp;&nbsp;<h4 class="media-heading">&nbsp;&nbsp;<a href="#">{{ $item->product->cat_name }}</a></h4>
                                </div>
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center">{{ $item->product->duration_months }}</td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$22</strong></td>
                        <td class="col-sm-1 col-md-1">
                            <a href="/removeItem/{{$item->id}}"> <button type="button" class="btn btn-danger">
                                    <span class="fa fa-remove"></span> Remove
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
 
                <tr>
                    <td>   </td>
                    <td>   </td>
                    
                    <td><h3>Total</h3></td>
                    <td class="text-right"><h3><strong>$22.00</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    
                    <td>
                        <button type="button" class="btn btn-success">
                            Checkout <span class="fa fa-play"></span>
                        </button>
                    </td>
                </tr>
                @else 
               <tr> There are no Items in  your Cart.</tr>
                @endif
                </tbody>
            </table>
          </section>
        </div>
    </div>
 </section>
@endsection
 