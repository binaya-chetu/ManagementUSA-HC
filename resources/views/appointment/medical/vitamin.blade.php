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
                                    {{ Form::label('needle_afraid', 'Are you afraid of Needles?  If yes How afraid?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('needle_afraid', '1', false, ['id' => 'needle_afraid1']) }}
                                            {{ Form::label('needle_afraid1', 'Yes') }}
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('needle_afraid', '0', false, ['id' => 'needle_afraid2']) }}
                                            {{ Form::label('needle_afraid2', 'No') }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-6 needleAfraidActive">
                                <div class="form-group">
                                    {{ Form::label('afraid_limit', 'How Afraid?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $limit = [ 'Very ' => 'Very', 'Somewhat' => 'Somewhat', 'just a little' => 'just a little']; ?>
                                        {{ Form::select('afraid_limit', ['' => 'Please Select'] + $limit, null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('injectable_type', 'What are you seeking from IV or Injectable Vitamin Therapy?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $type = [ 'Wellness ' => 'Wellness', 'Pain Management' => 'Pain Management', 'Anti-aging' => 'Anti-aging', 'Wound Healing' => 'Wound Healing', 'Preventative Care' => 'Preventative Care']; ?>
                                        {{ Form::select('injectable_type', ['' => 'Please Select'] + $type, null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>                              
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('total_wellness', 'How do you feel about your total wellness?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $wellness = [ 'Poor ' => 'Poor', 'Ok' => 'Ok', 'Good' => 'Good', 'Great' => 'Great']; ?>
                                        {{ Form::select('total_wellness', ['' => 'Please Select'] + $wellness, null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">

                            <div class="form-group">
                                {{ Form::label('weight_supplement', 'Have you Ever Been On Any Prescription Drug or Supplement For Weight Loss? If Yes What?', ['class' => 'col-sm-9 control-label']) }}
                                <div class="col-sm-3 toggle-radio-custom">
                                    <div class="col-sm-6 radio-custom radio-primary">
                                        {{ Form::radio('weight_supplement', '1', false, ['id' => 'weight_supplement1']) }}
                                        {{ Form::label('weight_supplement1', 'Yes') }}
                                    </div>
                                    <div class="col-sm-6 radio-custom radio-primary">
                                        {{ Form::radio('weight_supplement', '0', false, ['id' => 'weight_supplement2']) }}
                                        {{ Form::label('weight_supplement2', 'No') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('knowledge', 'How Much do you know about Vitamins and how they work in your body?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $knowledge = [ 'Nothing' => 'Nothing', 'Very Little' => 'Very Little', 'Some' => 'Some', 'Expert' => 'Expert']; ?>
                                        {{ Form::select('vitamin_knowledge', ['' => 'Please Select'] + $knowledge, null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="vitamin_treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('vitamin_taken', 'Do you currently take a Vitamin Supplement?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('vitamin_taken', '1', false, ['id' => 'vitamin_taken1', 'class' => 'modelShow']) }}
                                            {{ Form::label('vitamin_taken1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('vitamin_taken', '0', false, ['id' => 'vitamin_taken2']) }}
                                            {{ Form::label('vitamin_taken2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('wellness_tested', 'Have you ever been tested for your vitamin Total wellness?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('wellness_tested', '1', false, ['id' => 'wellness_tested1']) }}
                                            {{ Form::label('wellness_tested1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('wellness_tested', '0', false, ['id' => 'wellness_tested2']) }}
                                            {{ Form::label('wellness_tested2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('vitamin_before', 'Have you ever had a IV Vitamin Drip Before?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('vitamin_drip', '1', false, ['id' => 'vitamin_drip1']) }}
                                            {{ Form::label('vitamin_drip1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('vitamin_drip', '0', false, ['id' => 'vitamin_drip2']) }}
                                            {{ Form::label('vitamin_drip2', 'No') }} 
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
        $('.needleAfraidActive').hide();
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