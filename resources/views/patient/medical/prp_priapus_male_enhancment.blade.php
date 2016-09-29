<?php /* name of this file is the reason disease title (removing special chars and replacing spaces with '_') of the particular reason this file belongs  */  ?>
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
                                {{ Form::label('abnormal', 'Does your penis have any abnormalities or Curveture? If Yes What Type?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                     @if(isset($priapus->abnormal)&& $priapus->abnormal  == 1)
                                                  {{ 'Yes' }}
                                                   @if(trim($priapus->abnormal_type)!= '')
                                                        <?php
                                                        switch(trim($weightL->surgeries_kind)) { 
                                                            case 'Unnatural Curve': echo "<br>Unnatural Curve";
                                                                break;
                                                            case 'Unusual Shrinkage': echo "<br>Unusual Shrinkage";
                                                                break;
                                                             case 'Unusual Appearance': echo "<br>Unusual Appearance";
                                                                break;
                                                            case 'Other': echo "<br>Other";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                                    @endif
                                              @elseif($priapus->abnormal == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('priapus_goal', 'What is your primary Goal By getting the Priapus Shot?', ['class' => 'col-sm-12 control-label']) }}
                                  <div class="col-sm-12">
                                       @if(isset($priapus->priapus_goal))
                                                        <?php
                                                        switch(trim($priapus->priapus_goal)) { 
                                                            case 'Penile Enlargment': echo "<br>Penile Enlargment";
                                                                break;
                                                            case 'Increased Sensetivity': echo "<br>Increased Sensetivity";
                                                                break;
                                                             case 'Erectile Dysfuntion Treatment': echo "<br>Erectile Dysfuntion Treatment";
                                                                break;
                                                            case 'Peyronies Disease Treatment': echo "<br>Peyronies Disease Treatment";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                              @else{{'N/A'}}
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="prp_treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('prp_before', 'Have you ever had PRP treatment before?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($priapus->prp_before)&& $priapus->prp_before == 1)
                                                  {{ 'Yes' }}
                                              @elseif($priapus->prp_before == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('pump_past', 'Have you ever used a penis pump in the past?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($priapus->pump_past)&& $priapus->pump_past == 1)
                                                  {{ 'Yes' }}
                                              @elseif($priapus->pump_past == 0)
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
                                    {{ Form::label('implants', 'Have you ever had any  type of Penile implants or Surgeries?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                           @if(isset($priapus->implant_surgery)&& $priapus->implant_surgery == 1)
                                                  {{ 'Yes' }}
                                              @elseif($priapus->implant_surgery == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
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
                              
                                         @if(isset($priapus->pre_activity_score))
                                                        <?php
                                                        switch(trim($priapus->priapus_goal)) { 
                                                            case '1': echo "Almost Never or Never";
                                                                break;
                                                            case '2': echo "A few Times much less than 1/2 the Time";
                                                                break;
                                                            case '3': echo "Sometimes about 1/2 the time";
                                                                break;
                                                            case '4': echo "Most times much More than 1/2 the time";
                                                                break;
                                                            case '5': echo "Almost Always or Always";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                              @else{{'N/A'}}
                                        @endif
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('prp_stimulation_score', 'When you have erections with sexual stimulation how often were your erections hard enough for Penetration?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    
                                     @if(isset($priapus->prp_stimulation_score))
                                                        <?php
                                                        switch(trim($priapus->prp_stimulation_score)) { 
                                                            case '1': echo "Almost Never or Never";
                                                                break;
                                                            case '2': echo "A few Times much less than 1/2 the Time";
                                                                break;
                                                            case '3': echo "Sometimes about 1/2 the time";
                                                                break;
                                                            case '4': echo "Most times much More than 1/2 the time";
                                                                break;
                                                            case '5': echo "Almost Always or Always";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                              @else{{'N/A'}}
                                        @endif
                                    
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('prp_intercourse', 'When you attempted Intercourse how often were you able to penetrate your partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($priapus->prp_intercourse_score))
                                                        <?php
                                                        switch(trim($priapus->prp_intercourse_score)) { 
                                                            case '1': echo "Almost Never or Never";
                                                                break;
                                                            case '2': echo "A few Times much less than 1/2 the Time";
                                                                break;
                                                            case '3': echo "Sometimes about 1/2 the time";
                                                                break;
                                                            case '4': echo "Most times much More than 1/2 the time";
                                                                break;
                                                            case '5': echo "Almost Always or Always";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                              @else{{'N/A'}}
                                        @endif
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('prp_maintain', 'During sexual Intercourse, how often were you able to maintain your erection after you had penetrated your partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                     @if(isset($priapus->prp_maintain_score))
                                                        <?php
                                                        switch(trim($priapus->prp_maintain_score)) { 
                                                            case '1': echo "Almost Never or Never";
                                                                break;
                                                            case '2': echo "A few Times much less than 1/2 the Time";
                                                                break;
                                                            case '3': echo "Sometimes about 1/2 the time";
                                                                break;
                                                            case '4': echo "Most times much More than 1/2 the time";
                                                                break;
                                                            case '5': echo "Almost Always or Always";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                              @else{{'N/A'}}
                                        @endif
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('prp_difficult', 'During sexual intercourse how difficult is it to maintain your erection through completion (orgasm) after you have penetrated  Your Partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    @if(isset($priapus->prp_difficult_score))
                                                        <?php
                                                        switch(trim($priapus->prp_difficult_score)) { 
                                                            case '1': echo "Almost Never or Never";
                                                                break;
                                                            case '2': echo "A few Times much less than 1/2 the Time";
                                                                break;
                                                            case '3': echo "Sometimes about 1/2 the time";
                                                                break;
                                                            case '4': echo "Most times much More than 1/2 the time";
                                                                break;
                                                            case '5': echo "Almost Always or Always";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                              @else{{'N/A'}}
                                        @endif
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
		if($("input[name='abnormal']:checked").val() == 1){
			$('.abnormalActive').show();
		}
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