@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Add New Role</h2>
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
                    <h2 class="panel-title">Add Role </h2>
                </header>	
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    {{ Form::open(array('url' => 'saveRole', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'addRole')) }}
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('role_title') ? ' has-error' : '' }}">
                        {{ Form::label('role_title', 'Role Title', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::hidden('id') }}
                            {{ Form::text('role_title', null, ['class' => 'form-control required', 'id' => 'role-title', 'placeholder' => 'Role Title']) }}
                            @if ($errors->has('role_title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('role_title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                    
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                            {{ Form::button(
                                    '<i class="fa fa-plus"></i> Add Role',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                            }}                               
                            <a href="{{ url('/acl/listRole') }}" class = 'mb-xs mt-xs mr-xs btn btn-default'>Cancel</a>
                        </div>
                    </div>
                </footer>
               {{ Form::close() }}
            </section>
        </div>
    </div>
</section>
@endsection

