<div class="panel-body">


    <div class="form-group{{ $errors->has('appDate') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Choose Date & Time</label>

        <div class="col-md-4">

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <input type="text" name="appDate" data-plugin-datepicker class="form-control" value="{{ old('appDate') }}">

            </div>
            @if ($errors->has('appDate'))
            <span class="help-block">
                <strong>{{ $errors->first('appDate') }}</strong>
            </span>
            @endif
        </div>

        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </span>
                <input type="text" name="appTime" data-plugin-timepicker class="form-control">
            </div>
        </div>
        <input type="hidden"  name="marketer" value="1">
        <input type="hidden"  name="status" value="Not Required">
        <input type="hidden"  name="createdBy" value="{{ Auth::user()->id }}">
        <input type="hidden"  name="lastUpdatedBy" value="{{ Auth::user()->id }}">
    </div>   


    <div class="form-group{{ $errors->has('doctor_id') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Doctor</label>

        <div class="col-md-6">
            <select  class="form-control chosen" name="doctor_id">
                <option value="" disabled>Choose Doctor</option>
                @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->firstName }} {{ $doctor->lastName }}</option>
                @endforeach


            </select>    
            @if ($errors->has('patient_id'))
            <span class="help-block">
                <strong>{{ $errors->first('doctor_id') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Patient</label>

        <div class="col-md-4 patient_id">
            <select  class="form-control chosen" name="patient_id" id="patient_id">
                <option value="" disabled>Choose Patient</option>
                @foreach ($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->firstName }} {{ $patient->lastName }}</option>
                @endforeach

                <input type="hidden"  name="clinic" value="{{ Auth::user()->id }}">
                <!--input type="hidden"  name="clinic" value="{{ Auth::user()->id }}"-->

            </select>    
            @if ($errors->has('patient_id'))
            <span class="help-block">
                <strong>{{ $errors->first('patient_id') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-sm-2">
            <div class="mb-md">
                <button id="addAppPatient" data-token="{{ csrf_token() }}" class="btn btn-primary" style="background: #428bca">Add Patient <i class="fa fa-plus"></i></button>
            </div>
        </div>

    </div>


    <div id="patient_come"  style="display:none;">
        
        <div class="form-group"> 
            <label for="firstName" class="col-sm-4 control-label">First Name
            </label> 

            <div class="col-sm-6"> 
                <input type="hidden" name="id"> 
                <input type="text" name="firstName" id="first-name" class="form-control" placeholder="First Name" value="{{ old('firstName') }}"> 

                <span class="help-block firstName">
                </span> 
            </div> 
        </div> 

        <div class="form-group"> 
            <label for="lastName" class="col-sm-4 control-label">Last Name
            </label> 

            <div class="col-sm-6"> 
                <input type="text" name="lastName" id="last-name" class="form-control" placeholder="Last Name" value="{{ old('lastName') }}"> 

                <span class="help-block lastName">
                </span>
            </div> 
        </div> 

        <div class="form-group"> 
            <label for="email" class="col-sm-4 control-label">Email
            </label> 

            <div class="col-sm-6"> 
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}"> 

                <span class="help-block email">
                </span> 
            </div> 
        </div> 

        <div class="form-group"> 
            <label for="phone" class="col-sm-4 control-label">Phone
            </label> 

            <div class="col-sm-6"> 
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}"> 
            </div> 
        </div> 

        <div class="form-group"> 
            <label for="phone" class="col-sm-4 control-label">Date
            </label> 

            <div class="col-md-6"> 

                <div class="input-group"> 

                    <span class="input-group-addon"> <i class="fa fa-calendar"></i> 
                    </span> 
                    <input type="text" name="dob" data-plugin-datepicker class="form-control" value="{{ old('dob') }}"> 
                </div> @if ($errors->has('dob')) 

                <span class="help-block"> <strong>{{ $errors->first('dob') }}</strong> 
                </span> @endif 
            </div> 
        </div> 

        <div class="form-group"> 
            <label class="col-sm-4 control-label">Gender
            </label> 

            <div class="col-sm-6"> 

                <div class="col-sm-3"> 

                    <div class="radio-custom radio-primary"> 
                        <input id="awesome" name="gender" type="radio" value="Male" checked="true" required /> 
                        <label for="awesome">Male
                        </label> 
                    </div> 
                </div> 

                <div class="col-sm-3"> 

                    <div class="radio-custom radio-primary"> 
                        <input id="very-awesome" name="gender" type="radio" value="Female" /> 
                        <label for="very-awesome">Female
                        </label> 
                    </div> 
                </div> 
            </div> 
        </div> 

        <div class="form-group"> 
            <label for="address1" class="col-sm-4 control-label">Primary Address
            </label> 

            <div class="col-sm-6"> 
                <textarea name="address1" id="address1" class="form-control" rows="3" placeholder="Primary Address">{{ old('address1') }}
                </textarea> 
            </div> 
        </div>

    </div><br/>



    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Comment</label>

        <div class="col-md-6 commentdiv">
            <textarea  class="form-control" name="comment" id="commentid">{{ old('comment') }}</textarea>

            @if ($errors->has('comment'))
            <span class="help-block">
                <strong>{{ $errors->first('comment') }}</strong>
            </span>
            @endif
        </div>
    </div>


</div>












