@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">       
        <h2>Checkout Confirmation</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('apptsetting.index') !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">

            <section class="panel panel-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Checkout Confirmation </h2>                    
                </header>
                <div class="panel-body" id="confirmPageBody">
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
                            <address>{{ $patientCart->patient->patientDetail->address1 }}<br> {{ $patientCart->patient->patientDetail->address2 }} {{ $patientCart->patient->patientDetail->city }} 
                                @if(isset($patientCart->patient->patientDetail->patientStateName->name))
                                {{ $patientCart->patient->patientDetail->patientStateName->name }}
                                @endif<br/> 
                                {{ isset($patientCart->patient->patientDetail->phone) ? 'Contact :'.$patientCart->patient->patientDetail->phone : ''  }} <br/> 
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
                        @endif						
                    </div>
                    <div class="row">                
                        <div class="col-sm-12">
                            <h3>Payment Method</h3>
                        </div>              
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-4">
                                <label>Method :</label>
                            </div>
                            <div class="col-sm-8">
                                @if($payment['payment_type'] == 0)
                                Cash in Hand
                                @else if($payment['payment_type'] == 1)
                                Credit Card
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-4">
                                <label>Total Amt:</label>
                            </div>
                            <div class="col-sm-8">
                                ${{ number_format($total_cart_price, 2) }}
                            </div>
                        </div>
                    </div>                     
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-4">
                                <label>Amt. Received:</label>
                            </div>
                            <div class="col-sm-8">
                                ${{ $payment['paid_amount'] or '' }}                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-4">
                                <label>Remaining Amt:</label>
                            </div>
                            <div class="col-sm-8">
                                $<?php 
                                $remaining = $total_cart_price - $payment['paid_amount'];
                                echo number_format($remaining, 2);
                                ?> <a href="javascript:void(0)" class="emi_popuup">EMI options</a>
                            </div>
                        </div>                        
                    </div>
					<div id="emiDetailTable" style="display:none">
						<div class="row">
							<div class="col-md-12"><h3>EMI payment details</h3></div>
						</div>	
						<div>
							<div class="table-responsive">
								<table class="table table-striped mb-none">
									<thead>
										<tr>
											<th>#</th>
											<th>Installment Amount</th>
											<th>Due Date</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
									
									</tbody>
								</table>
							</div>	
						</div>
					</div>					
                </div>

                <footer class="panel-footer">
                    {{ Form::open(['url' => '/sale/makePayment', 'method' => "post", 'class'=>'form-horizontal', 'id' =>'checkoutForm' ]) }}
                    {{ Form::hidden('patient_id',$patientCart['patient']->id) }}   
                    {{ Form::hidden('agent_id',$patientCart['user']->id) }}   
                    {{ Form::hidden('total_amount', $total_cart_price) }}      
                    {{ Form::hidden('payment_type', $payment['payment_type']) }}  
                    {{ Form::hidden('paid_amount', $payment['paid_amount']) }}
                    <div class="row">
                        <div class="col-md-12 col-md-offset-4">
                            {{ Form::button('<i class="fa fa-btn fa-user"></i>  Buy Now',['class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit']) }}
                            <a class="btn btn-default" href="#" onclick="window.history.go(-1);">Back</a>
                        </div
                    </div>
                    {{ Form::close() }}
                </footer>
            </section>


        </div>
    </div>
    <?php 
    /* code for the EMI Calculation */
    $quarter = $remaining / 3 ;
    $half = $remaining / 6;
    $thirdQuarter = $remaining / 9;
    $year = $remaining / 12;    
    
    ?>
    
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
								<label>Select prefered payment day</label>
								<input class="emiDatepicker" name="emiDatepicker" placeholder="prefered payment day" data-date-format="mm/dd/yyyy">
								<input type="hidden" name="totalEmiAmount" value="<?php echo $remaining; ?>">
								<div class="radio">
                                    <label>
                                        {{ Form::radio('emi', 3, false, ['class' => 'emiRadio', 'id' =>'radio1' ]) }}
                                        <span>$<?php echo number_format($quarter, 2); ?>/month for 3 EMIs</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('emi', 6, false, ['class' => 'emiRadio', 'id' =>'radio2']) }}
                                        <span>$<?php echo number_format($half, 2); ?>/month for 3 EMIs</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('emi', 9, false, ['class' => 'emiRadio', 'id' =>'radio3']) }}
                                        <span>$<?php echo number_format($thirdQuarter, 2); ?>/month for 3 EMIs</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        {{ Form::radio('emi', 12, false, ['class' => 'emiRadio', 'id' =>'radio4']) }}
                                        <span>$<?php echo number_format($year, 2); ?>/month for 3 EMIs</span>
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
</section>
@endsection
