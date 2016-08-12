@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">

        <h2>Checkout Page</h2>
        </h2>

        <div class="right-wrapper pull-right appt_list">
            @if(Request::segment(2) === 'upcomingappointments')
            {!! Breadcrumbs::render('appointment.upcomingappointments') !!}
            @else
            {!! Breadcrumbs::render('appointment.listappointment') !!}
            @endif
        
        </div>
    </header>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>
            <h2 class="panel-title">Checkout</h2>

        </header>
        <div class="panel-body">
            <div class="row">
                @if(Session::has('flash_message'))
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @endif
                @if(Session::has('error_message'))
                    <div class="col-sm-12"><div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><em> {!! session('error_message') !!}</em></div></div>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-6 mt-md">
                    <p><span class="text-dark">Patient Detail:</span></p>
                    <p><span class="value">Vipul Kumar</span></p>
                    <address>Envato <br/>121 King Street, Melbourne, Australia <br/> Phone: +61 3 8376 6284 <br/> info@envato.com</address>
                </div>
                <div class="col-sm-6 mt-md text-right">
                    <p><span class="text-dark">Seller Detail:</span></p>
                    <p><span class="value">Raaj Chauhan</span></p>
                    <address>Envato <br/>121 King Street, Melbourne, Australia <br/> Phone: +61 3 8376 6284 <br/> info@envato.com</address>
                </div>
            </div>
            <div class="row">
                {{ Form::open(array('url' => '/apptsetting/saveAppointment', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'addApptRequest')) }}
                {!! csrf_field() !!}
                <div class="col-sm-12">
                    <h3>Billing Address</h3>
                </div>
                <div class="form-group" id='emailParent'>
                    {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            {{ Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
                        </div>

                    </div>
                </div>
                {{ Form::close() }}
            </div>
            
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 col-md-offset-4">
                    {{ Form::button(
                            '<i class="fa fa-btn fa-user"></i>  Save Details',
                            array(
                                'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                'type'=>'submit'))
                    }}
                </div>
            </div>
        </footer>
    </section>
</section>
@endsection
