<div class="col-md-12">
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>
            <h2 class="panel-title">PRP Priapus Male Enhancment</h2>
        </header>
        <div class="panel-body">
            <div class="tabs tabs-primary">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#prp_begin" data-toggle="tab"><i class="fa fa-star"></i>Beginning Information</a>
                    </li>
                    <li>
                        <a href="#prp_treatment" data-toggle="tab">Priapus Treatment Questions</a>
                    </li>
                    <li>
                        <a href="#prp_intensity" data-toggle="tab">Ed Intensity Test</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="prp_begin" class="tab-pane active">
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('abnormal', 'Does your penis have any abnormalities or Curveture? If Yes What Type?', ['class' => 'col-sm-6 control-label']) }}
                                <div class="col-sm-6 toggle-radio-custom">
                                    <div class="col-sm-3 radio-custom radio-primary">
                                        {{ Form::radio('abnormal', '1', false, ['id' => 'abnormal1']) }}
                                        {{ Form::label('abnormal1', 'Yes') }}
                                    </div>
                                    <div class="col-sm-3 radio-custom radio-primary">
                                        {{ Form::radio('abnormal', '0', false, ['id' => 'abnormal2']) }}
                                        {{ Form::label('abnormal2', 'No') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow abnormalActive">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('abnormal_type', 'What Type?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $type = [ 'Unnatural Curve' => 'Unnatural Curve', 'Unusual Shrinkage' => 'Unusual Shrinkage', 'Unusual Appearance' => 'Unusual Appearance', 'Other' => 'Other']; ?>
                                        {{ Form::select('abnormal_type', ['' => 'Please Select'] + $type, null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('priapus_goal', 'What is your primary Goal By getting the Priapus Shot?', ['class' => 'col-sm-6 control-label']) }}
                                <div class="col-sm-6">
                                        <?php $goal = [ 'Penile Enlargment' => 'Penile Enlargment', 'Increased Sensetivity' => 'Increased Sensetivity', 'Erectile Dysfuntion Treatment' => 'Erectile Dysfuntion Treatment', 'Peyronies Disease Treatment' => 'Peyronies Disease Treatment']; ?>
                                        {{ Form::select('priapus_goal', ['' => 'Please Select'] + $goal, null, ['class' => 'form-control input']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="prp_treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('prp_before', 'Have you ever had PRP treatment before?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('prp_before', '1', false, ['id' => 'prp_before1']) }}
                                            {{ Form::label('prp_before1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('prp_before', '0', false, ['id' => 'prp_before2']) }}
                                            {{ Form::label('prp_before2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('pump_past', 'Have you ever used a penis pump in the past?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('pump_past', '1', false, ['id' => 'pump_past1']) }}
                                            {{ Form::label('pump_past1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('pump_past', '0', false, ['id' => 'pump_past2']) }}
                                            {{ Form::label('pump_past2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('implants', 'Have you ever had any  type of Penile implants or Surgeries?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('implant_surgery', '1', false, ['id' => 'implant_surgery1']) }}
                                            {{ Form::label('implant_surgery1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('implant_surgery', '0', false, ['id' => 'implant_surgery2']) }}
                                            {{ Form::label('implant_surgery2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                    <div id="prp_intensity" class="tab-pane">
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('get_erection', 'How Often Are you Able to Get an Erection During Sexual activity?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('pre_activity_score', '1', false, ['id' => 'pre_erection_sexual1']) }}
                                        {{ Form::label('pre_erection_sexual1', 'Almost Never or Never') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('pre_activity_score', '2', false, ['id' => 'pre_erection_sexual2']) }}
                                        {{ Form::label('pre_erection_sexual2', 'A few Times much less than 1/2 the Time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('pre_activity_score', '3', false, ['id' => 'pre_erection_sexual3']) }}
                                        {{ Form::label('pre_erection_sexual3', 'Sometimes about 1/2 the time') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('pre_activity_score', '4', false, ['id' => 'pre_erection_sexual4']) }}
                                        {{ Form::label('pre_erection_sexual4', 'Most times much More than 1/2 the time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('pre_activity_score', '5', false, ['id' => 'pre_erection_sexual5']) }}
                                        {{ Form::label('pre_erection_sexual5', 'Almost Always or Always') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('prp_stimulation_score', 'When you have erections with sexual stimulation how often were your erections hard enough for Penetration?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_stimulation_score', '1', false, ['id' => 'pre_stimulation1']) }}
                                        {{ Form::label('pre_stimulation1', 'Almost Never or Never') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_stimulation_score', '2', false, ['id' => 'pre_stimulation2']) }}
                                        {{ Form::label('pre_stimulation2', 'A few Times much less than 1/2 the Time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_stimulation_score', '3', false, ['id' => 'pre_stimulation3']) }}
                                        {{ Form::label('pre_stimulation3', 'Sometimes about 1/2 the time') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_stimulation_score', '4', false, ['id' => 'pre_stimulation4']) }}
                                        {{ Form::label('pre_stimulation4', 'Most times much More than 1/2 the time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_stimulation_score', '5', false, ['id' => 'pre_stimulation5']) }}
                                        {{ Form::label('pre_stimulation5', 'Almost Always or Always') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('prp_intercourse', 'When you attempted Intercourse how often were you able to penetrate your partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_intercourse_score', '1', false, ['id' => 'prp_intercourse1']) }}
                                        {{ Form::label('prp_intercourse1', 'Almost Never or Never') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_intercourse_score', '2', false, ['id' => 'prp_intercourse2']) }}
                                        {{ Form::label('prp_intercourse2', 'A few Times much less than 1/2 the Time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_intercourse_score', '3', false, ['id' => 'prp_intercourse3']) }}
                                        {{ Form::label('prp_intercourse3', 'Sometimes about 1/2 the time') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_intercourse_score', '4', false, ['id' => 'prp_intercourse4']) }}
                                        {{ Form::label('prp_intercourse4', 'Most times much More than 1/2 the time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_intercourse_score', '5', false, ['id' => 'prp_intercourse5']) }}
                                        {{ Form::label('prp_intercourse5', 'Almost Always or Always') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('prp_maintain', 'During sexual Intercourse, how often were you able to maintain your erection after you had penetrated your partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_maintain_score', '1', false, ['id' => 'prp_maintain1']) }}
                                        {{ Form::label('prp_maintain1', 'Almost Never or Never') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_maintain_score', '2', false, ['id' => 'prp_maintain2']) }}
                                        {{ Form::label('prp_maintain2', 'A few Times much less than 1/2 the Time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_maintain_score', '3', false, ['id' => 'prp_maintain3']) }}
                                        {{ Form::label('prp_maintain3', 'Sometimes about 1/2 the time') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_maintain_score', '4', false, ['id' => 'prp_maintain4']) }}
                                        {{ Form::label('prp_maintain4', 'Most times much More than 1/2 the time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_maintain_score', '5', false, ['id' => 'prp_maintain5']) }}
                                        {{ Form::label('prp_maintain5', 'Almost Always or Always') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('prp_difficult', 'During sexual intercourse how difficult is it to maintain your erection through completion (orgasm) after you have penetrated  Your Partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_difficult_score', '1', false, ['id' => 'prp_difficult1']) }}
                                        {{ Form::label('prp_difficult1', 'Almost Never or Never') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_difficult_score', '2', false, ['id' => 'prp_difficult2']) }}
                                        {{ Form::label('prp_difficult2', 'A few Times much less than 1/2 the Time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_difficult_score', '3', false, ['id' => 'prp_difficult3']) }}
                                        {{ Form::label('prp_difficult3', 'Sometimes about 1/2 the time') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_difficult_score', '4', false, ['id' => 'prp_difficult4']) }}
                                        {{ Form::label('prp_difficult4', 'Most times much More than 1/2 the time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('prp_difficult_score', '5', false, ['id' => 'prp_difficult5']) }}
                                        {{ Form::label('prp_difficult5', 'Almost Always or Always') }}                                                            
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
        /**
         * ED/PD file javascript code
         */
        $('.abnormalActive').hide();
        /** 
         * If patient take the sexual medicine then show the corresponding fields
         *  */
        $("input[name='abnormal']").click(function() {
            var medicine_status = $(this).val();
            if (medicine_status == 1) {
                $('.abnormalActive').show();
            } else {
                $('.abnormalActive').hide();
            }
        });
    });
</script>