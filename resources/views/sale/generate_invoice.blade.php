@extends( (Request::segment(2) == "sendInvoice") ? 'layouts.medical' : 'layouts.common')

@section('content')

@if(Request::segment(2) == "generateInvoice")
<section role="main" class="content-body" id = "printable">
    <header class="page-header">
        <h2>Invoice</h2>
    </header>
@endif
    <!-- start: page -->
    <section class="panel">
        <div class="panel-body">
            <div class="row">
                @if(Session::has('flash_message'))
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @endif
                @if(Session::has('error_message'))
                <div class="col-sm-12"><div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><em> {!! session('error_message') !!}</em></div></div>
                @endif
            </div>
            @if(Request::segment(2) == "generateInvoice")
            <div class="tabs tabs-primary">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#followupTab" data-toggle="tab"><i class="fa fa-star"></i> Payment Invoice</a>
                    </li>
                    @foreach($orders['orderHistory'] as $package)
                    <li>
                        <a target="_blank" href="/sale/printForm/{{ base64_encode($package['payment']['patient_id']) }}/{{base64_encode($package['category_id'])}}">HGH Consent Tulsa</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="invoice">
                <header class="clearfix">
                    <div class="row">
                        <div class="col-sm-6 mt-md">
                            <div class="col-sm-6 mt-md">
                                <h2 class=" h2 mt-none mb-sm text-dark text-weight-bold">Invoice</h2>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right mt-md mb-md">
                            <address class="ib mr-xlg">                      
                                {{ $loginUser->userDetail->address1.' '.$loginUser->userDetail->address2 }}                              
                                <br/>
                                {{ $loginUser->userDetail->city }} {{ $loginUser->userDetail->userStateName->name or '' }}
                                <br/>
                                PH: {{ $loginUser->userDetail->phone }}
                            </address>
                            <div class="ib">
                                <img src="{{ URL::asset('images/invoice logo.png')}}"  height="35" alt="Porto Admin" />
                            </div>
                        </div>
                    </div>
                </header>
                <div class="bill-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bill-to">
                                <address>

                                    {{ $orders['user']['first_name'].' '.$orders['user']['last_name'] }}
                                    <br/>
<!--                                    Address Here
                                    <br/>-->
                                     {{ $orders['user']['patient_detail']['city'] }} 
                                     @if(!empty($orders['user']['patient_detail']['patient_state_name']))
                                        {{ $orders['user']['patient_detail']['patient_state_name']['name'] }}
                                     @endif
                                    <br/>
                                    {{ $orders['user']['patient_detail']['phone'] }}
                                </address>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bill-data text-right">
                                <p class="mb-none">
                                    <span class="text-dark">Invoice Number</span>
                                    <span class="value">Inv0001	</span>
                                </p>
                                <p class="mb-none">
                                    <span class="text-dark">Patient Counsler</span>
                                    <span class="value">{{ $orders['agent']['first_name']. ' '.$orders['agent']['last_name']  }} </span>
                                </p>
                               
                            </div>
                        </div>

                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table invoice-items">
                        <thead>
                            <tr class="h4 text-dark">
                                <th id="cell-item"     class="text-weight-semibold">Product Purchased</th>
<!--                                <th id="cell-id"   class="text-weight-semibold"> UI </th>-->
                                <th id="cell-id"   class="text-weight-semibold">Qty  </th>                                
                                <th id="cell-price"  class="text-center text-weight-semibold">Unit Price</th>
                                <th id="cell-desc"   class="text-center text-weight-semibold">Discount Price</th>
                                <th id="cell-qty"    class="text-center text-weight-semibold">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders['orderHistory'] as $order)
                                <tr>
                                    <td colspan="4" class="text-weight-semibold text-dark"> {{ $order['category']}} </td>
                                    <td class="text-center text-weight-semibold text-dark">${{ $order['price'] }}</td>
                                </tr>
                                @foreach($order['order_detail'] as $detail)                            
                                    <tr>
                                        <td> {{ $detail['product']}} </td>
<!--                                        <td class="text-weight-semibold text-dark">INJ</td>-->
                                        <td class="text-center"> {{ $detail['quantity']}}</td>
                                        <td class="text-center">${{ $detail['unit_price']}}</td>
                                        <td class="text-center">${{ $detail['discount_price']}}</td>
                                        <td class="text-center">${{ $detail['total_price']}}</td>
                                    </tr>
                                @endforeach
                            @endforeach
<!--                            <tr>
                                <td> Allowable Trimix Diagnostic Re-Doses During Membership Period	</td>
                                <td class="text-weight-semibold text-dark">INJ</td>
                                <td>15</td>
                                <td class="text-center">$55.00</td>
                                <td class="text-center">$825.00</td>
                            </tr>
                            <tr>
                                <td>  Allowable Trimix Diagnostic Re-Doses During Membership Period </td>
                                <td class="text-weight-semibold text-dark">INJ</td>
                                <td>6</td>
                                <td class="text-center">$60.00</td>
                                <td class="text-center">$360.00</td>
                            </tr>
                            <tr>
                                <td> A Air Travel Letter For Trimix Injections</td>
                                <td class="text-weight-semibold text-dark">EA</td>
                                <td>5</td>
                                <td class="text-center">$1.00</td>
                                <td class="text-center">$5.00</td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>

                <div class="invoice-summary">
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-7">
                            <table class="table h5 text-dark">
                                <tbody>
                                    <tr class="b-top-none">
                                        <td colspan="2">Subtotal</td>
                                        <td class="text-left">${{ number_format($orders['total_package_price'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Discount Price</td>
                                        <td class="text-left">${{ number_format($orders['discount_price'], 2) }}</td>
                                    </tr>
                                    <tr class="h4">
                                        <td colspan="2">Grand Total</td>
                                        <td class="text-left">$
                                            <?php   $total = ''; 
                                                $total = $orders['total_package_price'] - $orders['discount_price']; 
                                                 echo number_format($total, 2); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if(Request::segment(2) == "generateInvoice")
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-6" id="email_invoice_container">
                        {{ Form::checkbox('email_invoice', $order_id, false, ['class' => 'email_invoice','id' =>'email_invoice','value' => 'sureshc@chetu.com' ]) }}
                        {{ Form::label('email_invoice', 'Email Invoice', array('class' => 'col-sm-4')) }}
<!--                        {{ Form::hidden('invoice_id' , null ,['id' => 'invoice_id']) }} -->
                        
                    </div>
                </div>
            </div>
            @endif
            <div class="text-right mr-lg" id = "print-button">
                <a href="#" id ="print_invoice" class="btn btn-primary ml-sm"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
    </section>
   
@if(Request::segment(2) == "generateInvoice")
</section>
@endif

@endsection




