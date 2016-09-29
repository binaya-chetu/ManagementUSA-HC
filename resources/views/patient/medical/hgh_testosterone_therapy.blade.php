<?php /* name of this file is the reason disease title (removing special chars and replacing spaces with '_') of the particular reason this file belongs  */ ?>
<div class="col-md-12">
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>
            <h2 class="panel-title">High Testosterone Therapy</h2>
        </header>
        <div class="panel-body">
            <div class="tabs tabs-primary">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#testo_beginning" data-toggle="tab"><i class="fa fa-star"></i> Beginning Information</a>
                    </li>
                    <li>
                        <a href="#testo_treatment" data-toggle="tab">Treatment Questions</a>
                    </li>                    
                </ul>
                <div class="tab-content">
                    <div id="testo_beginning" class="tab-pane active">
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('harmone', 'Have you Ever Received Harmone Therapy? IF Yes What Type?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    @if(isset($testosterone->harmone_therapy) && $testosterone->harmone_therapy  == 1)
                                    {{ 'Yes' }}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            {{ Form::label('kind', 'What Type?', ['class' => 'col-sm-6 control-label']) }}
                                            <div class="col-sm-6">
                                                <?php $harmone_type = [ 'Testosterone ' => 'Testosterone', 'HGH' => 'HGH', 'Thyroid' => 'Thyroid']; ?>
                                                @if(isset($testosterone->harmone_therapy_type))
                                                <?php
                                                switch (trim($testosterone->harmone_therapy_type)) {
                                                    case 'Testosterone': echo "Testosterone";
                                                        break;
                                                    case 'HGH': echo "HGH";
                                                        break;
                                                    case 'Thyroid': echo "Thyroid";
                                                        break;
                                                    default: echo "N/A";
                                                }
                                                ?>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @elseif($testosterone->harmone_therapy == 0)
                                    {{'No'}}
                                    @else
                                    {{ 'N/A' }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('usa_military', 'Are you now or are you planning to be in the United States Active Military or Reserve?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    @if(isset($testosterone->usa_military)&& $testosterone->usa_military  == 1)
                                    {{ 'Yes' }}
                                    @elseif($testosterone->usa_military == 0)
                                    {{'No'}}
                                    @else
                                    {{ 'N/A' }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="testo_treatment" class="tab-pane">
                        <div class="form-group">
                            {{ Form::label('liver_disease', 'Questions For Treatment: Please Check all Syptoms You Wish To Improve With Hormone Therapy.', ['class' => 'col-sm-12 control-label']) }}
                        </div>    
                        <div class="col-sm-12">
                            <div class="col-sm-4">

                                {{ Form::label('for-lack', 'Increased Lack of Drive') }}     
                                @if(isset($testosterone->lack_increment)&& $testosterone->lack_increment == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->lack_increment == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif

                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-fat', 'Increased Fat Deposits around the abdomen and / or Thighs') }}                                         
                                @if(isset($testosterone->increase_fat)&& $testosterone->increase_fat == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->increase_fat == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-depression', 'Depression') }}                                         
                                @if(isset($testosterone->depression)&& $testosterone->depression == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->depression == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>   
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                {{ Form::label('for-mood', 'Increasing Mood Swings') }} 
                                @if(isset($testosterone->mood_increment)&& $testosterone->mood_increment == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->mood_increment == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-sleep', 'Difficulty Sleeping') }} 
                                @if(isset($testosterone->sleep_difficulty)&& $testosterone->sleep_difficulty == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->sleep_difficulty == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-wrinkle', 'Increasing Wrinkles') }}     
                                @if(isset($testosterone->wrinkle_increment)&& $testosterone->wrinkle_increment == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->wrinkle_increment == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                {{ Form::label('for-sagging', 'Increasing sagging muscles or breasts.') }}     
                                @if(isset($testosterone->sagging_increment)&& $testosterone->sagging_increment == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->sagging_increment == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif

                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-flash', 'Hot Flashes') }}          
                                @if(isset($testosterone->hot_flash)&& $testosterone->hot_flash == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->hot_flash == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-loss_activity', 'Loss of concentration, sociability, and activity.') }}     
                                @if(isset($testosterone->loss_activity)&& $testosterone->loss_activity == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->loss_activity == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                {{ Form::label('for-stess', 'Increasingly stessed') }}      
                                @if(isset($testosterone->stess_increment)&& $testosterone->stess_increment == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->stess_increment == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                        </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-loss_interest', 'Loss of interest in Sex') }}            
                                @if(isset($testosterone->loss_interest)&& $testosterone->loss_interest == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->loss_interest == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-loose_skin', 'Sagging or Loose Skin') }}       
                                @if(isset($testosterone->loose_skin)&& $testosterone->loose_skin == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->loose_skin == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                             {{ Form::label('for-ability', 'Decreased desire and ability to exercise') }}     
                                @if(isset($testosterone->exercise_ability)&& $testosterone->exercise_ability == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->exercise_ability == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                          </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-memory_decrement', 'Decreasing memory') }}      
                                @if(isset($testosterone->memory_decrement)&& $testosterone->memory_decrement == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->memory_decrement == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                               {{ Form::label('for-muscle', 'Muscle loss') }}               
                                @if(isset($testosterone->loss_muscle)&& $testosterone->loss_muscle == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->loss_muscle == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                {{ Form::label('for-endurance', 'Decreased energy or endurance') }}              
                                @if(isset($testosterone->endurance)&& $testosterone->endurance == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->endurance == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-muscle_decrement', 'Decreasing muscle strength') }}            
                                @if(isset($testosterone->muscle_decrement)&& $testosterone->muscle_decrement == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->muscle_decrement == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-loss_hair', 'Thinning or loss of hair') }}    
                                @if(isset($testosterone->loss_hair)&& $testosterone->loss_hair == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->loss_hair == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                 {{ Form::label('for-sense_decrement', 'Decreased sense of well-being') }} 
                                @if(isset($testosterone->sense_decrement)&& $testosterone->sense_decrement == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->sense_decrement == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-testicle_decrement', 'Decreasing Size of Testicles') }}
                                @if(isset($testosterone->testicle_decrement)&& $testosterone->testicle_decrement == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->testicle_decrement == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                                  {{ Form::label('for-shrinkage', 'Penis Shrinkage / Urogenital Atrophy') }}   
                                @if(isset($testosterone->shrinkage)&& $testosterone->shrinkage == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->shrinkage == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                {{ Form::label('for-osteoporosis', 'Progressive osteoporosis, decreasing bone mass or stooped posture') }} 
                                @if(isset($testosterone->osteoporosis)&& $testosterone->osteoporosis == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->osteoporosis == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                                </div>
                            <div class="col-sm-4">
                              {{ Form::label('for-intolerance', 'Cold or Heat Intolerance') }}  
                                @if(isset($testosterone->intolerance)&& $testosterone->intolerance == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->intolerance == 0)
                                {{'No'}}
                                @else
                                {{ 'N/A' }}
                                @endif
                            </div>
                            <div class="col-sm-4">
                                {{ Form::label('for-unexplained_weight', 'Unexplained Weight Gain or Weight Loss') }}  
                                @if(isset($testosterone->unexplained_weight)&& $testosterone->unexplained_weight == 1)
                                {{ 'Yes' }}
                                @elseif($testosterone->unexplained_weight == 0)
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
    </section>
</div>
<script>
    $(document).ready(function() {
        $('.harmoneActive').hide();
        if ($("input[name='harmone_therapy']:checked").val() == 1) {
            $('.harmoneActive').show();
        }
        /** 
         * If Patient has the received harmone therapy then show the corresponding fields
         *  */
        $("input[name='harmone_therapy']").click(function() {
            var exercise_status = $(this).val();
            if (exercise_status == 1) {
                $('.harmoneActive').show();
            } else {
                $('.harmoneActive').hide();
            }
        });

    });
</script>