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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('facial_surgeries', 'Have you Ever Had Any Type of Facial Surgeries or Facial Enhancements? If So What Kind?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('facial_surgeries', '1', false, ['id' => 'facial_surgeries1'])); ?>

                                            <?php echo e(Form::label('facial_surgeries1', 'Yes')); ?>

                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('facial_surgeries', '0', false, ['id' => 'facial_surgeries2'])); ?>

                                            <?php echo e(Form::label('facial_surgeries2', 'No')); ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-6 facialActive">
                                <div class="form-group">
                                    <?php echo e(Form::label('facial_kind', 'What kind?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6">
                                        <?php $kind = [ 'Botox/Fillers' => 'Botox/Fillers', 'Plastic Sugery' => 'Plastic Sugery', 'Spa Facials' => 'Spa Facials']; ?>
                                        <?php echo e(Form::select('facial_kind', ['' => 'Please Select'] + $kind, null, ['class' => 'form-control input'])); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('face_wash', 'What Do you wash your face with?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6">
                                        <?php $type = [ 'Whatevers On Sale' => 'Whatevers On Sale', 'Basic Soap' => 'Basic Soap', 'Specialty Soap' => 'Specialty Soap', 'Skincare Product' => 'Skincare Product']; ?>
                                        <?php echo e(Form::select('face_wash', ['' => 'Please Select'] + $type, null, ['class' => 'form-control input'])); ?>

                                    </div>
                                </div>                              
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('exposure', 'How Much Exposure do you have to the sun?  (Consider Work, Recreation, and Daily life)', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6">
                                        <?php $exposure = [ 'A lot' => 'A lot', 'Fair Amount' => 'Fair Amount', 'Average' => 'Average', 'Very Little' => 'Very Little']; ?>
                                        <?php echo e(Form::select('exposure', ['' => 'Please Select'] + $exposure, null, ['class' => 'form-control input'])); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('skin_look', 'Choose the way you feel about how you feel your skin looks.', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6">
                                        <?php $type = [ 'Leathery' => 'Leathery', 'Sun Damaged' => 'Sun Damaged', 'Old and loose' => 'Old and loose', 'Looks Great' => 'Looks Great']; ?>
                                        <?php echo e(Form::select('skin_look', ['' => 'Please Select'] + $type, null, ['class' => 'form-control input'])); ?>

                                    </div>
                                </div>                              
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('look_score', 'On a Scale of 1-10  (10 Being Very Important) How Important is it for you to look good for work, dating, spouse, or Just for your personel confidence?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6">
                                        <?php $scale = commonScale(); ?>
                                        <?php echo e(Form::select('look_score', ['' => 'Please Select'] + $scale, null, ['class' => 'form-control input'])); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('happy_score', 'On a Scale of 1-10  (10 Being Very Happy) How Happy Are you with the way you look?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6">
                                        <?php echo e(Form::select('happy_score', ['' => 'Please Select'] + $scale, null, ['class' => 'form-control input'])); ?>

                                    </div>
                                </div>                              
                            </div>                            
                        </div>
                        
                    </div>
                    <div id="cosmetics_treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('crowsfeet', 'Do you have Crowsfeet(Wrinkles around the eyes)', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('crowsfeet', '1', false, ['id' => 'crowsfeet1'])); ?>

                                            <?php echo e(Form::label('crowsfeet1', 'Yes')); ?> 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('crowsfeet', '0', false, ['id' => 'crowsfeet2'])); ?>

                                            <?php echo e(Form::label('crowsfeet2', 'No')); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('facial_expression', 'When you Change your facial Expression do you see your forehead wrinkle up?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('facial_expression', '1', false, ['id' => 'facial_expression1'])); ?>

                                            <?php echo e(Form::label('facial_expression1', 'Yes')); ?> 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('facial_expression', '0', false, ['id' => 'facial_expression2'])); ?>

                                            <?php echo e(Form::label('facial_expression2', 'No')); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('sunken', 'Has your face become more sunken in over the years?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('sunken', '1', false, ['id' => 'sunken1'])); ?>

                                            <?php echo e(Form::label('sunken1', 'Yes')); ?> 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('sunken', '0', false, ['id' => 'sunken2'])); ?>

                                            <?php echo e(Form::label('sunken2', 'No')); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('bullfrog_looking', 'Do you have excessive fat below your chin on your kneck? (Bullfrog Looking)', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('bullfrog_looking', '1', false, ['id' => 'bullfrog_looking1'])); ?>

                                            <?php echo e(Form::label('bullfrog_looking1', 'Yes')); ?> 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('bullfrog_looking', '0', false, ['id' => 'bullfrog_looking2'])); ?>

                                            <?php echo e(Form::label('bullfrog_looking2', 'No')); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('loose_skin', 'Does your face have a lot of Loose skin which has developed over time?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('loose_skin', '1', false, ['id' => 'loose_skin1'])); ?>

                                            <?php echo e(Form::label('loose_skin1', 'Yes')); ?> 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('loose_skin', '0', false, ['id' => 'loose_skin2'])); ?>

                                            <?php echo e(Form::label('loose_skin2', 'No')); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('thin_lip', 'Do you feel your lips are too thin?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('thin_lip', '1', false, ['id' => 'thin_lip1'])); ?>

                                            <?php echo e(Form::label('thin_lip1', 'Yes')); ?> 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('thin_lip', '0', false, ['id' => 'thin_lip2'])); ?>

                                            <?php echo e(Form::label('thin_lip2', 'No')); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('face_spot', 'Have you noticed dark, grey, red or other permanent spots on your face?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('face_spot', '1', false, ['id' => 'face_spot1'])); ?>

                                            <?php echo e(Form::label('face_spot1', 'Yes')); ?> 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('face_spot', '0', false, ['id' => 'face_spot2'])); ?>

                                            <?php echo e(Form::label('face_spot2', 'No')); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('acne', 'Do you suffer from Acne or have Acne Scars?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('acne', '1', false, ['id' => 'acne1'])); ?>

                                            <?php echo e(Form::label('acne1', 'Yes')); ?> 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('acne', '0', false, ['id' => 'acne2'])); ?>

                                            <?php echo e(Form::label('acne2', 'No')); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('skin_tag', 'Have you noticed Skin Tags or broken blood vessels on the nose or on your face?', ['class' => 'col-sm-6 control-label'])); ?>

                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('skin_tag', '1', false, ['id' => 'skin_tag1'])); ?>

                                            <?php echo e(Form::label('skin_tag1', 'Yes')); ?> 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            <?php echo e(Form::radio('skin_tag', '0', false, ['id' => 'skin_tag2'])); ?>

                                            <?php echo e(Form::label('skin_tag2', 'No')); ?> 
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
        $('.facialActive').hide();
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