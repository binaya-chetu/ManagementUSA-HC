<?php /* name of this file is the reason disease title (removing special chars and replacing spaces with '_') of the particular reason this file belongs  */  ?>
<div class="col-md-12">
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>
            <h2 class="panel-title">Erectile Dysfunction / Premature Ejaculation ( ED/PD )</h2>
        </header>
        <div class="panel-body">
            <div class="tabs tabs-primary">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#lifestyle" data-toggle="tab"><i class="fa fa-star"></i> Lifestyle Information</a>
                    </li>
                    <li>
                        <a href="#treatment" data-toggle="tab">Treatment Questions</a>
                    </li>
                    <li>
                        <a href="#intensity" data-toggle="tab">Ed Intensity Test</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="lifestyle" class="tab-pane active">
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('sex', 'Are You Currently Having Sex? If Yes With Who and How Often?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    @if(isset($erectileD->sex_status)&& $erectileD->sex_status  == 1)
                                                  {{ 'Yes' }}
                                                    <div class="col-sm-12 inputRow selectSex">
                                                          <div class="col-sm-12">
                                                              <div class="form-group">								
                                                                  {{ Form::label('sex_often', 'How often?', ['class' => 'col-sm-12 control-label']) }}
                                                                  <div class="col-sm-12">
                                                                      @if(isset($erectileD->sex_often))
                                                                        {{$erectileD->sex_often}}
                                                                      @else
                                                                        {{'N/A'}}
                                                                      @endif
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-12">
                                                              <div class="form-group">
                                                                  {{ Form::label('with', 'With Who?', ['class' => 'col-sm-12 control-label']) }}
                                                                  <div class="col-sm-12">
                                                                        @if(!empty($erectileD->sex_with))
                                                                             {{$erectileD->sex_with}}  
                                                                        @else
                                                                             {{'N/A'}}
                                                                       @endif
                                                                  </div>
                                                              </div>
                                                          </div>
                                                     </div>    
                                              @elseif($erectileD->sex_status == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('pronography', 'Do you often watch pornography on the Web,  or in books or magazines?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                   @if(isset($erectileD->pronography)&& $erectileD->pronography  == 1)
                                            {{ 'Yes' }}
                                        @elseif($erectileD->pronography == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('prostate', 'Have you ever had Prostate removal or Sugery?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                          @if(isset($erectileD->prostate_removal)&& $erectileD->prostate_removal  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->prostate_removal == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('nerve', 'Have you Ever Had Nerve Damage or a major Spinal Surgery?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($erectileD->nerve_damage)&& $erectileD->nerve_damage  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->nerve_damage == 0)
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
                                    {{ Form::label('erectile', 'Did your Erectile Dysfunction coincide with use of a new drug?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($erectileD->erectile)&& $erectileD->erectile  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->erectile == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('implant', 'Do you have or have ever had a penile implant or other prosthetic implant surgery?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($erectileD->implant)&& $erectileD->implant  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->implant == 0)
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
                                    {{ Form::label('pump', 'Have you ever used a penis pump and cylinder with Penis Ring?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($erectileD->penis_pump)&& $erectileD->penis_pump  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->penis_pump == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('recreational', 'Have you used any recreational drugs in the last 24 hours?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($erectileD->recreational)&& $erectileD->recreational  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->recreational == 0)
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
                                    {{ Form::label('ejaculate', 'Do you Ejaculate before you want to while having intercourse?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($erectileD->ejaculate)&& $erectileD->ejaculate  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->ejaculate == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('medicine_used', 'Have you used Viagra Levitra or Cialis in the last 24 hours?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($erectileD->medicine_used)&& $erectileD->medicine_used  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->medicine_used == 0)
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
                                    {{ Form::label('sickle', 'Do You Have Sickle Cell Anemia?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($erectileD->sickle)&& $erectileD->sickle  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->sickle == 0)
                                                  {{'No'}}
                                              @else
                                                  {{ 'N/A' }}
                                              @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('dwarfing', 'Do you have any Dwarfing Traits?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($erectileD->dwarfing)&& $erectileD->dwarfing  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->dwarfing == 0)
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
                                    {{ Form::label('hiv', 'Do you have HIV or any form of Hepititis?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($erectileD->hiv)&& $erectileD->hiv  == 1)
                                                  {{ 'Yes' }}
                                              @elseif($erectileD->hiv == 0)
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
                                {{ Form::label('sex_medicine', 'Have you Ever Used Viagra, Levitra, or Cialis? If yes which one, did it work, Last time used, does it still work, and did you encounter any side effects?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12">
                                     @if(isset($erectileD->sex_medicine)&& $erectileD->sex_medicine  == 1)
                                                  {{ 'Yes' }}
                                                  <div class='medicineProperty'>
                                                      <div class="col-sm-12 inputRow">
                                                          <div class="col-sm-12">
                                                              <div class="form-group">
                                                                  {{ Form::label('medicine_name', 'Which One?', ['class' => 'col-sm-12 control-label']) }}
                                                                  <div class="col-sm-12 toggle-radio-custom">
                                                                        @if(isset($erectileD->medicine_name))
                                                                           {{ $erectileD->medicine_name }}
                                                                        @else
                                                                          {{ 'N/A' }}
                                                                        @endif
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-12">
                                                              <div class="form-group">
                                                                  {{ Form::label('medicine_work', 'Did it Work?', ['class' => 'col-sm-12 control-label']) }}
                                                                  <div class="col-sm-12 toggle-radio-custom">
                                                                    @if(isset($erectileD->medicine_work)&& $erectileD->medicine_work  == 1)
                                                                          {{ 'Yes' }}
                                                                      @elseif($erectileD->medicine_work == 0)
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
                                                                  {{ Form::label('last_used', 'last time used?', ['class' => 'col-sm-12 control-label']) }}
                                                                  <div class="col-sm-12 toggle-radio-custom">
                                                                      @if(isset($erectileD->last_used))
                                                                          {{ $erectileD->last_used }}
                                                                      @else
                                                                          {{ 'N/A' }}
                                                                      @endif
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-12">
                                                              <div class="form-group">
                                                                  {{ Form::label('still_work', 'Does it still Work?', ['class' => 'col-sm-12 control-label']) }}                                        
                                                                  <div class="col-sm-12 toggle-radio-custom">
                                                                        @if(isset($erectileD->still_work))
                                                                            {{ $erectileD->still_work }}
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
                                                                  {{ Form::label('side', 'Did you encounter side effects?', ['class' => 'col-sm-12 control-label']) }}
                                                                  <div class="col-sm-12 toggle-radio-custom">
                                                                     @if(isset($erectileD->side_effect)&& $erectileD->side_effect  == 1)
                                                                          {{ 'Yes' }}
                                                                      @elseif($erectileD->side_effect == 0)
                                                                          {{'No'}}
                                                                      @else
                                                                          {{ 'N/A' }}
                                                                      @endif
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>   
                                              @elseif($erectileD->sex_medicine == 0)
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
                                    {{ Form::label('erection', 'When Was the last Time you had a morning Erection?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                            @if(isset($erectileD->erection_time))
                                                {{ $erectileD->erection_time }}
                                                @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('erection_kind', 'When Was the last Time you had a of Any Kind Erection?', ['class' => 'col-sm-12 control-label']) }}                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                              @if(isset($erectileD->erection_kind))
                                                  {{ $erectileD->erection_kind }}
                                              @else {{ 'N/A' }}
                                              
                                              @endif
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('erection_strength', 'On a scale of 1 - 10(10 being completely Erect), What was the strength of that last  known erection?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($erectileD->erection_strength))
                                            {{ $erectileD->erection_strength }}
                                            @else
                                            {{'N/A'}}
                                        @endif
                                    </div>    
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="intensity" class="tab-pane">
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('get_erection', 'How Often Are you Able to Get an Erection During Sexual activity?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                      @if(isset($erectileD->activity_score))
                                            {{ $erectileD->activity_score }}
                                            @else
                                            {{ 'N/A' }}
                                        @endif
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('stimulation_score', 'When you have erections with sexual stimulation how often were your erections hard enough for Penetration?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    @if(isset($erectileD->stimulation_score))
                                            {{ $erectileD->stimulation_score }}
                                            @else
                                            {{ 'N/A' }}
                                        @endif
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('intercourse', 'When you attempted Intercourse how often were you able to penetrate your partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                     @if(isset($erectileD->intercourse_score))
                                            {{ $erectileD->intercourse_score }}
                                            @else
                                            {{ 'N/A' }}
                                        @endif
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('maintain', 'During sexual Intercourse, how often were you able to maintain your erection after you had penetrated your partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                     @if(isset($erectileD->maintain_score))
                                            {{ $erectileD->maintain_score }}
                                            @else
                                            {{ 'N/A' }}
                                        @endif
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('difficult', 'During sexual intercourse how difficult is it to maintain your erection through completion (orgasm) after you have penetrated  Your Partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                     @if(isset($erectileD->difficult_score))
                                            {{ $erectileD->difficult_score }}
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
    </section>
</div>
<script>
    $(document).ready(function() {
        /**
         * ED/PD file javascript code
         */
        $('.medicineProperty').hide();
		
		if($("input[name='sex_medicine']:checked").val() == 1){
			$('.medicineProperty').show();
		}
        /** 
         * If patient take the sexual medicine then show the corresponding fields
         *  */
        $("input[name='sex_medicine']").click(function() {
            var medicine_status = $(this).val();
            if (medicine_status == 1) {
                $('.medicineProperty').show();
            } else {
                $('.medicineProperty').hide();
            }
        });
    });
</script>