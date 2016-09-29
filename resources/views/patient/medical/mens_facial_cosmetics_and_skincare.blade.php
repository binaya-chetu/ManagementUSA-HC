<?php /* name of this file is the reason disease title (removing special chars and replacing spaces with '_') of the particular reason this file belongs  */  ?>
<div class="col-md-12">
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>
            <h2 class="panel-title">Mens Facial Cosmetics and Skincare</h2>
        </header>
        <div class="panel-body">
            <div class="tabs tabs-primary">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#cosmetics_beginning" data-toggle="tab"><i class="fa fa-star"></i> Beginning Information</a>
                    </li>
                    <li>
                        <a href="#cosmetics_treatment" data-toggle="tab">Treatment Questions</a>
                    </li>                    
                </ul>
                <div class="tab-content">
                    <div id="cosmetics_beginning" class="tab-pane active">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('facial_surgeries', 'Have you Ever Had Any Type of Facial Surgeries or Facial Enhancements? If So What Kind?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(count($cosmetics->facial_surgeries)&& $cosmetics->facial_surgeries == 1)
                                                  {{ 'Yes' }}
                                                    <div class="col-sm-12 facialActive">
                                                        <div class="form-group">
                                                            {{ Form::label('facial_kind', 'What kind?', ['class' => 'col-sm-12 control-label']) }}
                                                            <div class="col-sm-12">
                                                               <?php echo trim($cosmetics->facial_kind);?>
                                                               @if(count($cosmetics->facial_kind) == 1)
                                                                                <?php
                                                                                switch(trim($cosmetics->facial_kind)) { 
                                                                                    case 'Botox/Fillers': echo "Botox/Fillers";
                                                                                        break;
                                                                                    case 'Plastic Sugery': echo "Plastic Sugery";
                                                                                        break;
                                                                                    case 'Spa Facials': echo "Spa Facials";
                                                                                        break;
                                                                                    default: echo "N/A";
                                                                                }
                                                                                ?>
                                                                      @else{{'N/A'}}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                              @elseif($cosmetics->facial_surgeries == 0)
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
                                    {{ Form::label('face_wash', 'What Do you wash your face with?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                       @if(count($cosmetics->face_wash) == 1)
                                                        <?php
                                                        switch(trim($cosmetics->face_wash)) { 
                                                            case 'Whatevers On Sale': echo "Whatevers On Sale";
                                                                break;
                                                            case 'Basic Soap': echo "Basic Soap";
                                                                break;
                                                            case 'Specialty Soap': echo "Specialty Soap";
                                                                break;
                                                            case 'Skincare Product': echo "Skincare Product";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                              @else{{'N/A'}}
                                        @endif
                                    </div>
                                </div>                              
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('exposure', 'How Much Exposure do you have to the sun?  (Consider Work, Recreation, and Daily life)', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                        
                                         @if(count($cosmetics->exposure) == 1)
                                                        <?php
                                                        switch(trim($cosmetics->exposure)) { 
                                                            case 'A lot': echo "A lot";
                                                                break;
                                                            case 'Fair Amount': echo "Fair Amount";
                                                                break;
                                                            case 'Very Little': echo "Very Little";
                                                                break;
                                                            case 'Average': echo "Average";
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
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('skin_look', 'Choose the way you feel about how you feel your skin looks.', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                   
                                          @if(count($cosmetics->skin_look) == 1)
                                                        <?php
                                                        switch(trim($cosmetics->skin_look)) { 
                                                            case 'Leathery': echo "Leathery";
                                                                break;
                                                            case 'Sun Damaged': echo "Sun Damaged";
                                                                break;
                                                            case 'Old and loose': echo "Old and loose";
                                                                break;
                                                            case 'Looks Great': echo "Looks Great";
                                                                break;
                                                            default: echo "N/A";
                                                        }
                                                        ?>
                                              @else{{'N/A'}}
                                        @endif
                                    </div>
                                </div>                              
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('look_score', 'On a Scale of 1-10  (10 Being Very Important) How Important is it for you to look good for work, dating, spouse, or Just for your personel confidence?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                        
                                          @if(count($cosmetics->look_score) == 1)
                                                <?php
                                                  for($i = 1 ;$i <= 10; $i++){
                                                      if($i == trim($cosmetics->look_score)){
                                                          echo trim($cosmetics->look_score);
                                                      }
                                                      
                                                  }
                                                ?>
                                              @else{{'N/A'}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('happy_score', 'On a Scale of 1-10  (10 Being Very Happy) How Happy Are you with the way you look?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                           @if(count($cosmetics->happy_score) == 1)
                                                <?php
                                                  for($i = 1 ;$i <= 10; $i++){
                                                      if($i == trim($cosmetics->happy_score)){
                                                          echo trim($cosmetics->happy_score);
                                                      }
                                                      
                                                  }
                                                ?>
                                              @else{{'N/A'}}
                                        @endif
                                    </div>
                                </div>                              
                            </div>                            
                        </div>
                     
                    </div>
                    <div id="cosmetics_treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('crowsfeet', 'Do you have Crowsfeet(Wrinkles around the eyes)', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(count($cosmetics->crowsfeet)&& $cosmetics->crowsfeet == 1)
                                                  {{ 'Yes' }}
                                              @elseif($cosmetics->crowsfeet == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('facial_expression', 'When you Change your facial Expression do you see your forehead wrinkle up?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(count($cosmetics->facial_expression)&& $cosmetics->facial_expression == 1)
                                                  {{ 'Yes' }}
                                              @elseif($cosmetics->facial_expression == 0)
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
                                    {{ Form::label('sunken', 'Has your face become more sunken in over the years?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(count($cosmetics->sunken)&& $cosmetics->sunken == 1)
                                                  {{ 'Yes' }}
                                              @elseif($cosmetics->sunken == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('bullfrog_looking', 'Do you have excessive fat below your chin on your kneck? (Bullfrog Looking)', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(count($cosmetics->bullfrog_looking)&& $cosmetics->bullfrog_looking == 1)
                                                  {{ 'Yes' }}
                                              @elseif($cosmetics->bullfrog_looking == 0)
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
                                    {{ Form::label('loose_skin', 'Does your face have a lot of Loose skin which has developed over time?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(count($cosmetics->loose_skin)&& $cosmetics->loose_skin == 1)
                                                  {{ 'Yes' }}
                                              @elseif($cosmetics->loose_skin == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('thin_lip', 'Do you feel your lips are too thin?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(count($cosmetics->thin_lip)&& $cosmetics->thin_lip == 1)
                                                  {{ 'Yes' }}
                                              @elseif($cosmetics->thin_lip == 0)
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
                                    {{ Form::label('face_spot', 'Have you noticed dark, grey, red or other permanent spots on your face?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(count($cosmetics->face_spot)&& $cosmetics->face_spot == 1)
                                                  {{ 'Yes' }}
                                              @elseif($cosmetics->face_spot == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('acne', 'Do you suffer from Acne or have Acne Scars?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(count($cosmetics->acne)&& $cosmetics->acne == 1)
                                                  {{ 'Yes' }}
                                              @elseif($cosmetics->acne == 0)
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
                                    {{ Form::label('skin_tag', 'Have you noticed Skin Tags or broken blood vessels on the nose or on your face?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(count($cosmetics->skin_tag)&& $cosmetics->skin_tag == 1)
                                                  {{ 'Yes' }}
                                              @elseif($cosmetics->skin_tag == 0)
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
        $('.facialActive').hide();
		if($("input[name='facial_surgeries']:checked").val() == 1){
			$('.facialActive').show();
		}
        /** 
         * If Patient has the facial surgeries then show the corresponding fields
         *  */
        $("input[name='facial_surgeries']").click(function() {
            var exercise_status = $(this).val();
            if (exercise_status == 1) {
                $('.facialActive').show();
            } else {
                $('.facialActive').hide();
            }
        });

    });
</script>