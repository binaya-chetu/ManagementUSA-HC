@extends('layouts.common')

@section('content')

<section role="main" class="content-body" id = "printable">
    <header class="page-header">
        <h2>Payment Details</h2>
    </header>
      <form onsubmit="event.preventDefault(); validateMyForm();" class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}"  action="#" method="POST" id="payment-form">
            <div class="form-row">
            <label class='col-sm-4 control-label'>
             Card type
              
            </label>
                <div class="col-md-6">
                <select class="form-control" name="patient_id" id="patient_id">
                  <option value="0">Select Payment Type</option>
                  <option value="1">Credit Card</option>
                  <option value="2">Debit Card</option>
                  <option value="3">Net Banking</option>
              </select>
              </div>
                 <br/>
          </div>
          <br/>
            
        <div class="form-group"> 
                <label class='col-sm-4 control-label'>
               Card Number
                </label>
                <div class="col-md-6">
                     <input type="text" size="20" data-stripe="number">
                    
                </div>
            </div> 
         
          <div class="form-group"> 
                <label class='col-sm-4 control-label'>
                Expiration (MM/YY)
              
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                      <input type="text" size="2" data-stripe="exp_year">
                    </div>
                </div>
            </div> 
          
          
          
             <div class="form-group"> 
                <label class='col-sm-4 control-label'>
                 CVC
                </label>
                 <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" size="4" data-stripe="cvc">
                    </div>
                </div>
            </div> 
          <input class='mb-xs mt-xs mr-xs btn btn-primary' type="submit" id ='submitPayment'  value="Submit Payment">
        </form>
</section>


@endsection




