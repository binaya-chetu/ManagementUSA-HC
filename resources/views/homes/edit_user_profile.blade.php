@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit User Profile</h2>
        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('homes.edit_user_profile', $user->id) !!}
            
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a class="panel-action panel-action-toggle" data-panel-toggle="" href="#"></a>
                        <a class="panel-action panel-action-dismiss" data-panel-dismiss="" href="#"></a>
                    </div>
                    <h2 class="panel-title"><strong>Edit User Profile</strong> </h2>
                </header>
                {!! Form::model($user, ['method' => 'post','url' => ['/home/updateUserProfile', $user->id], 'id' => 'addUser']) !!}
                {{ csrf_field() }}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                           {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                {{ Form::hidden('id') }}
                                {{ Form::text('first_name', null, ['class' => 'form-control required', 'id' => 'first-name', 'placeholder' => 'First Name']) }}
                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                {{ Form::hidden('id') }}
                                {{ Form::text('last_name', null, ['class' => 'form-control required', 'id' => 'last-name', 'placeholder' => 'Last Name']) }}
                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           
                            {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                 <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                {{ Form::email('email', null, ['class' => 'form-control required ignore', 'id' => 'email', 'placeholder' => 'example@mail.com', 'readonly']) }}
                                 </div>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            {{ Form::label('gender', 'Gender', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-md-9">
                                <div class="radio">
                                    <?php if($user['userDetail']->gender === 'Female') { $female = true; $male = false; } else { $male = true; $female = false; }?>
                                    <label>
                                        {{ Form::radio('gender', 'Male', $male, ['id' => 'optionsRadios1']) }}
                                        Male
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        {{ Form::radio('gender', 'Female', $female, ['id' => 'optionsRadios2']) }}
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('dob', 'Date of Birth', ['class' => 'col-sm-3 control-label', 'id' => 'form']) }}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                     <?php 
                                        $dob = ''; 
                                        if($user['userDetail']->dob)
                                        {
                                            $dob = date('m/d/Y', strtotime($user['userDetail']->dob));
                                        }
                                    ?>
                                     {{ Form::text('dob', $dob, ['class' => 'form-control', 'data-plugin-datepicker', 'placeholder' => 'Date of Birth']) }}

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                             {{ Form::label('phone', 'Phone', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                {{ Form::text('phone', $user['userDetail']->phone, ['class' => 'form-control required', 'placeholder' => 'Phone', 'id' => 'phone', 'maxlength' => '14']) }}
                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('address1', 'Address Line 1', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('address1',$user['userDetail']->address1, ['class' => 'form-control', 'placeholder' => 'Primary Address', 'id' => 'address1']) }}
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            {{ Form::label('address2', 'Address Line 2', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('address2', $user['userDetail']->address2, ['class' => 'form-control', 'placeholder' => 'Secondary Address', 'id' => 'address2']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            {{ Form::label('city', 'City', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::text('city', $user['userDetail']->city, ['class' => 'form-control', 'placeholder' => 'City', 'id' => 'city']) }}
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            {{ Form::label('state', 'State', array('class' => 'col-sm-3 control-label')) }}
                            <div class="col-sm-9">
                                {{ Form::select('state', array_merge(['0' => 'Please Select State'], $states), $user['userDetail']->state, ['class' => 'form-control input', 'id' => 'state']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                         <div class="col-sm-6 form-group{{ $errors->has('zipCode') ? ' has-error' : '' }}">
                            {{ Form::label('zipCode', 'Zip Code', array('class' => 'col-sm-3 control-label mandatory')) }}
                            <div class="col-sm-9">
                                {{ Form::text('zipCode', $user['userDetail']->zipCode, ['class' => 'form-control required', 'placeholder' => 'Zip Code', 'id' => 'zipCode', 'maxlength' => '15', 'minlength' => '6', 'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');"]) }}
                            @if ($errors->has('zipCode'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('zipCode') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                                {{ Form::button(
                                    'Save',
                                    array(
                                        'class'=>'mb-xs mt-xs mr-xs btn btn-primary',
                                        'type'=>'submit')) 
                                }}                               

                                <a href='{{'/home/userProfile'}}' class = 'mb-xs mt-xs mr-xs btn btn-default'>Cancel</a>

                            </div>
                    </div>
                </footer>
                 {{ Form::close() }}
           </section>
        </div>
    </div>
</section>
@endsection

