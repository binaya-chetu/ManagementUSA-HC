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
                    <tr class="noDetail">
                        <td></td><td colspan="4">Total </td><td class="center">${{ number_format($total_cart_price, 2) }}</td>
                    </tr>
                </tbody>
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
                    <h3>Payment Methods</h3>
                </div>              
            </div>

            <div class="row">
                <div class="form-group">
                    {{ Form::label('card', 'Payment Type', array('class' => 'col-sm-3 control-label mandatory')) }}
                    <div class="col-sm-6">
                        <?php $method = ['0' => 'Cash In Hand', '1' => 'Credit Card']; ?>
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
                            <?php $card = ['master' => 'Master Card', 'visa' => 'Visa']; ?>
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
                            <?php $expMonth = ['01' => '01', '02' => '02', '03' => '03', '4' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12'] ?>
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
                            {{ Form::text('paid_amount', null, ['class' => 'form-control required', 'placeholder' => 'Enter Amount', 'id' => 'paid_amount', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"]) }}
                        </div>                        
                    </div>  
                    <div class="form-group" id="emi_option">
                        <label class="col-sm-12 control-label" for="amount"><center>You have entered less amount, Please select a <a href="javascript:void(0)" class="emi_popuup">EMI options</a></center></label>
                    </div>
                </div>
            </div>

            <!-- Dialog -->
            <div id="checkoutPopup" class="modal-block modal-block-primary mfp-hide"> 
                <section class="panel panel-primary">
                    <header class="panel-heading">
                        <h2 class="panel-title">Select EMI's Option</h2>
                    </header>
                    <div class="panel-body">        

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-12 errorEMI">*Please select an EMI's option </label>

                                <div class="radio">
                                    <label>
                                        {{ Form::radio('emi', 3, false, ['class' => 'emiRadio', 'id' =>'radio1' ]) }}
                                        <span>$100/month for 3 EMIs</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('emi', 6, false, ['class' => 'emiRadio', 'id' =>'radio2']) }}
                                        <span>$100/month for 3 EMIs</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('emi', 9, false, ['class' => 'emiRadio', 'id' =>'radio3']) }}
                                        <span>$100/month for 3 EMIs</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('emi', 12, false, ['class' => 'emiRadio', 'id' =>'radio4']) }}
                                        <span>$100/month for 3 EMIs</span>
                                    </label>
                                </div>
                            </div>                        
                        </div> 

                    </div>
                    <footer class="panel-footer">
                        <div class="row">                  
                            <div class="col-md-8 text-right">                                
                                {{ Form::button( 'Select', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'button', 'id' => 'emiSubmit')) }}                
                                <button class="btn btn-default closePop">Cancel</button>
                            </div>
                        </div>
                    </footer>
                </section>
            </div>

        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 col-md-offset-4">
                    {{ Form::hidden('remaining_amount', 0.00, [ 'id' => 'remaining_amount']) }}
                    {{ Form::hidden('emi_month', null, [ 'id' => 'emi_month']) }}
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
            } else if (parseFloat(amount) < parseFloat(original_price)) {
                var emi_plan_value = $('#emi_month').val();
                if(emi_plan_value == ''){
                    alert("Please select an EMI's option from the Emi link.");
                    $('#emi_option').show();
                    return false;
                }                
            }else{
                $('#emi_month').val('');
                $('input[name="emi"]').val('');
            }
        }
    });
    $('#paid_amount').on('blur', function() {
        var amount = $(this).val();
        if(amount != ''){
            if (parseFloat(amount) < parseFloat(original_price)) {
                var remaining = parseFloat(original_price) - parseFloat(amount);
                if(parseFloat(remaining) < parseFloat(original_price)){
                    $('#remaining_amount').val(parseFloat(remaining).toFixed(2));
                    
                    var quarter = parseFloat(parseFloat(remaining) / 3, 2); 
                    var str1 = "$" + quarter.toFixed(2)+ "/month for 3 EMI's";
                    $('#radio1').siblings().text(str1);
                    //$('#radio1').value(quarter.toFixed(2));
                    
                    var half = parseFloat(parseFloat(remaining) / 6, 2); 
                    var str2 = "$" + half.toFixed(2)+ "/month for 6 EMI's";
                    $('#radio2').siblings().text(str2);
                    //$('#radio2').value(half.toFixed(2));
                    
                    var third_quarter = parseFloat(parseFloat(remaining) / 9, 2); 
                    var str3 = "$" + third_quarter.toFixed(2)+ "/month for 9 EMI's";
                    $('#radio3').siblings().text(str3);
                    //$('#radio3').value(third_quarter.toFixed(2));
                    
                    var yearly = parseFloat(parseFloat(remaining) / 12, 2); 
                    var str4 = "$" + yearly.toFixed(2)+ "/month for 12 EMI's";
                    $('#radio4').siblings().text(str4);
                    //$('#radio4').value(yearly.toFixed(2));
                }
            }
        }
    });
</script>
@endsection
