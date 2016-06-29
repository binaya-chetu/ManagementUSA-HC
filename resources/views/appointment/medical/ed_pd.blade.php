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
                                {{ Form::label('sex', 'Are You Currently Having Sex? If Yes With Who and How Often?', ['class' => 'col-sm-6 control-label']) }}
                                <div class="col-sm-6 toggle-radio-custom">
                                    <div class="col-sm-3 radio-custom radio-primary">
										{{ Form::radio('sex_status', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('sex_status', '1', $erectileD && $erectileD->sex_status == '1', ['id' => 'sex1']) }}
                                        {{ Form::label('sex1', 'Yes') }}
                                    </div>
                                    <div class="col-sm-3 radio-custom radio-primary">
                                        {{ Form::radio('sex_status', '0', $erectileD && $erectileD->sex_status == '0', ['id' => 'sex2']) }}
                                        {{ Form::label('sex2', 'No') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow selectSex">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('sex_often', 'How often?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $often = [ 'Weekly' => 'Weekly', 'Monthly' => 'Monthly', 'Less Than Monthly' => 'Less Than Monthly']; ?>
                                        {{ Form::select('sex_often', ['' => 'Please Select'] + $often, null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('with', 'With Who?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $who = [ 'Spouse' => 'Spouse', 'Girlfriend' => 'Girlfriend', 'Casual Date' => 'Casual Date']; ?>
                                        {{ Form::select('sex_with', ['' => 'Please Select'] + $who, null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('pronography', 'Do you often watch pornography on the Web,  or in books or magazines?', ['class' => 'col-sm-6 control-label']) }}
                                <div class="col-sm-6 toggle-radio-custom">
                                    <div class="col-sm-3 radio-custom radio-primary">
										{{ Form::radio('pronography', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('pronography', '1', $erectileD && $erectileD->pronography == '1', ['id' => 'pronography1']) }}
                                        {{ Form::label('pronography1', 'Yes') }}
                                    </div>
                                    <div class="col-sm-3 radio-custom radio-primary">
                                        {{ Form::radio('pronography', '0', $erectileD && $erectileD->pronography == '0', ['id' => 'pronography2']) }}
                                        {{ Form::label('pronography2', 'No') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('prostate', 'Have you ever had Prostate removal or Sugery?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('prostate_removal', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('prostate_removal', '1', $erectileD && $erectileD->prostate_removal == '1', ['id' => 'prostate1']) }}
                                            {{ Form::label('prostate1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('prostate_removal', '0', $erectileD && $erectileD->prostate_removal == '0', ['id' => 'prostate2']) }}
                                            {{ Form::label('prostate2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('nerve', 'Have you Ever Had Nerve Damage or a major Spinal Surgery?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('nerve_damage', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('nerve_damage', '1', $erectileD && $erectileD->nerve_damage == '1', ['id' => 'nerve1']) }}
                                            {{ Form::label('nerve1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('nerve_damage', '0', $erectileD && $erectileD->nerve_damage == '0', ['id' => 'nerve2']) }}
                                            {{ Form::label('nerve2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('erectile', 'Did your Erectile Dysfunction coincide with use of a new drug?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('erectile', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('erectile', '1', $erectileD && $erectileD->erectile == '1', ['id' => 'erectile1']) }}
                                            {{ Form::label('erectile1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('erectile', '0', $erectileD && $erectileD->erectile == '0', ['id' => 'erectile2']) }}
                                            {{ Form::label('erectile2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('implant', 'Do you have or have ever had a penile implant or other prosthetic implant surgery?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('implant', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('implant', '1', $erectileD && $erectileD->implant == '1', ['id' => 'implant1']) }}
                                            {{ Form::label('implant1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('implant', '0', $erectileD && $erectileD->implant == '0', ['id' => 'implant2']) }}
                                            {{ Form::label('implant2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('pump', 'Have you ever used a penis pump and cylinder with Penis Ring?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('penis_pump', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('penis_pump', '1', $erectileD && $erectileD->penis_pump == '1', ['id' => 'pump1']) }}
                                            {{ Form::label('pump1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('penis_pump', '0', $erectileD && $erectileD->penis_pump == '0', ['id' => 'pump2']) }}
                                            {{ Form::label('pump2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('recreational', 'Have you used any recreational drugs in the last 24 hours?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('recreational', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('recreational', '1', $erectileD && $erectileD->recreational == '1', ['id' => 'recreational1']) }}
                                            {{ Form::label('recreational1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('recreational', '0', $erectileD && $erectileD->recreational == '0', ['id' => 'recreational2']) }}
                                            {{ Form::label('recreational2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('ejaculate', 'Do you Ejaculate before you want to while having intercourse?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('ejaculate', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('ejaculate', '1', $erectileD && $erectileD->ejaculate == '0', ['id' => 'ejaculate1']) }}
                                            {{ Form::label('ejaculate1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('ejaculate', '0', $erectileD && $erectileD->ejaculate == '0', ['id' => 'ejaculate2']) }}
                                            {{ Form::label('ejaculate2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('medicine_used', 'Have you used Viagra Levitra or Cialis in the last 24 hours?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('medicine_used', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('medicine_used', '1', $erectileD && $erectileD->medicine_used == '0', ['id' => 'viagra1']) }}
                                            {{ Form::label('viagra1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('medicine_used', '0', $erectileD && $erectileD->medicine_used == '0', ['id' => 'viagra2']) }}
                                            {{ Form::label('viagra2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('sickle', 'Do You Have Sickle Cell Anemia?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('sickle', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('sickle', '1', $erectileD && $erectileD->sickle == '1', ['id' => 'sickle1']) }}
                                            {{ Form::label('sickle1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('sickle', '0', $erectileD && $erectileD->sickle == '0', ['id' => 'sickle2']) }}
                                            {{ Form::label('sickle2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('dwarfing', 'Do you have any Dwarfing Traits?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('dwarfing', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('dwarfing', '1', $erectileD && $erectileD->dwarfing == '1', ['id' => 'dwarfing1']) }}
                                            {{ Form::label('dwarfing1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('dwarfing', '0', $erectileD && $erectileD->dwarfing == '0', ['id' => 'dwarfing2']) }}
                                            {{ Form::label('dwarfing2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('hiv', 'Do you have HIV or any form of Hepititis?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">

                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('hiv', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('hiv', '1', $erectileD && $erectileD->hiv == '0', ['id' => 'hiv1']) }}
                                            {{ Form::label('hiv1', 'Yes') }}                                                            
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('hiv', '0', $erectileD && $erectileD->hiv == '0', ['id' => 'hiv2']) }}
                                            {{ Form::label('hiv2', 'No') }}
                                        </div>

                                    </div>
                                </div>
                            </div>                                                                
                        </div>                        
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('sex_medicine', 'Have you Ever Used Viagra, Levitra, or Cialis? If yes which one, did it work, Last time used, does it still work, and did you encounter any side effects?', ['class' => 'col-sm-9 control-label']) }}
                                <div class="col-sm-3 toggle-radio-custom">
                                    <div class="col-sm-6 radio-custom radio-primary">
										{{ Form::radio('sex_medicine', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('sex_medicine', '1', $erectileD && $erectileD->sex_medicine == '1', ['id' => 'medicine1']) }}
                                        {{ Form::label('medicine1', 'Yes') }}                                                            
                                    </div>
                                    <div class="col-sm-6 radio-custom radio-primary">
                                        {{ Form::radio('sex_medicine', '0', $erectileD && $erectileD->sex_medicine == '0', ['id' => 'medicine2']) }}
                                        {{ Form::label('medicine2', 'No') }}
                                    </div>
                                </div>
                            </div>                                      
                        </div>

                        <div class='medicineProperty'>
                            <div class="col-sm-12 inputRow">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('medicine_name', 'Which One?', ['class' => 'col-sm-6 control-label']) }}
                                        <div class="col-sm-6 toggle-radio-custom">
                                            <?php $name = [ 'Viegra' => 'Viegra', 'Levitra' => 'Levitra', 'Cialis' => 'Cialis', 'One or more' => 'One or More']; ?>
                                            {{ Form::select('medicine_name', ['' => 'Please Select'] + $name, null, ['class' => 'form-control input']) }}                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('medicine_work', 'Did it Work?', ['class' => 'col-sm-6 control-label']) }}
                                        <div class="col-sm-6 toggle-radio-custom">
                                            <div class="col-sm-3 radio-custom radio-primary">
												{{ Form::radio('medicine_work', '', true, ['class' => 'hidden']) }}
                                                {{ Form::radio('medicine_work', '1', $erectileD && $erectileD->medicine_work == '1', ['id' => 'medicine_work11']) }}
                                                {{ Form::label('medicine_work1', 'Yes') }} 
                                            </div>
                                            <div class="col-sm-3 radio-custom radio-primary">
                                                {{ Form::radio('medicine_work', '0', $erectileD && $erectileD->medicine_work == '0', ['id' => 'medicine_work2']) }}
                                                {{ Form::label('medicine_work2', 'No') }} 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 inputRow">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('last_used', 'last time used?', ['class' => 'col-sm-6 control-label']) }}
                                        <div class="col-sm-6 toggle-radio-custom">
                                            <?php
                                            $lastTime = [ '1 month' => '1 month', '3 months' => '3 motnhs', '6 months' => '6 months', '1 year' => '1 year', '1.5 years' => '1.5 years', '2 years' => '2 years',
                                                '2.5 years' => '2.5 years', '3 years' => '3 years', '3.5 years' => '3.5 years', '4 years' => '4 years', '4.5 years' => '4.5 years', '5 years' => '5 years',
                                                '5.5 years' => '5.5 years', '6 years' => '6 years', '6.5 years' => '6.5 years', '7 years' => '7 years', '7.5 years' => '7.5 years', '8 years' => '8 years', '8.5 years' => '8.5 years', '9 years' => '9 years', '9.5 years' => '9.5 years', '10 years' => '10 years'];
                                            ?>
                                            {{ Form::select('last_used', ['' => 'Please Select'] + $lastTime, null, ['class' => 'form-control input']) }}                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('still_work', 'Does it still Work?', ['class' => 'col-sm-6 control-label']) }}                                        
                                        <div class="col-sm-6 toggle-radio-custom">
                                            <?php $work = [ 'Yes' => 'Yes', 'No' => 'No', 'Occasionally' => 'Occasionally']; ?>
                                            {{ Form::select('still_work', ['' => 'Please Select'] + $work, null, ['class' => 'form-control input']) }}                                    
                                        </div>                                  
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 inputRow">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('side', 'Did you encounter side effects?', ['class' => 'col-sm-6 control-label']) }}
                                        <div class="col-sm-6 toggle-radio-custom">
                                            <div class="col-sm-3 radio-custom radio-primary">
												{{ Form::radio('side_effect', '', true, ['class' => 'hidden']) }}
                                                {{ Form::radio('side_effect', '1', $erectileD && $erectileD->side_effect == '1', ['id' => 'side_effect1']) }}
                                                {{ Form::label('side_effect1', 'Yes') }} 
                                            </div>
                                            <div class="col-sm-3 radio-custom radio-primary">
                                                {{ Form::radio('side_effect', '0', $erectileD && $erectileD->side_effect == '0', ['id' => 'side_effect2']) }}
                                                {{ Form::label('side_effect2', 'No') }} 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('erection', 'When Was the last Time you had a morning Erection?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <?php $erectionTime = [ 'Today' => 'Today', 'This Week' => 'This Week', 'This Month' => 'This Month', 'Long Time Ago' => 'Long Time Ago']; ?>
                                        {{ Form::select('erection_time', ['' => 'Please Select'] + $erectionTime, null, ['class' => 'form-control input']) }}                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('erection_kind', 'When Was the last Time you had a of Any Kind Erection?', ['class' => 'col-sm-6 control-label']) }}                                        
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <?php $kind = [ 'Today' => 'Today', 'This Week' => 'This Week', 'This Month' => 'This Month', 'Last 6 months' => 'Last 6 months', 'This year' => 'This Year', 'Long Time Ago' => 'Long Time Ago']; ?>
                                        {{ Form::select('erection_kind', ['' => 'Please Select'] + $kind, null, ['class' => 'form-control input']) }}                                    
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('erection_strength', 'On a scale of 1 - 10(10 being completely Erect), What was the strength of that last  known erection?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <?php $strength = commonScale(); ?>;
                                        {{ Form::select('erection_strength', ['' => 'Please Select'] + $strength, null, ['class' => 'form-control input']) }}                                    
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
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('activity_score', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('activity_score', '1', $erectileD && $erectileD->activity_score == '1', ['id' => 'erection_sexual1']) }}
                                        {{ Form::label('erection_sexual1', 'Almost Never or Never') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('activity_score', '2', $erectileD && $erectileD->activity_score == '2', ['id' => 'erection_sexual2']) }}
                                        {{ Form::label('erection_sexual2', 'A few Times much less than 1/2 the Time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('activity_score', '3', $erectileD && $erectileD->activity_score == '3', ['id' => 'erection_sexual3']) }}
                                        {{ Form::label('erection_sexual3', 'Sometimes about 1/2 the time') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('activity_score', '4', $erectileD && $erectileD->activity_score == '4', ['id' => 'erection_sexual4']) }}
                                        {{ Form::label('erection_sexual4', 'Most times much More than 1/2 the time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('activity_score', '5', $erectileD && $erectileD->activity_score == '5', ['id' => 'erection_sexual5']) }}
                                        {{ Form::label('erection_sexual5', 'Amost Always or Always') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('stimulation_score', 'When you have erections with sexual stimulation how often were your erections hard enough for Penetration?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('stimulation_score', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('stimulation_score', '1', $erectileD && $erectileD->stimulation_score == '1', ['id' => 'stimulation1']) }}
                                        {{ Form::label('stimulation1', 'Almost Never or Never') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('stimulation_score', '2', $erectileD && $erectileD->stimulation_score == '2', ['id' => 'stimulation2']) }}
                                        {{ Form::label('stimulation2', 'A few Times much less than 1/2 the Time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('stimulation_score', '3', $erectileD && $erectileD->stimulation_score == '3', ['id' => 'stimulation3']) }}
                                        {{ Form::label('stimulation3', 'Sometimes about 1/2 the time') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('stimulation_score', '4', $erectileD && $erectileD->stimulation_score == '4', ['id' => 'stimulation4']) }}
                                        {{ Form::label('stimulation4', 'Most times much More than 1/2 the time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('stimulation_score', '5', $erectileD && $erectileD->stimulation_score == '5', ['id' => 'stimulation5']) }}
                                        {{ Form::label('stimulation5', 'Amost Always or Always') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('intercourse', 'When you attempted Intercourse how often were you able to penetrate your partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('intercourse_score', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('intercourse_score', '1', $erectileD && $erectileD->intercourse_score == '1', ['id' => 'intercourse1']) }}
                                        {{ Form::label('intercourse1', 'Almost Never or Never') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('intercourse_score', '2', $erectileD && $erectileD->intercourse_score == '2', ['id' => 'intercourse2']) }}
                                        {{ Form::label('intercourse2', 'A few Times much less than 1/2 the Time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('intercourse_score', '3', $erectileD && $erectileD->intercourse_score == '3', ['id' => 'intercourse3']) }}
                                        {{ Form::label('intercourse3', 'Sometimes about 1/2 the time') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('intercourse_score', '4', $erectileD && $erectileD->intercourse_score == '4', ['id' => 'intercourse4']) }}
                                        {{ Form::label('intercourse4', 'Most times much More than 1/2 the time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('intercourse_score', '5', $erectileD && $erectileD->intercourse_score == '5', ['id' => 'intercourse5']) }}
                                        {{ Form::label('intercourse5', 'Amost Always or Always') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('maintain', 'During sexual Intercourse, how often were you able to maintain your erection after you had penetrated your partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('maintain_score', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('maintain_score', '1', $erectileD && $erectileD->maintain_score == '1', ['id' => 'maintain1']) }}
                                        {{ Form::label('maintain1', 'Almost Never or Never') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('maintain_score', '2', $erectileD && $erectileD->maintain_score == '2', ['id' => 'maintain2']) }}
                                        {{ Form::label('maintain2', 'A few Times much less than 1/2 the Time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('maintain_score', '3', $erectileD && $erectileD->maintain_score == '3', ['id' => 'maintain3']) }}
                                        {{ Form::label('maintain3', 'Sometimes about 1/2 the time') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('maintain_score', '4', $erectileD && $erectileD->maintain_score == '4', ['id' => 'maintain4']) }}
                                        {{ Form::label('maintain4', 'Most times much More than 1/2 the time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('maintain_score', '5', $erectileD && $erectileD->maintain_score == '5', ['id' => 'maintain5']) }}
                                        {{ Form::label('maintain5', 'Amost Always or Always') }}                                                            
                                    </div>
                                </div>
                            </div>                                                                                        
                        </div>  
                        <div class="col-sm-12 questionRadio">                           
                            <div class="form-group">
                                {{ Form::label('difficult', 'During sexual intercourse how difficult is it to maintain your erection through completion (orgasm) after you have penetrated  Your Partner?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                    <div class="col-sm-2 radio-custom radio-primary">
										{{ Form::radio('difficult_score', '', true, ['class' => 'hidden']) }}
                                        {{ Form::radio('difficult_score', '1', $erectileD && $erectileD->difficult_score == '1', ['id' => 'difficult1']) }}
                                        {{ Form::label('difficult1', 'Almost Never or Never') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('difficult_score', '2', $erectileD && $erectileD->difficult_score == '2', ['id' => 'difficult2']) }}
                                        {{ Form::label('difficult2', 'A few Times much less than 1/2 the Time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('difficult_score', '3', $erectileD && $erectileD->difficult_score == '3', ['id' => 'difficult3']) }}
                                        {{ Form::label('difficult3', 'Sometimes about 1/2 the time') }}                                                            
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('difficult_score', '4', $erectileD && $erectileD->difficult_score == '4', ['id' => 'difficult4']) }}
                                        {{ Form::label('difficult4', 'Most times much More than 1/2 the time') }}
                                    </div>
                                    <div class="col-sm-2 radio-custom radio-primary">
                                        {{ Form::radio('difficult_score', '5', $erectileD && $erectileD->difficult_score == '5', ['id' => 'difficult5']) }}
                                        {{ Form::label('difficult5', 'Amost Always or Always') }}                                                            
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
        $('.medicineProperty').hide();
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