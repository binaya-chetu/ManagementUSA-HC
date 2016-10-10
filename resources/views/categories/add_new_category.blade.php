@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add New Category</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('categories.addNewCategory') !!}
            
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
                    <h2 class="panel-title">Add Category </h2>
                </header>	
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    {{ Form::open(array('url' => 'categories/saveCategory', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'newCategory')) }}
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('cat_name') ? ' has-error' : '' }}">
                        {{ Form::label('cat_name', 'Category Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::hidden('id') }}
                            {{ Form::text('cat_name', null, ['class' => 'form-control required', 'id' => 'cat-name', 'placeholder' => 'Category Name']) }}
                            @if ($errors->has('cat_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cat_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('duration_months') ? ' has-error' : '' }}">
                        {{ Form::label('duration_months', 'Duration', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            <?php $duration = durationInMonths(); ?>
                            {{ Form::select('duration_months', array_merge(['' => 'Please Select Duration'], $duration), null, ['class' => 'form-control required', 'id' => 'duration-month']) }}
                            @if ($errors->has('duration_months'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('duration_months') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                    
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                            {{ Form::button(
                                    '<i class="fa fa-plus"></i> Add Category',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                            }}                               
                            <a href="{{ url('/categories/listCategories') }}" class = 'mb-xs mt-xs mr-xs btn btn-default'>Cancel</a>
                        </div>
                    </div>
                </footer>
               {{ Form::close() }}
            </section>
        </div>
    </div>
</section>
@endsection

