<?php /* name of this file is the reason disease title (removing special chars and replacing spaces with '_') of the particular reason this file belongs  */  ?>
<div class="col-md-12">
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>
            <h2 class="panel-title">Weight Loss</h2>
        </header>
        <div class="panel-body">
            <div class="tabs tabs-primary">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#beginning" data-toggle="tab"><i class="fa fa-star"></i> Beginning Information</a>
                    </li>
                    <li>
                        <a href="#weight_loss_treatment" data-toggle="tab">Treatment Questions</a>
                    </li>                    
                </ul>
                <div class="tab-content">
                    <div id="beginning" class="tab-pane active">
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('weight_surgeries', 'Have you Ever Had Any Weight Loss Surgeries?  If Yes What Kind?', ['class' => 'col-sm-12 control-label']) }}
                                 <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($weightL->weight_surgeries) && $weightL->weight_surgeries  == 1)
                                            {{ 'Yes' }} 
                                            @if(trim($weightL->surgeries_kind)!= '')
                                                        <?php
                                                        switch(trim($weightL->surgeries_kind)) { 
                                                            case 'Liposuction': echo "Liposuction";
                                                                break;
                                                            case 'Gastrol Sugery': echo "Gastrol Sugery";
                                                                break;
                                                             case 'Laser Enhanced': echo "Laser Enhanced";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                                    @endif
                                            @elseif($weightL->weight_surgeries == 0)
                                            {{'No'}}
                                            @else
                                            {{ 'N/A' }}
                                        @endif
                                </div>
                             
                            </div>
                        </div>
               
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('weight_supplement', 'Have you Ever Been On Any Prescription Drug or Supplement For Weight Loss? If Yes What?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    @if(isset($weightL->weight_supplement) && $weightL->weight_supplement  == 1)
                                            {{ 'Yes' }}
                                                @if(trim($weightL->supplement_type)!= '')
                                                        <?php
                                                        switch(trim($weightL->supplement_type)) { 
                                                            case 'Phentermine': echo "Phentermine";
                                                                break;
                                                            case 'Thyroid': echo "Thyroid";
                                                                break;
                                                             case 'testosterone': echo "testosterone";
                                                                break;
                                                             case ' Over The Counter Pills': echo " Over The Counter Pills";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                                    @endif
                                            @elseif($weightL->weight_supplement == 0)
                                                {{'No'}}
                                                @else
                                                {{ 'N/A' }}
                                        @endif
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <div id="weight_loss_treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('liver_disease', 'Have you encountered or been Diagnosed With Liver disease or problems?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($weightL->liver_disease)&& $weightL->liver_disease  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($weightL->liver_disease == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('diabetes', 'Do You Have Diabetes?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                     @if(isset($weightL->diabetes)&& $weightL->diabetes  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($weightL->diabetes == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('thyroid', 'Are you now or have you ever been treated for a problem with your thyroid?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($weightL->thyroid_treated)&& $weightL->thyroid_treated  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($weightL->thyroid_treated == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('hormone', 'Are you now or have you ever been treated for Testosterone or other Hormone Replacement?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($weightL->hormone_treated)&& $weightL->hormone_treated  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($weightL->hormone_treated == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('seizures', 'Do you suffer from seizures?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($weightL->seizures)&& $weightL->seizures  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($weightL->seizures == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('kidney_disorder', 'Do you suffer from any Kidney Disorder?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($weightL->kidney_disorder)&& $weightL->kidney_disorder  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($weightL->kidney_disorder == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('eating_disorder', 'Have you ever been diagnosed with a eating disorder of any Kind?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($weightL->eating_disorder)&& $weightL->eating_disorder  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($weightL->eating_disorder == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('frequently_eat', 'Do you frequently eat during the night, or in between meals?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($weightL->frequently_eat)&& $weightL->frequently_eat  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($weightL->frequently_eat == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('eat_more', 'Due to your lifstyle to you eat out more often then you eat at home?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($weightL->eat_more)&& $weightL->eat_more  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($weightL->eat_more == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
       $('.surgeriesActive').hide();
	   if($("input[name='weight_surgeries']:checked").val() == 1){
		   $('.surgeriesActive').show();
	   }
	   
       $('.supplementActive').hide();
	   if($("input[name='weight_supplement']:checked").val() == 1){
		   $('.supplementActive').show();
	   }	   
       /** 
         * If Patient has the weight loss surgeries then show the corresponding fields
         *  */
        $("input[name='weight_surgeries']").click(function() {
            var exercise_status = $(this).val();
            if (exercise_status == 1) {
                $('.surgeriesActive').show();
            } else {
                $('.surgeriesActive').hide();
            }
        });
        /** 
         * If Patient had supplement for the Weight Loss is true then show the corresponding fields
         *  */
        $("input[name='weight_supplement']").click(function() {
            var exercise_status = $(this).val();
            if (exercise_status == 1) {
                $('.supplementActive').show();
            } else {
                $('.supplementActive').hide();
            }
        });
    });
</script>