@extends('app')

@section('title')
Reset Password
@stop

@section('content')
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="col-sm-6 col-xs-12 col-sm-offset-3">
        <div class="well login-form" style="background-color: #5BA4D2; padding: 30px 20px 50px;">
            <legend>
                <h4>Reset you password</h4>
            </legend>
            @if (Session::has('error') || Session::has('success'))
                <div class="col-cxs-12" style="margin: 15px 0;">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">Invalid email address or token</div>
                    @elseif (Session::has('success'))
                        <div class="alert alert-success">An email with the password reset has been sent.</div>
                    @endif
                </div>
            @endif
            
            {{ Form::open(array('route' => array('password.update', $token), 'id' => 'update-form')) }}
             
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
                    <label class="col-sm-3 control-label">Password Confirmation:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">                	
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="password confirmation" style='width: 100%;'>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3" style="margin-bottom: 5px;">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </div>
                </div>
             
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop