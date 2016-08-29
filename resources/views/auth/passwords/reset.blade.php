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
                <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Reset Password</h2>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => '/password/reset', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'login')) }}
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mb-lg">
                    {{ Form::label('email', 'E-Mail Address', array('class' => 'control-label mandatory')) }}
                    <div class="input-group input-group-icon">
                        {{ Form::email('email', $email, ['class' => 'form-control input required', 'id' => 'email']) }}
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

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} mb-lg">
                    <div class="clearfix">

                        {{ Form::label('passwordcnf', 'Confirm Password', array('class' => 'control-label pull-left mandatory')) }}
                    </div>
                    <div class="input-group input-group-icon">
                        {{ Form::password('password_confirmation', ['class' => 'form-control input required', 'id' => 'password_confirmation']) }}
                        <span class="input-group-addon">
                            <span class="icon icon-lg">
                                <i class="fa fa-lock"></i>
                            </span>
                        </span>

                    </div>
                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-8 text-right">
                        {{ Form::button(
                                    'Reset Password',
                                    array(
                                        'class'=>'btn btn-primary',
                                        'type'=>'submit')) 
                        }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2016. All Rights Reserved.</p>
    </div>
</section>
@endsection
