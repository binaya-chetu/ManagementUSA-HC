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
                     <li>
                        <a href="#medical_history" data-toggle="tab">Family Medical History</a>
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
                     <div id="medical_history" class="tab-pane">
                        <div class="row">
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Cardiovascular Disease :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->medicalHistories->cardiovascular) && $patient->medicalHistories->cardiovascular  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->cardiovascular == 0)
                                    {{'No'}}
                                    @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                           
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Hypertension :</label>
                            </div>
                            <div class="col-sm-5">
                                 @if(isset($patient->medicalHistories->hypertension) && $patient->medicalHistories->enocrine_disorder  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->enocrine_disorder == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Diabetes, Thyroid, or other Enocrine Disorder :</label>
                            </div>
                            <div class="col-sm-5">
                                 @if(isset($patient->medicalHistories->enocrine_disorder) && $patient->medicalHistories->enocrine_disorder  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->enocrine_disorder == 0)
                                    {{'No'}}
                                     @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Prostate Cancer :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->medicalHistories->prostate) && $patient->medicalHistories->prostate  == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->prostate == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Lipid or Blood Disorder :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->medicalHistories->lipid)&& $patient->medicalHistories->lipid  == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->lipid == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Other Forms of Cancer :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->cancer_form)&& $patient->medicalHistories->cancer_form  == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->cancer_form == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Do You Smoke.  If Yes How Often How Much? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->medicalHistories->smoke_status))
                                 <div class="col-sm-5">
                                      @if(isset($patient->medicalHistories->smoke_often))
                                          <?php switch($patient->medicalHistories->smoke_often) {
                                              case 'Daily': echo "Daily";
                                                  break;
                                              case 'Occasionally': echo "Occasionally";
                                                  break;
                                              default: echo "N/A";

                                          } ?>
                                     @endif
                                   </div> 
                                    <div class="col-sm-5">
                                        @if(isset($patient->medicalHistories->smoke_quantity))
                                            <?php switch($patient->medicalHistories->smoke_quantity) {
                                                case 'less than 1 pack': echo "less than 1 pack";
                                                    break;
                                                case '1 pack': echo "1 pack";
                                                    break;
                                                case '2 packs': echo "2 packs";
                                                    break;
                                                case 'over 2 packs': echo "over 2 packs";
                                                    break;
                                                default: echo "N/A";    
                                            } ?>
                                         @endif

                                   </div>
                                
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Do You Drink.  If Yes How Often How Much? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->medicalHistories->drink_status))
                                 <div class="col-sm-5">
                                      @if(isset($patient->medicalHistories->drink_often))
                                          <?php switch($patient->medicalHistories->drink_often) {
                                              case 'Daily': echo "Daily";
                                                  break;
                                              case 'Occasionally': echo "Occasionally";
                                                  break;
                                              default: echo "N/A";

                                          } ?>
                                     @endif
                                  </div> 
                                <div class="col-sm-5">
                                    @if(isset($patient->medicalHistories->drink_quantity))
                                        <?php switch($patient->medicalHistories->drink_quantity) {
                                            case 'less than 1 drink': echo "less than 1 drink";
                                                break;
                                            case '1 drink': echo "1 drink";
                                                break;
                                            case '2 drinks': echo "2 drinks";
                                                break;
                                            case 'over 2 drinks': echo "over 2 drinks";
                                                break;
                                            default: echo "N/A";    
                                        } ?>
                                  
                                  @endif  
                               </div>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Please Rate Your Daily Activity Level :</label>
                            </div>
                            
                            <div class="col-sm-5">
                                @if(isset($patient->medicalHistories->activity_level))
                                    <?php switch($patient->adamsQuestionaires->sport_rate) {
                                        case 'Heavy': echo "Heavy";
                                            break;
                                        case 'Medium': echo "Medium";
                                            break;
                                        case 'Low': echo "Low";
                                            break;
                                        default: echo "N/A"; 
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Do you Exercise? If So How Often? :</label>
                            </div>
                            <div class="col-sm-5">
                                @if(isset($patient->medicalHistories->exercise_status))
                                 <div class="col-sm-5">
                                      @if(isset($patient->medicalHistories->exercise_often))
                                          <?php switch($patient->medicalHistories->exercise_often) {
                                              case 'Daily': echo "Daily";
                                                  break;
                                              case 'Occasionally': echo "Occasionally";
                                                  break;
                                              default: echo "N/A";

                                          } ?>
                                       @endif
                                  </div> 
                                @else
                                  {{ 'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Diagnosed History Of Disease :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->deficiency_status)  && $patient->medicalHistories->chemical_dependency  == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->chemical_dependency == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Chemical Dependency :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->chemical_dependency) && $patient->medicalHistories->chemical_dependency  == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->chemical_dependency == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Blood Disorders :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->blood_disorder)  && $patient->medicalHistories->blood_disorder  == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->blood_disorder == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Orthopedic or muscle disorder including fracture or Joint disorders. :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->orthopedic_disorder) && $patient->medicalHistories->orthopedic_disorder   == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->orthopedic_disorder == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Any Known Deficiency Including Minerals and Electrolytes :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->known_deficiency) && $patient->medicalHistories->known_deficiency   == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->known_deficiency == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Carpal Tunnel Syndrome :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->carpal_syndrome) && $patient->medicalHistories->immune_disorder == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->immune_disorder == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Immune Disorders :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->immune_disorder)  && $patient->medicalHistories->immune_disorder == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->immune_disorder == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Heart disease including Atheroscelerosis, Angina, Heart Failure, or Heart Attack :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->heart_disease) && $patient->medicalHistories->heart_disease == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->heart_disease == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Lung Disorders :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->lung_disorder) && $patient->medicalHistories->lung_disorder == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->lung_disorder == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                              <div class="col-md-6 col-sm-offset-1">
                                <label>Cancers :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->cancer_status) && $patient->medicalHistories->cancer_status == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->cancer_status == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Major Surgeries :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->surgeries) && $patient->medicalHistories->surgeries == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->surgeries == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Renal Disease (Kidneys) :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->renal)&& $patient->medicalHistories->renal == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->renal == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Upper Respitory Problems :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->upper ) && $patient->medicalHistories->upper == 1)
                                    {{ 'Yes' }}
                                @elseif($patient->medicalHistories->upper == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Allergies to Medications :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->allergies)&& $patient->medicalHistories->allergies  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->allergies == 0)
                                    {{'No'}}
                               @else
                                    {{'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Genital - Urinary Disorder :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->genital)&& $patient->medicalHistories->genital  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->genital == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Edema / Excess fluid retention :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->retention)&& $patient->medicalHistories->retention  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->retention == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Thyroid, Diabetes or other endocrine disorder including insulin resistance :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->endocrine)&& $patient->medicalHistories->endocrine  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->endocrine == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Hyperlipidemia (Cholesterol) :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->hyperlipidema)&& $patient->medicalHistories->hyperlipidema  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->hyperlipidema == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Poor Wound Healing :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->healing)&& $patient->medicalHistories->healing  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->healing == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Neurological Disorders :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->neurological) && $patient->medicalHistories->neurological  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->neurological == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                             <div class="col-md-6 col-sm-offset-1">
                                <label>Emotional disorders / Depression :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->emotional)&& $patient->medicalHistories->emotional  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->emotional == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Hypertention(High Blood Pressure):</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->hypertention_hbp) && $patient->medicalHistories->hypertention_hbp  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->hypertention_hbp == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Other Illnesses :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->other_illness) && $patient->medicalHistories->other_illness  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->other_illness == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                           
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Arthritis :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->arthritis)&& $patient->medicalHistories->arthritis  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->arthritis == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Do you use any form of Recreational Drugs? :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->recreational_drug) && $patient->medicalHistories->recreational_drug  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->recreational_drug == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>When was the last time you had a comprehensive Blood Test or Blood Test of anykind? :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->blood_test))
                                <?php switch($patient->medicalHistories->blood_test) {
                                        case '1 Month': echo "1 Month";
                                            break;
                                        case '3 Months': echo "3 Months";
                                            break;
                                        case '6 Months': echo "6 Months";
                                            break;
                                        case '>1': echo "1 Year or Longer";
                                            break;
                                        case 'Never': echo "Never";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Do you have any form of Health Insurance? :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->health_insurance)&& $patient->medicalHistories->health_insurance  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->health_insurance == 0)
                                    {{'No'}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Kind of Health Insurance :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->kind_of_hi))
                                   <?php switch($patient->medicalHistories->blood_test) {
                                        case 'Medicare': echo "Medicare";
                                            break;
                                        case 'HMO': echo "HMO";
                                            break;
                                        case 'PPO': echo "PPO";
                                            break;
                                        case 'Medicaid': echo "Medicaid";
                                            break;
                                        default: echo "N/A";
                                            
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                            
                            <div class="col-md-6 col-sm-offset-1">
                                <label>Are you Currently Taking Any Medications? :</label>
                            </div>
                            <div class="col-sm-5">
                               @if(isset($patient->medicalHistories->medication) && $patient->medicalHistories->medication  == 1)
                                    {{ 'Yes' }}
                                    @elseif($patient->medicalHistories->medication == 0)
                                    {{'No'}}
                                  @else
                                    {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div id="medical_history" class="tab-pane">
                        <p>Medical History</p>
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

