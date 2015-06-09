@extends('app')

@section('title')
Login
@stop

@section('content')
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="col-sm-6 col-xs-12 col-sm-offset-3">
        <div class="well login-form" style="background-color: #5BA4D2;">
            <legend>
                <h4 class="text-center">Login</h4>
            </legend>
            @if($errors->any())
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul style="list-style-type: none; padding: 0px; margin: 0px;">
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
            </div>
            @endif
            {{ Form::open(array('url' => 'login', 'id' => 'login-form')) }}
            <div class="form-group">
                <label class="col-sm-3 control-label">Email:</label>
                <div class="col-sm-9" style="margin-bottom: 15px;">                	
                    {{ Form::text('email', null, array('placeholder' => 'email', 'class' => 'form-control', 'style' => 'width: 100%;')) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Password:</label>
                <div class="col-sm-9" style="margin-bottom: 15px;">                	
                    <input type="password" name="password" class="form-control" id="password" placeholder="password" style='width: 100%;'>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3" style="margin-bottom: 5px;">
                    <button type="submit" class="btn btn-primary"> Log In </button>
                    <a href="{{ url('password/reset') }}" style="float: right;"> Forgot Password </a>
                </div>
            </div>
            {{ Form::close() }}

            <legend>&nbsp;</legend>
        </div>
        
    </div>
</div>
@stop
