<hr>
    <div class="row">
        <div class="col-sm-6 form-group{{ $errors->has('injection') ? ' has-error' : '' }}">
            {{ Form::label('injection', 'Injetion', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">
          
                {{ Form::text('injection','', ['class' => 'form-control required','id' => 'durationExample']) }}
                @if ($errors->has('injection'))
                <span class="help-block">
                    <strong>{{ $errors->first('injection') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="col-sm-6 form-group{{ $errors->has('injection2') ? ' has-error' : '' }}">
            {{ Form::label('injection2', 'Injection 2 ', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">
              {{ Form::text('injection','', ['class' => 'form-control required','id' => 'durationExample']) }}
                @if ($errors->has('injection2'))
                <span class="help-block">
                    <strong>{{ $errors->first('injection2') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 form-group{{ $errors->has('check1') ? ' has-error' : '' }}">
            {{ Form::label('check1', 'Check 1', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">
                
                 <?php $ddvalue = dropDown4();?>
                
                {{ Form::select('check1', (['' => 'Select value'] + $ddvalue), null, ['class' => 'form-control input required amount', 'id' => 'check1']) }}

                @if ($errors->has('amount1'))
                <span class="help-block">
                    <strong>{{ $errors->first('check1') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="col-sm-6 form-group{{ $errors->has('check2') ? ' has-error' : '' }}">
            {{ Form::label('check2', 'Check 2 ', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">  
               <?php $ddvalue = dropDown4();?>
                {{ Form::select('check2', (['' => 'Select value'] + $ddvalue), null, ['class' => 'form-control input required amount', 'id' => 'check2']) }} 
                @if ($errors->has('medicationa2'))
                <span class="help-block">
                    <strong>{{ $errors->first('check2') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 form-group{{ $errors->has('check3') ? ' has-error' : '' }}">
            {{ Form::label('check3', 'Check 3', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">
                <?php $ddvalue = dropDown4();?>
                {{ Form::select('check3', (['' => 'Select value'] + $ddvalue), null, ['class' => 'form-control input required amount', 'id' => 'check3']) }}
                @if ($errors->has('amount1'))
                <span class="help-block">
                    <strong>{{ $errors->first('check3') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="col-sm-6 form-group{{ $errors->has('antidote') ? ' has-error' : '' }}">
            {{ Form::label('antidote', 'Antidote ', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">
                <?php $ddvalue = dropDown5(); ?>

                {{ Form::select('antidote', (['' => 'Select value'] + $ddvalue), null, ['class' => 'form-control input required amount', 'id' => 'antidote']) }} 

                @if ($errors->has('antidote'))
                <span class="help-block">
                    <strong>{{ $errors->first('antidote') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 form-group{{ $errors->has('antidote2') ? ' has-error' : '' }}">
            {{ Form::label('antidote2', 'Antidote 2', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">
                 <?php $ddvalue = dropDown5(); ?>

                {{ Form::select('antidote2', (['' => 'Select value'] + $ddvalue), null, ['class' => 'form-control input required amount', 'id' => 'antidote2']) }}

                @if ($errors->has('amount1'))
                <span class="help-block">
                    <strong>{{ $errors->first('antidote2') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="col-sm-6 form-group{{ $errors->has('antidote3') ? ' has-error' : '' }}">
            {{ Form::label('antidote3', 'Antidote 3 ', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">
                 <?php $ddvalue = dropDown5(); ?>
                {{ Form::select('antidote3', (['' => 'Select value'] + $ddvalue), null, ['class' => 'form-control input required amount', 'id' => 'antidote3']) }} 

                @if ($errors->has('medicationb2'))
                <span class="help-block">
                    <strong>{{ $errors->first('antidote3') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>

   <div class="row">
        <div class="col-sm-6 form-group{{ $errors->has('check4') ? ' has-error' : '' }}">
            {{ Form::label('check4', 'Check 4', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">
               <?php $ddvalue = dropDown4();?>
                {{ Form::select('check4', (['' => 'Select value'] + $ddvalue), null, ['class' => 'form-control input required amount', 'id' => 'antidote2']) }}

                @if ($errors->has('check4'))
                <span class="help-block">
                    <strong>{{ $errors->first('check4') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="col-sm-6 form-group{{ $errors->has('check5') ? ' has-error' : '' }}">
            {{ Form::label('check5', 'Check 5', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">
               <?php $ddvalue = dropDown4();?>
                {{ Form::select('check5', (['' => 'Select value'] + $ddvalue), null, ['class' => 'form-control input required amount', 'id' => 'check5']) }} 
                @if ($errors->has('check5'))
                <span class="help-block">
                    <strong>{{ $errors->first('check5') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    
     <div class="row">
        <div class="col-sm-6 form-group{{ $errors->has('pain') ? ' has-error' : '' }}">
            {{ Form::label('pain', 'Pain', array('class' => 'col-sm-3 control-label mandatory')) }}
            <div class="col-sm-9">
                <?php $ddvalue = dropDown7();?>
                {{ Form::select('pain', (['' => 'Select value'] + $ddvalue), null, ['class' => 'form-control input required amount', 'id' => 'pain']) }}

                @if ($errors->has('pain'))
                <span class="help-block">
                    <strong>{{ $errors->first('pain') }}</strong>
                </span>
                @endif
            </div>
        </div>

       
    </div>
    
</section> 