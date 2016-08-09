@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Inventory </h2>
        <div class="right-wrapper pull-right">
            
            
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
                    <h2 class="panel-title"><strong>Edit Inventory</strong> </h2>
                </header>
               
                {!! Form::model($inventory, ['method' => 'post','url' => ['inventory/update', $inventory->id], 'id' => 'inventory']) !!}
                {{ csrf_field() }}
                {{ Form::hidden('id') }}
                <div class="panel-body">
                    <div class="row">
                        @if(Session::has('flash_message'))
                            <div class="alert alert-error"><span class="glyphicon glyphicon-cancel"></span><em>{!! session('flash_message') !!}</em></div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-9 form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                           {{ Form::label('quantity', 'Quantity', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-3">
                                {{ Form::hidden('id') }}
                                {{ Form::number('quantity', null, ['class' => 'form-control required', 'id' => 'quantity']) }}
                                @if ($errors->has('quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity') }}</strong>
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
                                    'Save',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                                }}                               
                                <a href='/inventory/index' class = 'mb-xs mt-xs mr-xs btn btn-default'>Cancel</a>
                        </div>
                    </div>
                </footer>
                {{ Form::close() }}
            </section>
        </div>
    </div>
</section>
@endsection

