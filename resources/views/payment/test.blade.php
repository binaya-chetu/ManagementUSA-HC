@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Paypal Testing</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('patient') !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">

        <div class="col-md-12">
            {{ Form::open(array('url' => '/payment/debit', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'credit')) }}
            {!! csrf_field() !!}            
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Paypal Testing</h2>
                </header>
                <div class="panel-body">                   
                    <div class="form-group">
                        {{ Form::label('firstName', 'First Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::text('first_name', old('first_name'), ['class' => 'form-control required', 'placeholder' => 'First Name']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('lastName', 'Last Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::text('last_name', old('last_name'), ['class' => 'form-control required', 'placeholder' => 'Last Name']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('number', 'Card Number', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::text('number', old('number'), ['class' => 'form-control required', 'placeholder' => 'Card Number']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('cvv', 'CVV', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-6">
                            {{ Form::text('cvv', old('cvv'), ['class' => 'form-control required', 'placeholder' => 'CVV']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('exp', 'Expiry', array('class' => 'col-sm-3 control-label mandatory')) }}
                        <div class="col-sm-3">
                            <select  class="form-control required" name="month" >
                                    <option value="">Month</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control required" name="year" >
                                <option value="">Year</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>                                    
                            </select>
                        </div>
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
            {{ Form::close() }}

        </div>
    </div>
</section>
<script>
$(document).ready(function(){
   $('#credit').validate(); 
});    
</script>
@endsection