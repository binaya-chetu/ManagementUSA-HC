@extends('layouts.common')

@section('content')

    <section role="main" class="content-body">
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
                                    <h2 class="h2 mt-none mb-sm text-dark text-weight-bold">Invoice For Services</h2>
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
                                    <th id="cell-id"     class="text-weight-semibold">Product Purchased</th>
                                    <th id="cell-item"   class="text-weight-semibold"> UI </th>
                                    <th id="cell-desc"   class="text-weight-semibold">Qty</th>
                                    <th id="cell-price"  class="text-center text-weight-semibold">Unit Price</th>
                                    <th id="cell-qty"    class="text-center text-weight-semibold">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>123456</td>
                                    <td class="text-weight-semibold text-dark">Porto HTML5 Template</td>
                                    <td>Multipourpouse Website Template</td>
                                    <td class="text-center">$14.00</td>
                                    <td class="text-center">2</td>
                                </tr>
                                <tr>
                                    <td>654321</td>
                                    <td class="text-weight-semibold text-dark">Tucson HTML5 Template</td>
                                    <td>Awesome Website Template</td>
                                    <td class="text-center">$17.00</td>
                                    <td class="text-center">1</td>
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
                                            <td class="text-left">$73.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Shipping</td>
                                            <td class="text-left">$0.00</td>
                                        </tr>
                                        <tr class="h4">
                                            <td colspan="2">Grand Total</td>
                                            <td class="text-left">$73.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right mr-lg">
                    <a href="#" class="btn btn-default">Submit Invoice</a>
                    <a href="pages-invoice-print.html" target="_blank" class="btn btn-primary ml-sm"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
        </section>
    </section>


@endsection



