@extends('layouts.login')

@section('content')
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo pull-left">
            <img src="{{ URL::asset('images/logo.png')}}" height="54" alt="Porto Admin" />
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign Up</h2>
            </div>
            <div class="panel-body">
                    {{ Form::open(array('url' => '/register', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'login')) }}
                    {!! csrf_field() !!}
                     <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }} mb-none">
                        <div class="row">
                            <div class="col-sm-6 mb-lg">
                                {{ Form::label('first_name', 'First Name', array('class' => 'control-label mandatory')) }}
                                {{ Form::hidden('id') }}
                                {{ Form::text('first_name', null, ['class' => 'form-control input required', 'id' => 'first-name']) }}
                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-6 mb-lg">
                                {{ Form::label('last_name', 'Last Name', array('class' => 'control-label mandatory')) }}
                                {{ Form::text('last_name', null, ['class' => 'form-control input required', 'id' => 'last-name']) }}
                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mb-lg">
                        {{ Form::label('email', 'Email Address', array('class' => 'control-label mandatory')) }}
                        {{ Form::email('email', null, ['class' => 'form-control input required', 'id' => 'email']) }}
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} mb-none">
                        <div class="row">
                            <div class="col-sm-6 mb-lg">
                                {{ Form::label('password', 'Password', array('class' => 'control-label mandatory')) }}
                                {{ Form::password('password', ['class' => 'form-control input required', 'id' => 'password']) }}
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-6 mb-lg">
                                {{ Form::label('passwordcnf', 'Password Confirmation', array('class' => 'control-label mandatory')) }}
                                {{ Form::password('password_confirmation', ['class' => 'form-control input required', 'id' => 'password_confirmation']) }}
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('agreeterms') ? ' has-error' : '' }} mb-none">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="checkbox-custom checkbox-default">
                                    {{ Form::checkbox('agreeterms', 1, null, ['class' => 'form-control input required', 'id' => 'AgreeTerms']) }}
                                    <label for="AgreeTerms">I agree with <a href="#">terms of use</a></label>
                                </div>
                                @if ($errors->has('agreeterms'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('agreeterms') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-4 text-right">
                                {{ Form::button(
                                    'Sign Up',
                                    array(
                                        'class'=>'btn btn-primary hidden-xs',
                                        'type'=>'submit')) 
                                }}
                            </div>
                        </div>
                    </div>
                    <p class="text-center">Already have an account? <a href="{{ url('/') }}">Sign In!</a>
                        {{ Form::close() }}
                        </div>
                        </div>
                    <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2016. All Rights Reserved.</p>
            </div>
            </section>
            @endsection
            
