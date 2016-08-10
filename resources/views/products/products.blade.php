@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>All Products</h2>

        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('products.showInventory') !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Product List</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                @if(Session::has('flash_message'))
                    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
                @endif
                @if(Session::has('error_message'))
                    <div class="alert alert-warning"><span class="glyphicon glyphicon-ok"></span><em>{!! session('error_message') !!}</em></div>
                @endif
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>sku</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Count</th>						
                        <th>Action</th>						
                    </tr>
                </thead>
                <tbody>
				@foreach($products as $product)
                    <tr data-product="{{ $product->id }}">
                        <td class="table-text table-text-id product_sku">{{ $product->sku }}</td>
                        <td class="table-text product_name">{{ $product->name }}</td>
                        <td class="table-text product_price">{{ $product->price }}</td>
                        <td class="table-text product_count {{ ($product->count == 0)? 'alert-danger' : '' }}">{{ $product->count }}</td>
                        <td class="actions">
                            <a href="#modalEditProduct" class="on-editing save-row pInventoryEdit_popup" title="Edit"><i class="fa fa-pencil"></i></a>
                            <!--a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a-->
                        </td>
                    </tr>					
				@endforeach
                </tbody>
            </table>
        </div>
    </section>
</section>
<!-- Modal Form -->
<div id="modalEditProduct" class="modal-block modal-block-primary mfp-hide">
	{{ Form::open(array('url' => '#', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'editProductInventoryForm')) }}
      {!! csrf_field() !!}      
    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Edit Product</h2>
        </header>
        <div class="panel-body">
			<div class="form-group"> 
				{{ Form::label('sku', 'Product sku', array('class' => 'col-sm-4 control-label mandatory')) }}
				<div class="input-group">
					{{ Form::text('sku', null, ['class' => 'form-control required', 'readonly' => 'readonly']) }}
				</div>
			</div>	
			<div class="form-group"> 
				{{ Form::label('pName', 'Product Name', array('class' => 'col-sm-4 control-label mandatory')) }}			
				<div class="input-group">
					{{ Form::text('pName', null, ['class' => 'form-control required']) }}
				</div>
			</div>
			<div class="form-group"> 
				{{ Form::label('price', 'Price', array('class' => 'col-sm-4 control-label mandatory')) }}			
				<div class="input-group">
					{{ Form::text('price', null, ['class' => 'form-control required']) }}
				</div>
			</div>
			<div class="form-group"> 
				{{ Form::label('count', 'Count', array('class' => 'col-sm-4 control-label mandatory')) }}			
				<div class="input-group">
					{{ Form::text('count', null, ['class' => 'form-control required']) }}
				</div>
			</div>
        </div>
        <footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 col-md-offset-4">
					{{ Form::button(
						'<i class="fa fa-btn fa-user"></i>  Save Details',
						array('class'=>'mb-xs mt-xs mr-xs btn btn-primary','type'=>'submit'))
					}}
					<button class="btn btn-default closePop">Cancel</button>
				</div>
			</div>			
        </footer>
    </section>
    {{ Form::close() }}
</div>
<style>
    .call_label { padding-top:0px !important; }
</style>
<script>
/*     $('document').ready(function() {
        $('#reasonCode').hide();
        $('#callStatus').validate();
    })
    $('#callStatus').on('submit', function() {
        return false;
    }); */
    $('.pInventoryEdit_popup').on('click', function() {
		var tr = $(this).closest('tr');
		var form = $("#editProductInventoryForm");
		form.find('input[name=sku]').val($.trim(tr.find('.product_sku').html())); 
		form.find('input[name=pName]').val($.trim(tr.find('.product_name').html())); 
		form.find('input[name=price]').val($.trim(tr.find('.product_price').html())); 
		form.find('input[name=count]').val($.trim(tr.find('.product_count').html())); 
        $.magnificPopup.open({
            items: {
                src: '#modalEditProduct',
                type: 'inline'
            }
        });
    });
/*     $('.callStatus').on('click', function() {
        var call_value = $(this).val();
        if (call_value === 'Set') {
            $('#reasonCode').hide();
        } else {
            $('#reasonCode').show();
        }
    });
 */
</script>
@endsection