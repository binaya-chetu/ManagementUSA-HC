<?php /* name of this file is the reason disease title (removing special chars and replacing spaces with '_') of the particular reason this file belongs  */  ?>
<div class="col-md-12">
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>
            <h2 class="panel-title">IV Vitamin Therapy</h2>
        </header>		
        <div class="panel-body">
            <div class="tabs tabs-primary">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#vitamin_beginning" data-toggle="tab"><i class="fa fa-star"></i> Beginning Information</a>
                    </li>
                    <li>
                        <a href="#vitamin_treatment" data-toggle="tab">Treatment Questions</a>
                    </li>                    
                </ul>
			
                <div class="tab-content">
                    <div id="vitamin_beginning" class="tab-pane active">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('needle_afraid', 'Are you afraid of Needles?  If yes How afraid?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($vitamins->needle_afraid) && $vitamins->needle_afraid  == 1)
                                            {{ 'Yes' }}
                                        @elseif($vitamins->needle_afraid == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12 needleAfraidActive">
                                <div class="form-group">
                                    {{ Form::label('afraid_limit', 'How Afraid?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                        @if(isset($vitamins->afraid_limit))
                                            {{ $vitamins->afraid_limit }}
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
                                    {{ Form::label('injectable_type', 'What are you seeking from IV or Injectable Vitamin Therapy?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                     @if(isset($vitamins->injectable_type))
                                            {{ $vitamins->injectable_type }}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>                              
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('total_wellness', 'How do you feel about your total wellness?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                       @if(isset($vitamins->total_wellness))
                                            {{ $vitamins->total_wellness }}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">

                            <div class="form-group">
                                {{ Form::label('weight_supplement', 'Have you Ever Been On Any Prescription Drug or Supplement For Weight Loss? If Yes What?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                     @if(isset($vitamins->weight_supplement) && $vitamins->weight_supplement  == 1)
                                            {{ 'Yes' }}
                                        @elseif($vitamins->weight_supplement == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('knowledge', 'How Much do you know about testosterone and how they work in your body?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                       @if(isset($vitamins->vitamin_knowledge))
                                            {{ $vitamins->vitamin_knowledge }}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="vitamin_treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('vitamin_taken', 'Do you currently take a Vitamin Supplement?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($vitamins->vitamin_taken) && $vitamins->vitamin_taken  == 1)
                                            {{ 'Yes' }}
                                        @elseif($vitamins->vitamin_taken == 0)
                                            {{ 'No' }}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('wellness_tested', 'Have you ever been tested for your vitamin Total wellness?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($vitamins->wellness_tested) && $vitamins->wellness_tested  == 1)
                                            {{ 'Yes' }}
                                        @elseif($vitamins->wellness_tested == 0)
                                            {{ 'No' }}
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
                                    {{ Form::label('vitamin_before', 'Have you ever had a IV Vitamin Drip Before?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($vitamins->vitamin_drip) && $vitamins->vitamin_drip  == 1)
                                            {{ 'Yes' }}
                                        @elseif($vitamins->vitamin_drip == 0)
                                            {{ 'No' }}
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
        $('.needleAfraidActive').hide();
		if($("input[name='needle_afraid']:checked").val() == 1){
			$('.needleAfraidActive').show();
		}
        /** 
         * If Patient has the weight loss surgeries then show the corresponding fields
         *  */
        $("input[name='needle_afraid']").click(function() {
            var exercise_status = $(this).val();
            if (exercise_status == 1) {
                $('.needleAfraidActive').show();
            } else {
                $('.needleAfraidActive').hide();
            }
        });

    });
</script>