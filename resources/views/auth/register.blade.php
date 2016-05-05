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
                <form role="form" method="POST" action="{{ url('/register') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} mb-lg">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control input-lg" value="{{ old('name') }}" />
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mb-lg">
                        <label>E-mail Address</label>
                        <input name="email" type="email" class="form-control input-lg" />
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} mb-none">
                        <div class="row">
                            <div class="col-sm-6 mb-lg">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control input-lg" />
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-6 mb-lg">
                                <label>Password Confirmation</label>
                                <input name="password_confirmation" type="password" class="form-control input-lg" />
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
                                    <input id="AgreeTerms" name="agreeterms" type="checkbox"/>
                                    <label for="AgreeTerms">I agree with <a href="#">terms of use</a></label>
                                </div>
                                @if ($errors->has('agreeterms'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('agreeterms') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-sm-4 text-right">
                                <button type="submit" class="btn btn-primary hidden-xs">Sign Up</button>
                                <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign Up</button>
                            </div>
                        </div>
                    </div>

                    <p class="text-center">Already have an account? <a href="{{ url('/') }}">Sign In!</a>

                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2016. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->

@endsection
