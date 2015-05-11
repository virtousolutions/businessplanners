@extends('app')

@section('title')
Login
@stop

@section('content')
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="col-sm-6 col-xs-12 col-sm-offset-3">
        <div class="well login-form" style="background-color: #5BA4D2;">
            <legend>
                <h4 class="text-center">Change Temporary Password</h4>
            </legend>

            {{ Form::open(array('url' => 'change-temp-password', 'id' => 'change-temp-password-form')) }}
            <div class="form-group">
                <label class="col-sm-4 control-label">New Password</label>
                <div class="col-sm-8" style="margin-bottom: 15px;">                	
                    <input type="password" name="new_password" class="form-control" style='width: 100%;'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Confirm Password:</label>
                <div class="col-sm-8" style="margin-bottom: 15px;">                	
                    <input type="password" name="confirm_password" class="form-control" style='width: 100%;'>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-4" style="margin-bottom: 5px;">
                    <button type="submit" class="btn btn-primary"> Change </button>
                </div>
            </div>
            {{ Form::close() }}

            <legend>&nbsp;</legend>
        </div>
        @if($errors->any())
        <div class="alert alert-dismissable alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul style="list-style-type: none; padding: 0px; margin: 0px;">
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
        </div>
        @endif
    </div>
</div>
@stop
