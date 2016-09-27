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

            @if(isset($category_list) && !empty($category_list))
            <table class="table table-bordered mb-none removeSearchBox" id="cartItemList">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Agent</th>
                        <th>Patient</th>
                        <th class="text-center">Duration</th>
                        <th class="text-center">Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>					
                    @foreach($category_list as $i => $cat)
                    <tr class="gradeX background-{{ isset($cat['category_type'])? strtolower($cat['category_type']) : 'default' }}" data-details-table = '{{ $i }}'>
                        <td>{{ $cat['category'] }}</td>
                        <td>{{ $cat['user'] }}</td>
                        <td>{{ $cat['patient'] }}</td>
                        <td class="center">{{ $cat['duration'] }}</td>
                        <td class="center">${{ number_format($discouonted_package_price[$i], 2) }}</td>
                        <td class="center">
                            <a data-href="/cart/removeItem/{{ base64_encode($i) }}" href="javascrpt:void(0)" class="on-default remove-row confirmation-callback" data-original-title="Remove from cart" title="Remove from cart">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </td>
                    </tr>									
                    @endforeach
                </tbody>
				<tfoot>
                    <tr class="noDetail">
                        <td></td><td colspan="4">Total </td><td class="center">${{ number_format($total_cart_price, 2) }}</td>
                    </tr>				
				</tfoot>
            </table>

            <div id="rowDetails" style="display:none">
                @foreach($category_detail_list as $ind => $val)	
                <table class="table table-bordered table-striped mb-none datatable-details" data-details-src="{{ $ind }}">
                    <thead>
                        <tr>
                            <th>sku</th>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Count</th>
                            <th>Individual Price</th>
                            <th>Package Price</th>
                        </tr>
                    </thead>
                    <tbody>								
                        @foreach($val as $item)
                        <tr>
                            <td>{{ $item['sku'] }}</td>
                            <td>{{ $item['product'] }}</td>
                            <td class="center">{{ $item['unit_of_measurement'] }}</td>
                            <td class="center">{{ $item['count'] }}</td>
                            <td class="center">${{ number_format($item['original_price'], 2) }}</td>
                            <td class="center">${{ number_format($item['discount_price'], 2) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td colspan="4"><strong>Total price</strong></td>
                            <td>${{ number_format($original_package_price[$ind], 2) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="4"><strong>Total discouont</strong></td>
                            <td>${{ number_format($package_discount[$ind], 2) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="4"><strong>Discounted package price</strong></td>
                            <td>${{ number_format($discouonted_package_price[$ind], 2) }}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach				
            </div>
            @else
            <table class="table table-bordered">
                <tr><td class="col-sm-8 col-md-6"><h5>Your Cart is empty.</h5></td>
                    <td class="col-sm-8 col-md-6" colspan=2><h5><a href="/sale/index"> <button type="button" class="btn btn-default">
                                    <span class="fa fa-shopping-cart"></span> Continue Shopping
                                </button>
                            </a></h5></td>
                </tr>
            </table>	
            @endif

            <div class="row">                
                <div class="col-sm-12">
                    <h3>Payment Details</h3>
                </div>              
            </div>
            
            @if(!empty($uncompletedPayment['data']))
                <div class="table-responsive">   
                    <table class="table table-bordered table-striped mb-none">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Payment Type</th>
                                <th>Payment Time</th>                        
                                <th>Paid Amount</th>                                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($uncompletedPayment['data'] as $pay)
                            <tr>
                                <td class="table-text"><div>{{ $i++ }}</div></td>
                                <td class="table-text"><div>
                                        @if($pay['payment_type'] == 0)
                                        Cash in Hand
                                        @elseif($pay['payment_type'] == 1)
                                        Credit Card
                                        @endif
                                    </div></td>
                                <td class="table-text"><div>{{ date('d F Y H:ia', strtotime($pay['created_at'])) }}</div></td>   
                                <td class="table-text"><div>${{ $pay['paid_amount'] }}</div></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="table-text"><div>Total</div></td>
                                <td class="table-text"><div></div></td>
                                <td class="table-text"><div></div></td>   
                                <td class="table-text"><div>${{ $uncompletedPayment['total'] }}</div></td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            @endif

            <div class="row tablePad">
                <div class="form-group">
                    {{ Form::label('card', 'Payment Type', array('class' => 'col-sm-3 control-label mandatory')) }}
                    <div class="col-sm-6">
                        <?php $method = ['0' => 'Cash', '1' => 'Credit Card']; ?>
                        {{ Form::select('payment_type', ['' => 'Please Select Payment Method']+$method, null, ['class' => 'form-control required', 'id' => 'paymentMethod']) }}                     
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('selectemi', 'Select EMI', array('class' => 'col-sm-3 control-label')) }}
                    <div class="col-sm-6">                      
                        {{ Form::checkbox('selectemi', null, null) }}                     
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('amount', 'Enter Amount($)', array('class' => 'col-sm-3 control-label mandatory')) }}
                    <div class="col-sm-6">
                        {{ Form::text('paid_amount', number_format($total_cart_price, 2), ['class' => 'form-control required', 'placeholder' => 'Enter Amount', 'id' => 'paid_amount', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"]) }}
                    </div>                        
                </div>      
                <div class='creditCard'> 
                    <div class="form-group">
                        
                        {{ Form::label('cardholer', 'Cardholder Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-3">
                            {{ Form::text('first_name', null, ['class' => 'form-control required', 'placeholder' => 'First Name', 'id' => 'first_name']) }}
                        </div>
                         <div class="col-sm-3">
                            {{ Form::text('last_name', null, ['class' => 'form-control required', 'placeholder' => 'Last Name', 'id' => 'last_name']) }}
                        </div>
                    </div>

<!--                    <div class="form-group">
                        {{ Form::label('card', 'Select Card', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            <?php $card = ['master' => 'Master Card', 'visa' => 'Visa']; ?>
                            {{ Form::select('card', ['' => 'Please Select Card']+$card, null, ['class' => 'form-control input required']) }}                     
                        </div>
                    </div>-->
                    <div class="form-group">
                        {{ Form::label('card', 'Card Number', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::text('card_number', null, ['class' => 'form-control required', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');", 'maxlength' => '16']) }}                     
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('card', 'Expird On', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-3">
                           <?php $exp = cardYear(); ?>
                            {{ Form::select('year', ['' => 'Please Select Year']+$exp,null, ['class' => 'form-control input required']) }}                     
                        </div>
                        <div class="col-sm-3">
                            <?php $expMonth = ['01' => '01', '02' => '02', '03' => '03', '4' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12'] ?>
                            {{ Form::select('month', ['' => 'Please Select Month']+$expMonth, null, ['class' => 'form-control input required']) }}                     
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('cvv', 'Enter CVV', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::text('cvv',null, ['class' => 'form-control input required', 'placeholder' => 'Enter CVV', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');", 'maxlength' => '4']) }}                     
                        </div>
                    </div>
                </div>
<!--                <div class='cashInHand'> 
                    <div class="form-group">
                        {{ Form::label('amount', 'Enter Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::text('paid_amount', null, ['class' => 'form-control required', 'placeholder' => 'Enter Amount', 'id' => 'paid_amount', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"]) }}
                        </div>                        
                    </div>                    
                </div>-->
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 col-md-offset-4">                    
                    {{ Form::hidden('total_amount', $total_cart_price, [ 'id' => 'total_amount']) }}
                    {{ Form::button('<i class="fa fa-btn fa-user"></i> Place Order',['class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit']) }}
                    <a class="btn btn-default" href="#" onclick="window.history.go(-1);">Back</a>
                </div>
            </div>
        </footer>
        {{ Form::close() }}
    </section>
</section>


<script>
    
    var original_price = '<?php echo $total_cart_price; ?>';
    $('#checkoutForm').on('submit', function() {
       
        var amount = $('#paid_amount').val();
        var payment_method = parseFloat($('#paymentMethod').val());
        
        if (payment_method === 0) {

            if (parseFloat(amount) > parseFloat(original_price))
            {
                alert("Paid amount shouldn't more than total order price.");
                return false;
            }
        }
    });

</script>
@endsection
