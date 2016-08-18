@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Cash Voucher Form</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('accounting.create') !!}
            
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        <div class="col-lg-12">	
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a class="panel-action panel-action-toggle" data-panel-toggle="" href="#"></a>
                        <a class="panel-action panel-action-dismiss" data-panel-dismiss="" href="#"></a>
                    </div>
                    <h2 class="panel-title"><strong>Petty Cash Voucher Form</strong> </h2>
                </header>	
                 {{ Form::open(array('url' => '/accounting/store', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'cashVoucher')) }}
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                   
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6 form-group{{ $errors->has('operation') ? ' has-error' : '' }}">
                           {{ Form::label('operation', 'Operation', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                {{ Form::select('operation', (['' => 'Select Operation', '1' => 'Cash Out', '2' => 'Cash In']), null, ['class' => 'form-control input required', 'id' => 'operation']) }}
                                @if ($errors->has('operation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('operation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6 form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                           {{ Form::label('amount', 'Amount', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-dolor">$</i>
                                </span>
                                {{ Form::text('amount', null, ['class' => 'form-control required decimal_val', 'id' => 'amount']) }}
                                @if ($errors->has('amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group {{ $errors->has('date') ? ' has-error' : '' }}">
                        {{ Form::label('date', 'Date', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                {{ Form::text('date', date('m/d/Y'), ['class' => 'form-control required', 'data-plugin-datepicker', 'id' => 'voucherDate']) }}
                                @if ($errors->has('date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-6 form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                            {{ Form::label('details', 'Details', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('details', null, ['class' => 'form-control required', 'id' => 'details', 'rows'=> '2']) }}
                                 </div>
                                @if ($errors->has('details'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('details') }}</strong>
                                </span>
                                @endif
                        </div>
                        
                        <!--<div class="col-sm-6 form-group{{ $errors->has('cash_in') ? ' has-error' : '' }}">
                           {{ Form::label('cash_in', 'Cash In', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-dolor">$</i>
                                </span>
                                {{ Form::text('cash_in', null, ['class' => 'form-control decimal_val', 'id' => 'cash-in']) }}
                                @if ($errors->has('cash_in'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cash_in') }}</strong>
                                </span>
                                @endif
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                                {{ Form::button(
                                    '<i class="fa fa-plus"></i> Save',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                                }}                               
                                <a href='/user/listUsers' class = 'mb-xs mt-xs mr-xs btn btn-default'>Cancel</a>
                            </div>
                    </div>
                </footer>
                 {{ Form::close() }}
            </section>
        </div>
    </div>
</section>
<script>
    // JQUERY ".Class" SELECTOR.
    $(document).ready(function() {
        $('.decimal_val').keypress(function (event) {
            return isNumber(event, this)
        });
    });
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }    
</script>
@endsection

