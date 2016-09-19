@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>View patient :  {{ $patient->first_name }} {{ $patient->last_name }}</h2>
        <div class="right-wrapper pull-right">
           {!! Breadcrumbs::render('patient.view', $patient) !!}
            
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        <div class="col-lg-12">	
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#personal" data-toggle="tab"><i class="fa fa-star"></i> Personal Information</a>
                    </li>
                    <li>
                        <a href="#contact" data-toggle="tab">Contact Information</a>
                    </li>
                    <li>
                        <a href="#attachment" data-toggle="tab">Attachments</a>
                    </li>
                    @if(!empty($catList))
                     <li>
                        <a href="#package_details" data-toggle="tab">Package Details</a>
                    </li>
                    @endif
                    <li>
                        <a href="#adam_questionaires" data-toggle="tab">Adam Questionaires</a>
                    </li>
                    
                </ul>
               
                <div class="tab-content">
                    <div id="personal" class="tab-pane active">
                        <p>Personal Information</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>First Name :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $patient->first_name }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Last Name :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $patient->last_name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Email :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $patient->email }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Role :</label>
                            </div>
                            <div class="col-sm-9">
                                {{ $patient['roleName']->role_title }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Gender :</label>
                            </div>
                            <div class="col-md-9">         
                                {{ $patient['patientDetail']->gender }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Dob :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($patient['patientDetail']->dob)
                                {{ date('d F Y', strtotime($patient['patientDetail']->dob)) }}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Employer :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($patient['patientDetail']->employer)
                                {{ $patient['patientDetail']->employer }}
                                 @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>					
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Occupation :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($patient['patientDetail']->occupation)
                                {{ $patient['patientDetail']->occupation }}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        
                    </div>

                    <div id="contact" class="tab-pane">
                        <p>Contact Information</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Phone :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient['patientDetail']->phone or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Address Line 1 :</label>
                            </div>
                            <div class="col-sm-9">
                                 @if($patient['patientDetail']->address1)
                                {{ $patient['patientDetail']->address1 }}
                                 @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Address Line 2 :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($patient['patientDetail']->address2)
                                {{ $patient['patientDetail']->address2 }}
                                 @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>City :</label>
                            </div>
                            <div class="col-sm-9">
                                @if($patient['patientDetail']->city)
                                {{ $patient['patientDetail']->city }}
                                 @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>State :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient['patientDetail']['patientStateName']->name or 'N/A' }}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Zip Code :</label>
                            </div>
                            <div class="col-sm-9">
                                {{{ $patient['patientDetail']->zipCode or 'N/A' }}}
                            </div>
                        </div>	
                    </div>

                    <div id="attachment" class="tab-pane">
                        <p>Attachments</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-offset-1">
                                <label>Payment Bill :</label>
                            </div>
                            <div class="col-sm-9">
                                @if(isset($patient['patientDetail']->payment_bill) && !empty($patient['patientDetail']->payment_bill)) 
                                    <a href="{{ URL::asset('uploads/patient_documents/'.$patient['patientDetail']->payment_bill) }}" download="myimage" class="document_link" ><img src="{{ URL::asset('images/pdf_icon.png') }}" ></a>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div id="package_details" class="tab-pane">
                    
                        <div class="row">
                           <section class="panel panel-primary">
                             
                            @if(isset($catList) && !empty($catList))
<!--				<header class="panel-heading">
					<div class="panel-actions">
					@if(isset($catList))
						<a href="#"> 
							<button type="button" class="btn btn-success">
								<span class="fa fa-check"></span> Checkout
							</button>
						</a>
						<a href="/cart/emptyCart/{{ base64_encode(array_values($catList)[0]['patient_id']) }}"> 
							<button type="button" class="btn btn-danger">
								<span class="fa fa-remove"></span> Empty cart
							</button>
						</a>
					@endif	
					</div>
					<h2 class="panel-title">Cart Item </h2>
				</header>-->
				<div class="panel-body">
					<div class="row">
						@if(Session::has('flash_message'))
							<div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
						@elseif(Session::has('error_message'))
							<div class="col-sm-12"><div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span><em> {!! session('error_message') !!}</em></div></div>					
						@endif				
					</div>				
					<table class="table table-bordered mb-none" id="cartItemList">
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
						@foreach($catList as $i => $cat)
							<tr class="gradeX background-{{ isset($cat['category_type'])? strtolower($cat['category_type']) : 'default' }}" data-details-table = '{{ $i }}'>
								<td>{{ $cat['category'] }}</td>
								<td>{{ $cat['user'] }}</td>
								<td>{{ $cat['patient'] }}</td>
								<td class="center">{{ $cat['duration'] }}</td>
								<td class="center">{{ $discountPrice[$i] }}</td>
								<td class="center">
									<a data-href="/cart/removeItem/{{ base64_encode($i) }}" href="javascrpt:void(0)" class="on-default remove-row confirmation-callback" data-original-title="Remove from cart" title="Remove from cart">
										<i class="fa fa-trash-o"></i>
									</a>
								</td>
							</tr>									
						@endforeach
						</tbody>
					</table>
				</div>
				<div id="rowDetails" style="display:none">
				@foreach($cartDetailList as $ind => $val)	
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
								<td class="center">{{ $item['original_price'] }}</td>
								<td class="center">{{ $item['discount_price'] }}</td>
							</tr>
						@endforeach
							<tr>
								<td></td>
								<td colspan="4"><strong>Total price</strong></td>
								<td>{{ $originalPrice[$ind] }}</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="4"><strong>Total discouont</strong></td>
								<td>{{ $packageDiscount[$ind] }}</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="4"><strong>Discounted package price</strong></td>
								<td>{{ $discountPrice[$ind] }}</td>
							</tr>
						</tbody>
					</table>
				@endforeach				
				</div>
			@else
				<table class="table table-bordered">
					<tr>
                                            <td class="col-sm-8 col-md-5"><h5> There is no package.</h5></td>
					</tr>
				</table>
                        
			@endif
			</section>
                        </div>
                    </div>
                    
                    <div id="adam_questionaires" class="tab-pane">
                        <div class="row">
                            <div class="col-md-6 col-sm-offset-1">
                                <label>How would you rate your libido (sex drive)? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->adamsQuestionaires->libido_rate))
                                    <?php switch($patient->adamsQuestionaires->libido_rate) {
                                        case 1: echo "Terrible";
                                            break;
                                        case 2: echo "Poor";
                                            break;
                                        case 3: echo "Average";
                                            break;
                                        case 4: echo "Good";
                                            break;
                                        case 5: echo "Exellent";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>How are you rate your energy level? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->adamsQuestionaires->energy_rate))
                                    <?php switch($patient->adamsQuestionaires->energy_rate) {
                                        case 1: echo "Terrible";
                                            break;
                                        case 2: echo "Poor";
                                            break;
                                        case 3: echo "Average";
                                            break;
                                        case 4: echo "Good";
                                            break;
                                        case 5: echo "Exellent";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>How are you rate your strength/endurance? :</label>
                            </div>
                            <div class="col-sm-5">
                                 @if(isset($patient->adamsQuestionaires->strength_rate))
                                    <?php switch($patient->adamsQuestionaires->strength_rate) {
                                        case 1: echo "Terrible";
                                            break;
                                        case 2: echo "Poor";
                                            break;
                                        case 3: echo "Average";
                                            break;
                                        case 4: echo "Good";
                                            break;
                                        case 5: echo "Exellent";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                 @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>How are you rate your enjoyment of life? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->adamsQuestionaires->enjoy_rate))
                                    <?php switch($patient->adamsQuestionaires->enjoy_rate) {
                                        case 1: echo "Terrible";
                                            break;
                                        case 2: echo "Poor";
                                            break;
                                        case 3: echo "Average";
                                            break;
                                        case 4: echo "Good";
                                            break;
                                        case 5: echo "Exellent";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>How are you at your happiness level? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->adamsQuestionaires->happiness_rate))
                                    <?php switch($patient->adamsQuestionaires->happiness_rate) {
                                        case 1: echo "Terrible";
                                            break;
                                        case 2: echo "Poor";
                                            break;
                                        case 3: echo "Average";
                                            break;
                                        case 4: echo "Good";
                                            break;
                                        case 5: echo "Exellent";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>How strong are your erections? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->adamsQuestionaires->erection_rate))
                                    <?php switch($patient->adamsQuestionaires->erection_rate) {
                                        case 1: echo "Poor";
                                            break;
                                        case 2: echo "Weak";
                                            break;
                                        case 3: echo "Average";
                                            break;
                                        case 4: echo "Strong";
                                            break;
                                        case 5: echo "Very Strong";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>How are you at your work performance over the last four weeks? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->adamsQuestionaires->performance_rate))
                                    <?php switch($patient->adamsQuestionaires->performance_rate) {
                                        case 1: echo "Terrible";
                                            break;
                                        case 2: echo "Poor";
                                            break;
                                        case 3: echo "Average";
                                            break;
                                        case 4: echo "Good";
                                            break;
                                        case 5: echo "Exellent";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>How often do you fall asleep after dinner? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->adamsQuestionaires->sleep_rate))
                                    <?php switch($patient->adamsQuestionaires->sleep_rate) {
                                        case 1: echo "Terrible";
                                            break;
                                        case 2: echo "Poor";
                                            break;
                                        case 3: echo "Average";
                                            break;
                                        case 4: echo "Good";
                                            break;
                                        case 5: echo "Exellent";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>How would you rate your sports ability over the past four weeks? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->adamsQuestionaires->sport_rate))
                                    <?php switch($patient->adamsQuestionaires->sport_rate) {
                                        case 1: echo "Terrible";
                                            break;
                                        case 2: echo "Poor";
                                            break;
                                        case 3: echo "Average";
                                            break;
                                        case 4: echo "Good";
                                            break;
                                        case 5: echo "Exellent";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>How much height have you lost? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->adamsQuestionaires->lost_height_rate))
                                    <?php switch($patient->adamsQuestionaires->lost_height_rate) {
                                        case 1: echo '2" or More';
                                            break;
                                        case 2: echo '1.5 - 1.9"';
                                            break;
                                        case 3: echo '1 - 1.4"';
                                            break;
                                        case 4: echo '.5 - .9"';
                                            break;
                                        case 5: echo '0 - .4"';
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9">
                           <a href="javascript::void(0);" class="btn btn-default" onclick="window.history.go(-1); return false;">Back</a>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </div>

</section>
@endsection

