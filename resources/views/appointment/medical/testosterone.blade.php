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
                                {{ Form::label('harmone', 'Have you Ever Received Harmone Therapy? IF Yes What Type?', ['class' => 'col-sm-9 control-label']) }}
                                <div class="col-sm-3 toggle-radio-custom">
                                    <div class="col-sm-6 radio-custom radio-primary">
										{{ Form::radio('harmone_therapy', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('harmone_therapy', '1', $testosterone && $testosterone->harmone_therapy == '1', ['id' => 'harmone_therapy1']) }}
                                        {{ Form::label('harmone_therapy1', 'Yes') }}
                                    </div>
                                    <div class="col-sm-6 radio-custom radio-primary">
                                        {{ Form::radio('harmone_therapy', '0', $testosterone && $testosterone->harmone_therapy == '0', ['id' => 'harmone_therapy2']) }}
                                        {{ Form::label('harmone_therapy2', 'No') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 harmoneActive">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('kind', 'What Type?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $harmone_type = [ 'Testosterone ' => 'Testosterone', 'HGH' => 'HGH', 'Thyroid' => 'Thyroid']; ?>
                                        {{ Form::select('harmone_therapy_type', ['' => 'Please Select'] + $harmone_type, null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('usa_military', 'Are you now or are you planning to be in the United States Active Military or Reserve?', ['class' => 'col-sm-9 control-label']) }}
                                <div class="col-sm-3 toggle-radio-custom">
                                    <div class="col-sm-6 radio-custom radio-primary">
										{{ Form::radio('usa_military', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('usa_military', '1', $testosterone && $testosterone->usa_military == '1', ['id' => 'usa_military1']) }}
                                        {{ Form::label('usa_military1', 'Yes') }}
                                    </div>
                                    <div class="col-sm-6 radio-custom radio-primary">
                                        {{ Form::radio('usa_military', '0', $testosterone && $testosterone->usa_military == '1', ['id' => 'usa_military2']) }}
                                        {{ Form::label('usa_military2', 'No') }}
                                    </div>
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
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('lack_increment', null, false, ['id' => 'for-lack']) }}
                                        {{ Form::label('for-lack', 'Increased Lack of Drive') }}                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('increase_fat', null, false, ['id' => 'for-fat']) }}
                                        {{ Form::label('for-fat', 'Increased Fat Deposits around the abdomen and / or Thighs') }}                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('depression', null, false, ['id' => 'for-depression']) }}
                                        {{ Form::label('for-depression', 'Depression') }}                                         
                                    </div>
                                </div>
                            </div>   
                        <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('mood_increment', null, false, ['id' => 'for-mood']) }}
                                        {{ Form::label('for-mood', 'Increasing Mood Swings') }}                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('sleep_difficulty', null, false, ['id' => 'for-sleep']) }}
                                        {{ Form::label('for-sleep', 'Difficulty Sleeping') }}                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('wrinkle_increment', null, false, ['id' => 'for-wrinkle']) }}
                                        {{ Form::label('for-wrinkle', 'Increasing Wrinkles') }}                                         
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('sagging_increment', null, false, ['id' => 'for-sagging']) }}
                                        {{ Form::label('for-sagging', 'Increasing sagging muscles or breasts.') }}                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('hot_flash', null, false, ['id' => 'for-flash']) }}
                                        {{ Form::label('for-flash', 'Hot Flashes') }}                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('loss_activity', null, false, ['id' => 'for-loss_activity']) }}
                                        {{ Form::label('for-loss_activity', 'Loss of concentration, sociability, and activity.') }}                                         
                                    </div>
                                </div>
                                
                            </div>
                        <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('stess_increment', null, false, ['id' => 'for-stess']) }}
                                        {{ Form::label('for-stess', 'Increasingly stessed') }}                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('loss_interest', null, false, ['id' => 'for-loss_interest']) }}
                                        {{ Form::label('for-loss_interest', 'Loss of interest in Sex') }}                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('loose_skin', null, false, ['id' => 'for-loose_skin']) }}
                                        {{ Form::label('for-loose_skin', 'Sagging or Loose Skin') }}                                         
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('exercise_ability', null, false, ['id' => 'for-ability']) }}
                                        {{ Form::label('for-ability', 'Decreased desire and ability to exercise') }}                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('memory_decrement', null, false, ['id' => 'for-memory_decrement']) }}
                                        {{ Form::label('for-memory_decrement', 'Decreasing memory') }}                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('loss_muscle', null, false, ['id' => 'for-muscle']) }}
                                        {{ Form::label('for-muscle', 'Muscle loss') }}                                         
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('endurance', null, false, ['id' => 'for-endurance']) }}
                                        {{ Form::label('for-endurance', 'Decreased energy or endurance') }}                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('muscle_decrement', null, false, ['id' => 'for-muscle_decrement']) }}
                                        {{ Form::label('for-muscle_decrement', 'Decreasing muscle strength') }}                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('loss_hair', null, false, ['id' => 'for-loss_hair']) }}
                                        {{ Form::label('for-loss_hair', 'Thinning or loss of hair') }}                                         
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('sense_decrement', null, false, ['id' => 'for-sense_decrement']) }}
                                        {{ Form::label('for-sense_decrement', 'Decreased sense of well-being') }}                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('testicle_decrement', null, false, ['id' => 'for-testicle_decrement']) }}
                                        {{ Form::label('for-testicle_decrement', 'Decreasing Size of Testicles') }}                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('shrinkage', null, false, ['id' => 'for-shrinkage']) }}
                                        {{ Form::label('for-shrinkage', 'Penis Shrinkage / Urogenital Atrophy') }}                                         
                                    </div>
                                </div>
                            </div>
                        <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('osteoporosis', null, false, ['id' => 'for-osteoporosis']) }}
                                        {{ Form::label('for-osteoporosis', 'Progressive osteoporosis, decreasing bone mass or stooped posture') }}                                        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('intolerance', null, false, ['id' => 'for-intolerance']) }}
                                        {{ Form::label('for-intolerance', 'Cold or Heat Intolerance') }}                                         
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom chekbox-primary">
                                        {{ Form::checkbox('unexplained_weight', null, false, ['id' => 'for-unexplained_weight']) }}
                                        {{ Form::label('for-unexplained_weight', 'Unexplained Weight Gain or Weight Loss') }}                                         
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
       $('.harmoneActive').hide();
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