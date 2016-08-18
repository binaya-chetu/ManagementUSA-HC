@extends('layouts.login')

@section('content')
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo pull-left">
            <img src="{{ URL::asset('images/logo.jpg')}}" height="54" alt="Porto Admin" />
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
            </div>
            <div class="panel-body">
                 @if(Session::has('flash_message'))
                    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
                @endif	
                {{ Form::open(array('url' => '/login', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'login')) }}
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mb-lg">
                    {{ Form::label('email', 'Email', array('class' => 'control-label mandatory')) }}
                    <div class="input-group input-group-icon">
                        {{ Form::email('email', null, ['class' => 'form-control input required', 'id' => 'email']) }}
                        <span class="input-group-addon">
                            <span class="icon icon-lg">
                                <i class="fa fa-user"></i>
                            </span>
                        </span>
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} mb-lg">
                    <div class="clearfix">
                        {{ Form::label('password', 'Password', array('class' => 'control-label pull-left mandatory')) }}
                        <a href="{{ url('/password/reset') }}" class="pull-right">Lost Password?</a>
                    </div>
                    <div class="input-group input-group-icon">
                        {{ Form::password('password', ['class' => 'form-control input required', 'id' => 'password']) }}
                        <span class="input-group-addon">
                            <span class="icon icon-lg">
                                <i class="fa fa-lock"></i>
                            </span>
                        </span>
                    </div>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="checkbox-custom checkbox-default">
                            {{ Form::checkbox('remember', 1, null, ['class' => 'form-control input', 'id' => 'RememberMe']) }}
                            {{ Form::label('Remember Me', 'Remember Me') }}
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        {{ Form::button(
                                    'Sign In',
                                    array(
                                        'class'=>'btn btn-primary hidden-xs',
                                        'type'=>'submit')) 
                        }}
                    </div>
                </div>
                <p class="text-center">Don't have an account yet? <a href="{{ url('/register') }}">Sign Up!</a>
                    {{ Form::close() }}
            </div>
        </div>
        <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2016. All Rights Reserved.</p>
    </div>
</section>
@endsection
