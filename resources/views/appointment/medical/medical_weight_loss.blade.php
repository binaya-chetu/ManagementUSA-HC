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
                                {{ Form::label('weight_surgeries', 'Have you Ever Had Any Weight Loss Surgeries?  If Yes What Kind?', ['class' => 'col-sm-9 control-label']) }}
                                <div class="col-sm-3 toggle-radio-custom">
                                    <div class="col-sm-6 radio-custom radio-primary">
										{{ Form::radio('weight_surgeries', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('weight_surgeries', '1', $weightL && $weightL->weight_surgeries == '1', ['id' => 'weight_surgeries1']) }}
                                        {{ Form::label('weight_surgeries1', 'Yes') }}
                                    </div>
                                    <div class="col-sm-6 radio-custom radio-primary">
                                        {{ Form::radio('weight_surgeries', '0', $weightL && $weightL->weight_surgeries == '0', ['id' => 'weight_surgeries2']) }}
                                        {{ Form::label('weight_surgeries2', 'No') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 surgeriesActive">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('kind', 'What Kind?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $kind = [ 'Liposuction ' => 'Liposuction', 'Gastrol Sugery' => 'Gastrol Sugery', 'Laser Enhanced' => 'Laser Enhanced']; ?>
                                        {{ Form::select('surgeries_kind', ['' => 'Please Select'] + $kind, $weightL? $weightL->surgeries_kind : null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 inputRow">

                            <div class="form-group">
                                {{ Form::label('weight_supplement', 'Have you Ever Been On Any Prescription Drug or Supplement For Weight Loss? If Yes What?', ['class' => 'col-sm-9 control-label']) }}
                                <div class="col-sm-3 toggle-radio-custom">
                                    <div class="col-sm-6 radio-custom radio-primary">	
										{{ Form::radio('weight_supplement', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('weight_supplement', '1', $weightL && $weightL->weight_supplement == '1', ['id' => 'weight_supplement1']) }}
                                        {{ Form::label('weight_supplement1', 'Yes') }}
                                    </div>
                                    <div class="col-sm-6 radio-custom radio-primary">
                                        {{ Form::radio('weight_supplement', '0', $weightL && $weightL->weight_supplement == '0', ['id' => 'weight_supplement2']) }}
                                        {{ Form::label('weight_supplement2', 'No') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 supplementActive">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('type', 'What type?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $type = [ 'Phentermine ' => 'Phentermine', 'Thyroid' => 'Thyroid', 'testosterone' => 'testosterone', 'Over The Counter Pills' => 'Over The Counter Pills']; ?>
                                        {{ Form::select('supplement_type', ['' => 'Please Select'] + $type, $weightL? $weightL->supplement_type : null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="weight_loss_treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('liver_disease', 'Have you encountered or been Diagnosed With Liver disease or problems?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('liver_disease', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('liver_disease', '1', $weightL && $weightL->liver_disease == '1', ['id' => 'liver_disease1']) }}
                                            {{ Form::label('liver_disease1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('liver_disease', '0', $weightL && $weightL->liver_disease == '0', ['id' => 'liver_disease2']) }}
                                            {{ Form::label('liver_disease2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('diabetes', 'Do You Have Diabetes?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('diabetes', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('diabetes', '1', $weightL && $weightL->diabetes == '1', ['id' => 'diabetes1']) }}
                                            {{ Form::label('diabetes1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('diabetes', '0', $weightL && $weightL->diabetes == '0', ['id' => 'diabetes2']) }}
                                            {{ Form::label('diabetes2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('thyroid', 'Are you now or have you ever been treated for a problem with your thyroid?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('thyroid_treated', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('thyroid_treated', '1', $weightL && $weightL->thyroid_treated == '1', ['id' => 'thyroid_treated1']) }}
                                            {{ Form::label('thyroid_treated1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('thyroid_treated', '0', $weightL && $weightL->thyroid_treated == '0', ['id' => 'thyroid_treated2']) }}
                                            {{ Form::label('thyroid_treated2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('hormone', 'Are you now or have you ever been treated for Testosterone or other Hormone Replacement?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('hormone_treated', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('hormone_treated', '1', $weightL && $weightL->hormone_treated == '1', ['id' => 'hormone_treated1']) }}
                                            {{ Form::label('hormone_treated1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('hormone_treated', '0', $weightL && $weightL->hormone_treated == '0', ['id' => 'hormone_treated2']) }}
                                            {{ Form::label('hormone_treated2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('seizures', 'Do you suffer from seizures?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('seizures', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('seizures', '1', $weightL && $weightL->seizures == '1', ['id' => 'seizures1']) }}
                                            {{ Form::label('seizures1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('seizures', '0', $weightL && $weightL->seizures == '0', ['id' => 'seizures2']) }}
                                            {{ Form::label('seizures2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('kidney_disorder', 'Do you suffer from any Kidney Disorder?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('kidney_disorder', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('kidney_disorder', '1', $weightL && $weightL->kidney_disorder == '1', ['id' => 'kidney_disorder1']) }}
                                            {{ Form::label('kidney_disorder1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('kidney_disorder', '0', $weightL && $weightL->kidney_disorder == '0', ['id' => 'kidney_disorder2']) }}
                                            {{ Form::label('kidney_disorder2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('eating_disorder', 'Have you ever been diagnosed with a eating disorder of any Kind?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('eating_disorder', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('eating_disorder', '1', $weightL && $weightL->eating_disorder == '1', ['id' => 'eating_disorder1']) }}
                                            {{ Form::label('eating_disorder1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('eating_disorder', '0', $weightL && $weightL->eating_disorder == '0', ['id' => 'eating_disorder2']) }}
                                            {{ Form::label('eating_disorder2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('frequently_eat', 'Do you frequently eat during the night, or in between meals?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('frequently_eat', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('frequently_eat', '1', $weightL && $weightL->frequently_eat == '1', ['id' => 'frequently_eat1']) }}
                                            {{ Form::label('frequently_eat1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('frequently_eat', '0', $weightL && $weightL->frequently_eat == '0', ['id' => 'frequently_eat2']) }}
                                            {{ Form::label('frequently_eat2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('eat_more', 'Due to your lifstyle to you eat out more often then you eat at home?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('eat_more', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('eat_more', '1', $weightL && $weightL->eat_more == '1', ['id' => 'eat_more1']) }}
                                            {{ Form::label('eat_more1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('eat_more', '0', $weightL && $weightL->eat_more == '0', ['id' => 'eat_more2']) }}
                                            {{ Form::label('eat_more2', 'No') }} 
                                        </div>
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