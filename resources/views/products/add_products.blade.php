@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add New Products</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/">
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
                    <h2 class="panel-title"><strong>Upload product list file(.xlxs) </strong> </h2>
                </header>	
                 {{ Form::open(array('url' => 'products/saveProducts', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'addproducts', 'files' => true)) }}
                <div class="panel-body">
                <!-- Display Validation Errors -->
                    {{ csrf_field() }}
                    <div class="row">
						@if(Session::has('error_message'))
							<div class="col-sm-12">
								<div class="alert alert-danger">
									<span class="glyphicon glyphicon-ok"></span>
									<em> {!! session('error_message') !!}</em>
								</div>
							</div>
						@elseif(Session::has('success_message'))
							<div class="col-sm-12">
								<div class="alert alert-success">
									<span class="glyphicon glyphicon-ok"></span>
									<em> {!! session('success_message') !!}</em>
								</div>
							</div>						
						@endif					
                        <div class="col-sm-6 form-group{{ $errors->has('productFile') ? ' has-error' : '' }}">
							{{ Form::label('productFile', 'Product List', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
								{{ Form::file('productFile', ['class' => 'form-control required', 'id' => 'productFile']) }}	
                                @if ($errors->has('productFile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('productFile') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
	                </div>
				</div>
                 <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                                {{ Form::button(
                                    '<i class="fa fa-plus"></i> Add Patient',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                                }}                               
								
                                {{ Form::button(
									'Reset',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-default',
                                        'type'=>'reset')) 
                                }}
                            </div>
                    </div>
                </footer>
                 {{ Form::close() }}
            </section>
        </div>
    </div>
</section>
@endsection

