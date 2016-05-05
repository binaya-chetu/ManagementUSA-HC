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
                <form role="form" method="POST" action="{{ url('/password/reset') }}">
                      {!! csrf_field() !!}
                    
					<input type="hidden" name="token" value="{{ $token }}">
					
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mb-lg">
                        <label>E-Mail Address</label>
                        <div class="input-group input-group-icon">
                            <input name="email" type="text" class="form-control input-lg" value="{{ $email or old('email') }}" />
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
                            <label class="pull-left">Password</label>
                        </div>
                        <div class="input-group input-group-icon">
                            <input name="password" type="password" class="form-control input-lg" />
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
                            <label class="pull-left">Confirm Password</label>
                        </div>
                        <div class="input-group input-group-icon">
                            <input name="password_confirmation" type="password" class="form-control input-lg" />
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
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-refresh"></i> Reset Password
                            </button>
                        </div>
                    </div>

                   

                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2016. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->

@endsection
