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
                <form role="form" method="POST" action="{{ url('/password/email') }}">
                      {!! csrf_field() !!}
                    
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mb-lg">
                        <label>Email</label>
                        <div class="input-group input-group-icon">
                            <input name="email" type="text" class="form-control input-lg" value="{{ old('email') }}" />
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
							<button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
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
