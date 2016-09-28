<link rel="stylesheet" href="{{ URL::asset('vendor/jquery-timepicker/jquery.timepicker.css') }}" />
<script src="{{ URL::asset('vendor/jquery-timepicker/jquery.timepicker.js') }}"></script>
<div id="modal-followup-status" class="modal-block modal-block-primary mfp-hide">
    {{ Form::open(array('url' => '/appointment/saveAppointmentFolloup', 'method' => "post", 'class'=>'form-horizontal form-bordered', 'id' => 'followUp')) }}
    {!! csrf_field() !!}
    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Followup Appointment</h2>
        </header>  
        <div class="panel-body">
            <div class="form-group">
                
                {{ Form::label('status', 'Followup Status', array('class' => 'col-sm-4 control-label mandatory')) }}
                <div class="col-md-6">
                    {{-- */$i=0;/* --}}
                    @foreach($followupStatus as $followup)
                    <div class="radio">
                        <label>
                            {{ Form::radio('action', $followup->id, false, ['id' => 'optionsRadios'.++$i, 'class' => 'required']) }}
                            {{ $followup->title }}
                         
                        </label>
                    </div>
                    @endforeach
                    
                </div>
                {{ Form::hidden('appointment_id', 0, array('id' => 'followup_appointment_id')) }}
            </div>
            <div id="showOnSchedule">
                <div class="form-group" id="showOnlySchedule">
                    <label class="col-md-4 control-label">Choose Date & Time</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            {{ Form::text('appDate', null, ['class' => 'form-control dateCalendar selectDate required', 'data-plugin-datepicker', 'id' =>'calendarDate']) }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </span>
                            {{ Form::text('appTime', null, ['class' => 'form-control required', 'id' => 'followupDuration']) }}
                        </div>
                    </div>

                </div>  
                <div class="form-group">
                    {{ Form::label('comment', 'Comment', array('class' => 'col-sm-4 control-label mandatory')) }}
                    <div class="col-sm-6">
                        {{ Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter the comment', 'rows' => 3]) }}
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-8 text-right">
                    {{ Form::button('Submit', ['class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type'=>'submit']) }}    
                    <button class="btn btn-default closePop">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
    {{ Form::close() }}  
</div>
<script>
     $('#followupDuration').timepicker({
        'minTime': '09:00am',
        'maxTime': '05:00pm',
        'showDuration': true
    });        
</script>