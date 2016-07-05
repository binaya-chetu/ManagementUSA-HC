@extends('layouts.common')

@section('content')

<section role="main" class="content-body" id = "printable">
    <header class="page-header">
        <h2>Invoice</h2>
    </header>

    <!-- start: page -->
    <section class="panel">
        <div class="panel-body">
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
                                4415 S. Harvard Ave. Suite 201                              
                                <br/>
                                Tulsa, OK  74135
                                <br/>
                                PH: 918.895.8900
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

                                    Patient Name Here
                                    <br/>
                                    Address Here
                                    <br/>
                                    City State & Zip Here
                                    <br/>
                                    Patient Phone Number Here
                                </address>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bill-data text-right">
                                <p class="mb-none">
                                    <span class="text-dark">Invoice Number</span>
                                    <span class="value">Auto Generate	</span>
                                </p>
                                <p class="mb-none">
                                    <span class="text-dark">Patient Counsler</span>
                                    <span class="value">Auto Generate</span>
                                </p>
                                <p class="mb-none">
                                    <span class="text-dark">Invoice Number</span>
                                    <span class="value">Auto Generate	</span>
                                </p>
                                <p class="mb-none">
                                    <span class="text-dark">Patient Counsler</span>
                                    <span class="value">Auto Generate</span>
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
                                <th id="cell-id"   class="text-weight-semibold"> UI </th>
                                <th id="cell-desc"   class="text-weight-semibold">Qty</th>
                                <th id="cell-price"  class="text-center text-weight-semibold">Unit Price</th>
                                <th id="cell-qty"    class="text-center text-weight-semibold">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> Pre Drawn Custom Trimix Injection Therapy - Permanent Dose </td>
                                <td class="text-weight-semibold text-dark">INJ</td>
                                <td>40</td>
                                <td class="text-center">$55.00</td>
                                <td class="text-center">$2,200.00</td>
                            </tr>
                            <tr>
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
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="invoice-summary">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-8">
                            <table class="table h5 text-dark">
                                <tbody>
                                    <tr class="b-top-none">
                                        <td colspan="2">Subtotal</td>
                                        <td class="text-left">$3390.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Shipping</td>
                                        <td class="text-left">$0.00</td>
                                    </tr>
                                    <tr class="h4">
                                        <td colspan="2">Grand Total</td>
                                        <td class="text-left">$3390.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::open(array('url' => '/apptsetting/saveApptFollowup', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'callStatus')) }}
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-6" id="email_invoice_container">
                        {{ Form::checkbox('email_envoice',null, false, ['class' => 'email_invoice','id' =>'email_invoice','value' => 'sureshc@chetu.com' ]) }}
                        {{ Form::label('email_envoice', 'Email envoice', array('class' => 'col-sm-4')) }}
                        {{ Form::hidden('invoice_id' , $id ,['id' => 'invoice_id']) }}
                        
                    </div>
                </div>
            </div>
            {{ Form::close() }}
            <div class="text-right mr-lg" id = "print-button">
                <a href="#" id ="print_invoice" class="btn btn-primary ml-sm"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
    </section>
</section>


@endsection




