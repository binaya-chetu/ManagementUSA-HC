<div id="medical_history" class="tab-pane">
    <div class="form-group">
        {{ Form::label('medical_title', 'Why are you coming to see us, or why are you today?', array('class' => 'col-sm-5 control-label medicalTitle')) }}
        <div class="col-sm-12">
            @foreach($diseases as $i => $v)
            @if(in_array($i, $disease_id))
            <div class="col-sm-12">
               {{ Form::label('reason-'.$i, $v) }}
            </div>
            @endif
            @endforeach
        </div>
    </div> 

    <?php
    $splChars = ['\\', '/', ':', '*', '?', '"', '<', '>', '|', ' '];
    $replace = ['', '', '', '', '', '', '', '', '', '_'];
    ?>
    
    <style>
/*        #disease-form-box-11 .tab-content{display:inline-block;}
         #disease-form-box-13 .tab-content{display:inline-block;}*/
     </style>   
    <!-- Tab panes -->
    <div class="tab-content" style="padding:0">
        @foreach($diseases as $i => $v)
         @if(in_array($i, $disease_id))
            <div class="row {{ str_replace($splChars, $replace, strtolower($v)) }}" id="disease-form-box-{{ $i }}">
                @include('patient.medical.'.str_replace($splChars, $replace, strtolower($v)))
            </div>
           @endif
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="toggle" data-plugin-toggle>
                <section class="toggle">
                    {{ Form::label('medical_title', 'Family Medical History') }}
                    <div class="toggle-content">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('cardiovascular', 'Cardiovascular Disease', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->cardiovascular) && $patient->medicalHistories->cardiovascular  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->cardiovascular == 0)
                                            {{'No'}}
                                            @else
                                            {{ 'N/A' }}
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('hypertension', 'Hypertension', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($patient->medicalHistories->hypertension) && $patient->medicalHistories->enocrine_disorder  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->enocrine_disorder == 0)
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
                                    {{ Form::label('enocrine', 'Diabetes, Thyroid, or other Enocrine Disorder', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($patient->medicalHistories->enocrine_disorder) && $patient->medicalHistories->enocrine_disorder  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->enocrine_disorder == 0)
                                            {{'No'}}
                                             @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('prostate', 'Prostate Cancer', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                          @if(isset($patient->medicalHistories->prostate) && $patient->medicalHistories->prostate  == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->prostate == 0)
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
                                    {{ Form::label('lipid', 'Lipid or Blood Disorder', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($patient->medicalHistories->lipid)&& $patient->medicalHistories->lipid  == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->lipid == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('cancer_forms', 'Other Forms of Cancer', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($patient->medicalHistories->cancer_form)&& $patient->medicalHistories->cancer_form  == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->cancer_form == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <section class="toggle">
                    <label>Lifestyle Information</label>
                    <div class="toggle-content">
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('smoke', 'Do You Smoke.  If Yes How Often How Much?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->smoke_status)&& $patient->medicalHistories->smoke_status  == 1)
                                            {{ 'Yes' }}
                                         
                                            <div class="col-sm-12 inputRow selectSmoke">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        {{ Form::label('smoke_often', 'How often?', ['class' => 'col-sm-12 control-label']) }}
                                                        <div class="col-sm-12">
                                                            @if(isset($patient->medicalHistories->smoke_often))
                                                            <?php
                                                            switch ($patient->medicalHistories->smoke_often) {
                                                                case 'Daily': echo "Daily";
                                                                    break;
                                                                case 'Occasionally': echo "Occasionally";
                                                                    break;
                                                                default: echo "N/A";
                                                            }
                                                            ?>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        {{ Form::label('smoke_quantity', 'How much?', ['class' => 'col-sm-12 control-label']) }}
                                                        <div class="col-sm-12">
                                                            @if(isset($patient->medicalHistories->smoke_quantity))
                                                            <?php
                                                            switch ($patient->medicalHistories->smoke_quantity) {
                                                                case 'less than 1 pack': echo "less than 1 pack";
                                                                    break;
                                                                case '1 pack': echo "1 pack";
                                                                    break;
                                                                case '2 packs': echo "2 packs";
                                                                    break;
                                                                case 'over 2 packs': echo "over 2 packs";
                                                                    break;
                                                                default: echo "N/A";
                                                            }
                                                            ?>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        @elseif($patient->medicalHistories->smoke_status == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    
                                    </div>
                            </div>
                        </div>

                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('drink_status', 'Do You Drink.  If Yes How Often How Much?', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12 toggle-radio-custom">
                                     @if(isset($patient->medicalHistories->drink_status)&& $patient->medicalHistories->drink_status  == 1)
                                            {{ 'Yes' }}
                                            <div class="col-sm-12 inputRow selectDrink">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        {{ Form::label('drink_often', 'How often?', ['class' => 'col-sm-12 control-label']) }}
                                                        <div class="col-sm-12">
                                                            @if(isset($patient->medicalHistories->drink_often))
                                                            <?php
                                                            switch ($patient->medicalHistories->drink_often) {
                                                                case 'Daily': echo "Daily";
                                                                    break;
                                                                case 'Occasionally': echo "Occasionally";
                                                                    break;
                                                                default: echo "N/A";
                                                            }
                                                            ?>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        {{ Form::label('drink_quantity', 'How much?', ['class' => 'col-sm-12 control-label']) }}
                                                        <div class="col-sm-12">
                                                            @if(isset($patient->medicalHistories->drink_quantity))
                                                            <?php
                                                            switch ($patient->medicalHistories->drink_quantity) {
                                                                case 'less than 1 drink': echo "less than 1 drink";
                                                                    break;
                                                                case '1 drink': echo "1 drink";
                                                                    break;
                                                                case '2 drinks': echo "2 drinks";
                                                                    break;
                                                                case 'over 2 drinks': echo "over 2 drinks";
                                                                    break;
                                                                default: echo "N/A";
                                                            }
                                                            ?>
                                                            @endif  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                        @elseif($patient->medicalHistories->drink_status == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                   
                                </div>
                            </div>                                      
                        </div>
                        <div class="col-sm-12 inputRow selectDrink">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('drink_often', 'How often?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                            @if(isset($patient->medicalHistories->drink_often))
                                             <?php switch($patient->medicalHistories->drink_often) {
                                                 case 'Daily': echo "Daily";
                                                     break;
                                                 case 'Occasionally': echo "Occasionally";
                                                     break;
                                                 default: echo "N/A";

                                             } ?>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('drink_quantity', 'How much?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                         @if(isset($patient->medicalHistories->drink_quantity))
                                            <?php switch($patient->medicalHistories->drink_quantity) {
                                                case 'less than 1 drink': echo "less than 1 drink";
                                                    break;
                                                case '1 drink': echo "1 drink";
                                                    break;
                                                case '2 drinks': echo "2 drinks";
                                                    break;
                                                case 'over 2 drinks': echo "over 2 drinks";
                                                    break;
                                                default: echo "N/A";    
                                            } ?>
                                      @endif  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="form-group">
                                {{ Form::label('activity_level', 'Please Rate Your Daily Activity Level', ['class' => 'col-sm-12 control-label']) }}
                                <div class="col-sm-12">
                                    @if(isset($patient->medicalHistories->activity_level))
                                    <?php switch($patient->adamsQuestionaires->sport_rate) {
                                        case 'Heavy': echo "Heavy";
                                            break;
                                        case 'Medium': echo "Medium";
                                            break;
                                        case 'Low': echo "Low";
                                            break;
                                        default: echo "N/A"; 
                                    } ?>
                                @else
                                    {{ 'N/A' }}
                                @endif
                                </div>
                            </div>                                      
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('exercise_status', 'Do you Exercise? If So How Often?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->exercise_status)&& $patient->medicalHistories->exercise_status  == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->exercise_status == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                         @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 selectExercise">
                                <div class="form-group">
                                    {{ Form::label('exercise_often', 'How Often?', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12">
                                       @if(isset($patient->medicalHistories->exercise_often))
                                          <?php switch($patient->medicalHistories->exercise_often) {
                                              case 'Daily': echo "Daily";
                                                  break;
                                              case 'Occasionally': echo "Occasionally";
                                                  break;
                                              default: echo "N/A";

                                          } ?>
                                       @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="toggle">
                    {{ Form::label('diagnose', 'Diagnosed History Of Disease') }}
                    <div class="toggle-content">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('deficiency', 'Any Known Deficiency Including Minerals and Electrolytes', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                     
                                        @if(isset($patient->medicalHistories->deficiency_status)  && $patient->medicalHistories->chemical_dependency  == 1)
                                                {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->chemical_dependency == 0)
                                                {{'No'}}
                                            @else
                                                {{ 'N/A' }}
                                            @endif

                                    
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('chemical', 'Chemical Dependency', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($patient->medicalHistories->chemical_dependency) && $patient->medicalHistories->chemical_dependency  == 1)
                                                {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->chemical_dependency == 0)
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
                                    {{ Form::label('blood', 'Blood Disorders', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($patient->medicalHistories->blood_disorder)  && $patient->medicalHistories->blood_disorder  == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->blood_disorder == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('orthopedic', 'Orthopedic or muscle disorder including fracture or Joint disorders.', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->orthopedic_disorder) && $patient->medicalHistories->orthopedic_disorder   == 1)
                                                {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->orthopedic_disorder == 0)
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
                                    {{ Form::label('deficiency', 'Any Known Deficiency Including Minerals and Electrolytes', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                          @if(isset($patient->medicalHistories->known_deficiency) && $patient->medicalHistories->known_deficiency   == 1)
                                                {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->known_deficiency == 0)
                                                {{'No'}}
                                            @else
                                                {{ 'N/A' }}
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('carpal', 'Carpal Tunnel Syndrome', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($patient->medicalHistories->carpal_syndrome) && $patient->medicalHistories->immune_disorder == 1)
                                                {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->immune_disorder == 0)
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
                                    {{ Form::label('Immune', 'Immune Disorders ', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($patient->medicalHistories->immune_disorder)  && $patient->medicalHistories->immune_disorder == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->immune_disorder == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('heart', 'Heart disease including Atheroscelerosis, Angina, Heart Failure, or Heart Attack', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->heart_disease) && $patient->medicalHistories->heart_disease == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->heart_disease == 0)
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
                                    {{ Form::label('lung', 'Lung Disorders', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($patient->medicalHistories->lung_disorder) && $patient->medicalHistories->lung_disorder == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->lung_disorder == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('cancers', 'Cancers', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($patient->medicalHistories->cancer_status) && $patient->medicalHistories->cancer_status == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->cancer_status == 0)
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
                                    {{ Form::label('surgeries', 'Major Surgeries', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($patient->medicalHistories->surgeries) && $patient->medicalHistories->surgeries == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->surgeries == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif  
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('renal', 'Renal Disease (Kidneys)', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($patient->medicalHistories->renal)&& $patient->medicalHistories->renal == 1)
                                            {{ 'Yes' }}
                                        @elseif($patient->medicalHistories->renal == 0)
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
                                    {{ Form::label('upper', 'Upper Respitory Problems', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                     @if(isset($patient->medicalHistories->upper ) && $patient->medicalHistories->upper == 1)
                                           {{ 'Yes' }}
                                       @elseif($patient->medicalHistories->upper == 0)
                                           {{'No'}}
                                       @else
                                           {{ 'N/A' }}
                                       @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('allergies', 'Allergies to Medications', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-1 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->allergies)&& $patient->medicalHistories->allergies  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->allergies == 0)
                                            {{'No'}}
                                       @else
                                            {{'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('genital', 'Genital - Urinary Disorder', ['class' => 'col-sm-12 control-label']) }}
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($patient->medicalHistories->genital)&& $patient->medicalHistories->genital  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->genital == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('retention', 'Edema / Excess fluid retention', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($patient->medicalHistories->retention)&& $patient->medicalHistories->retention  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->retention == 0)
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
                                    {{ Form::label('endocrine', 'Thyroid, Diabetes or other endocrine disorder including insulin resistance', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->endocrine)&& $patient->medicalHistories->endocrine  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->endocrine == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('hyperlipidemia', 'Hyperlipidemia (Cholesterol)', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->hyperlipidema)&& $patient->medicalHistories->hyperlipidema  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->hyperlipidema == 0)
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
                                    {{ Form::label('healing', 'Poor Wound Healing', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->healing)&& $patient->medicalHistories->healing  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->healing == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('neuro', 'Neurological Disorders', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($patient->medicalHistories->neurological) && $patient->medicalHistories->neurological  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->neurological == 0)
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
                                    {{ Form::label('emotional', 'Emotional disorders / Depression', ['class' => 'col-sm-12 control-label']) }}                                                                                                                
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->emotional)&& $patient->medicalHistories->emotional  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->emotional == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('Hypertention', 'Hypertention(High Blood Pressure)', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                      @if(isset($patient->medicalHistories->hypertention_hbp) && $patient->medicalHistories->hypertention_hbp  == 1)
                                           {{ 'Yes' }}
                                           @elseif($patient->medicalHistories->hypertention_hbp == 0)
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
                                    {{ Form::label('illness', 'Other Illnesses', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($patient->medicalHistories->other_illness) && $patient->medicalHistories->other_illness  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->other_illness == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('arthritis', 'Arthritis', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                        @if(isset($patient->medicalHistories->arthritis)&& $patient->medicalHistories->arthritis  == 1)
                                    {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->arthritis == 0)
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
                                    {{ Form::label('drugs', 'Do you use any form of Recreational Drugs?', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                         @if(isset($patient->medicalHistories->recreational_drug) && $patient->medicalHistories->recreational_drug  == 1)
                                        {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->recreational_drug == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!--div class="form-group">
                                    {{ Form::label('neurological', 'Neurological Disorders', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                                                                                            {{ Form::radio('neurological', '',true, ['class' => 'hidden']) }}
                                            {{ Form::radio('neurological', '1', $medicalHistories && $medicalHistories->neurological == '1', ['id' => 'neurological1']) }}
                                            {{ Form::label('neurological1', 'Yes') }}
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('neurological', '0', $medicalHistories && $medicalHistories->neurological == '0', ['id' => 'neurological2']) }}
                                            {{ Form::label('neurological2', 'No') }}
                                        </div>
                                    </div>
                                </div-->
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">                                               
                            <div class="form-group">
                                {{ Form::label('blood_test', 'When was the last time you had a comprehensive Blood Test or Blood Test of anykind?', ['class' => 'col-sm-12 control-label']) }}                                                        
                                <div class="col-sm-12">
                                     @if(isset($patient->medicalHistories->blood_test))
                                        <?php switch($patient->medicalHistories->blood_test) {
                                                case '1 Month': echo "1 Month";
                                                    break;
                                                case '3 Months': echo "3 Months";
                                                    break;
                                                case '6 Months': echo "6 Months";
                                                    break;
                                                case '>1': echo "1 Year or Longer";
                                                    break;
                                                case 'Never': echo "Never";
                                                    break;
                                                default: echo "N/A";

                                            } ?>
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                </div>
                            </div>                                      
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-12">
                                <div class="form-group">					
                                    {{ Form::label('health_isurance', 'Do you have any form of Health Insurance?', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                       @if(isset($patient->medicalHistories->health_insurance)&& $patient->medicalHistories->health_insurance  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->health_insurance == 0)
                                            {{'No'}}
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('kind', 'Kind of Health Insurance', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12">
                                       @if(isset($patient->medicalHistories->kind_of_hi))
                                            <?php switch($patient->medicalHistories->blood_test) {
                                                 case 'Medicare': echo "Medicare";
                                                     break;
                                                 case 'HMO': echo "HMO";
                                                     break;
                                                 case 'PPO': echo "PPO";
                                                     break;
                                                 case 'Medicaid': echo "Medicaid";
                                                     break;
                                                 default: echo "N/A";

                                             } ?>
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
                                    {{ Form::label('medication', 'Are you Currently Taking Any Medications?', ['class' => 'col-sm-12 control-label']) }}                                                        
                                    <div class="col-sm-12 toggle-radio-custom">
                                          @if(isset($patient->medicalHistories->medication) && $patient->medicalHistories->medication  == 1)
                                            {{ 'Yes' }}
                                            @elseif($patient->medicalHistories->medication == 0)
                                            {{'No'}}
                                             @else
                                            {{ 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>