@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2> All Product Categories </h2>
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
        @if(Session::has('flash_message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
        @endif
        <div class="col-md-12">
             @foreach($categories as $category)
             <li><a  href="{{ url('/categories/categoryDetails/'.base64_encode($category->id))}}">{{$category->cat_name}}</a></li>
             @endforeach
        </div>
    </div>
</section>    
@endsection