@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>API Setting</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('api.setting') !!}
            
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
                    <h2 class="panel-title">API Setting </h2>
                </header>	
                <div class="panel-body">
                    @if(Session::has('flash_message'))
                    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
                    @endif
                    @if(Session::has('error_message'))
                    <div class="alert alert-danger"><span class="glyphicon glyphicon-ok"></span><em> {!! session('error_message') !!}</em></div>
                    @endif
                    <!-- Display Validation Errors -->
                    {{ Form::open(array('url' => 'api/saveSetting', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'apiSetting')) }}
                    {{ csrf_field() }}
                    <div class="row">
                    <div class="col-sm-12 form-group{{ $errors->has('api_url') ? ' has-error' : '' }}">
                        {{ Form::label('api_url', 'API URL', array('class' => 'col-sm-2 control-label mandatory')) }}
                        <div class="col-sm-9">
                            @if(isset($data->id) && !empty($data->id))
                            {{ Form::hidden('setting_id', $data->id) }}
                            @endif
                            @if(isset($data->api_url) && !empty($data->api_url))
                            {{ Form::text('api_url', $data->api_url, ['class' => 'form-control required', 'id' => 'api-url', 'placeholder' => 'Enter API URL']) }}
                            @else 
                            {{ Form::text('api_url', null, ['class' => 'form-control required', 'id' => 'api-url', 'placeholder' => 'Enter API URL']) }}
                            @endif
                            @if ($errors->has('api_url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('api_url') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                        {{ Form::label('user_name', 'User Name', array('class' => 'col-sm-2 control-label mandatory')) }}
                         <div class="col-sm-5">
                             @if(isset($data->user_name) && !empty($data->user_name))
                             {{ Form::text('user_name', $data->user_name, ['class' => 'form-control required', 'id' => 'user_name', 'placeholder' => 'Enter User Name']) }}
                             @else 
                             {{ Form::text('user_name', null, ['class' => 'form-control required', 'id' => 'user_name', 'placeholder' => 'Enter User Name']) }}
                             @endif
                             @if ($errors->has('user_id'))
                             <span class="help-block">
                                 <strong>{{ $errors->first('user_name') }}</strong>
                             </span>
                             @endif
                         </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label mandatory')) }}
                        <div class="col-sm-5">
                             <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            @if(isset($data->password) && !empty($data->password))
                            {{ Form::input('password', 'password', $data->password,  ['class' => 'form-control input required', 'id' => 'password', 'placeholder' => 'Password']) }}
                            @else 
                            {{ Form::password('password', ['class' => 'form-control input required', 'id' => 'password', 'placeholder' => 'Password']) }}
                            @endif
                             </div>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
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
                                    '<i class="fa fa-plus"></i> Save Setting',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                            }}                               
                            <a href="{{ url('/') }}" class = 'mb-xs mt-xs mr-xs btn btn-default'>Cancel</a>
                        </div>
                    </div>
                </footer>
               {{ Form::close() }}
            </section>
        </div>
    </div>
</section>
@endsection

