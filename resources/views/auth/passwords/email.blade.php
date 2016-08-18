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
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                {{ Form::open(array('url' => '/password/email', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'login')) }}
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
                <div class="row">
                    <div class="col-sm-8 text-right">

                        {{ Form::button(
                                    'Send Password Reset Link',
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
<!-- end: page -->

@endsection
