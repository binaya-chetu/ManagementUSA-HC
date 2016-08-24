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
        {{ Form::open(['url' => '/sale/confirmation/'.base64_encode($patientCart['patient']->id), 'method' => "post", 'class'=>'form-horizontal', 'id' =>'checkoutForm' ]) }}
            {!! csrf_field() !!}
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
                    <p><span class="value">{{ $patientCart['patient']->first_name }} {{ $patientCart['patient']->last_name }}</span></p>
                    <address>{{ isset($patientCart->patient->patientDetail->phone) ? 'Contact :'.$patientCart->patient->patientDetail->phone : ''  }} <br/> 
                        {{ $patientCart->patient->email }}</address>
                </div>
                <div class="col-sm-6 mt-md text-right">
                    <p><span class="text-dark">Agent Detail:</span></p>
                    <p><span class="value">{{ $patientCart['user']->first_name }} {{ $patientCart['user']->last_name }}</span></p>                    
                </div>
            </div>
            <div class="row">                
                <div class="col-sm-12">
                    <h3>Patient Address</h3>
                </div>              
            </div>
            
            
             <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <label>Name :</label>
                        </div>
                        <div class="col-sm-8">
                            {{ $patientCart['patient']->first_name }} {{ $patientCart['patient']->last_name or '' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <label>Address :</label>
                        </div>
                        <div class="col-sm-8">
                            {{ $patientCart['patient']['patientDetail']->address1 or '' }} {{ $patientCart['patient']['patientDetail']->address2 or '' }}
                        </div>
                    </div>
                </div>   
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <label>City :</label>
                        </div>
                        <div class="col-sm-8">
                            {{ $patientCart['patient']['patientDetail']->city or '' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <label>State :</label>
                        </div>
                        <div class="col-sm-8">
                            {{  $patientCart->patient->patientDetail->patientStateName->name or '' }} 
                        </div>
                    </div>
                </div>   
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <label>Zip code :</label>
                        </div>
                        <div class="col-sm-8">
                            {{ $patientCart['patient']['patientDetail']->zipCode or '' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <label>Phone :</label>
                        </div>
                        <div class="col-sm-8">
                            {{  $patientCart['patient']['patientDetail']->phone or '' }} 
                        </div>
                    </div>
                </div>  
            
            <div class="row">                
                <div class="col-sm-12">
                    <h3>Cart Item Details</h3>
                </div>              
            </div>
                      
            <div class="table-responsive">
                <table class="table mb-none">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Category</th>
                            <th class="text-center">Price</th>
                        </tr>
                    </thead>
                    <tbody>			
                        <?php $count = 1; ?>
                        @foreach($category_list as $i => $cat)
                        <tr class="gradeX background-{{ isset($cat['category_type'])? strtolower($cat['category_type']) : 'default' }}" >
                            <td>{{ $count++ }}</td>
                            <td>{{ $cat['category'] }}</td>
                            <td class="center">${{ $discouonted_package_price[$i] }}</td>
                        </tr>									
                        @endforeach
                         <tr>
                            <td></td>
                            <td>Total</td>
                            <td class="center">${{ $total_cart_price }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
           
            
            <div class="row">                
                <div class="col-sm-12">
                    <h3>Payment Methods</h3>
                </div>              
            </div>
            
            <div class="row">
                <div class="form-group">
                    {{ Form::label('card', 'Payment Type', array('class' => 'col-sm-3 control-label mandatory')) }}
                    <div class="col-sm-6">
                         <?php   $method = ['0' => 'Cash In Hand', '1' => 'Credit Card']; ?>
                        {{ Form::select('payment_type', ['' => 'Please Select Payment Method']+$method, null, ['class' => 'form-control required', 'id' => 'paymentMethod']) }}                     
                    </div>
                </div>
                <div class='creditCard'> 
                    <div class="form-group">
                        {{ Form::label('cardholer', 'Cardholder Name', array('class' => 'col-sm-3 control-label')) }}
                        <div class="col-sm-6">
                            {{ Form::text('cardholder', null, ['class' => 'form-control required', 'placeholder' => 'Enter Cardholder Name', 'id' => 'address1', 'rows' => 3]) }}
                        </div>
                    </div>
                
                    <div class="form-group">
                        {{ Form::label('card', 'Select Card', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                             <?php  $card = ['master' => 'Master Card', 'visa' => 'Visa']; ?>
                            {{ Form::select('card', ['' => 'Please Select Card']+$card, null, ['class' => 'form-control input required']) }}                     
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('card', 'Expird On', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-3">
                            <?php $expYear = ['2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019'] ?>
                            {{ Form::select('year', ['' => 'Please Select Year']+$expYear,null, ['class' => 'form-control input required']) }}                     
                        </div>
                        <div class="col-sm-3">
                            <?php  $expMonth = ['01' => '01', '02' => '02', '03' => '03', '4' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12' ] ?>
                            {{ Form::select('month', ['' => 'Please Select Month']+$expMonth, null, ['class' => 'form-control input required']) }}                     
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('cvv', 'Enter CVV', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::text('cvv',null, ['class' => 'form-control input required', 'placeholder' => 'Enter CVV']) }}                     
                        </div>
                    </div>
                </div>
                <div class='cashInHand'> 
                    <div class="form-group">
                        {{ Form::label('amount', 'Enter Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::text('paid_amount', null, ['class' => 'form-control required', 'placeholder' => 'Enter Amount', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"]) }}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 col-md-offset-4">
                    {{ Form::button('<i class="fa fa-btn fa-user"></i> Place Order',['class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit']) }}
                    <a class="btn btn-default" href="#" onclick="window.history.go(-1);">Back</a>
                </div>
            </div>
        </footer>
        {{ Form::close() }}
    </section>
</section>
@endsection
