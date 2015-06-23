@extends('app')

@section('title')
Reset Password
@stop

@section('content')
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="col-sm-6 col-xs-12 col-sm-offset-3">
        <div style="padding: 30px 20px 50px;">
            <legend>
                <h4>Enter your email address</h4>
            </legend>
            @if (Session::has('error') || Session::has('success'))
                <div class="col-cxs-12" style="margin: 15px 0;">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">Invalid email address</div>
                    @elseif (Session::has('success'))
                        <div class="alert alert-success">An email with the password reset link has been sent. The password reset link expires in 5 hours.</div>
                    @endif
                </div>
            @endif
            
            {{ Form::open(array('route' => 'password.request', 'id' => 'reset-form')) }}
             
                <div class="form-group">
                    <label class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-9" style="margin-bottom: 15px;">                	
                        {{ Form::text('email', null, array('placeholder' => 'email', 'class' => 'form-control', 'style' => 'width: 100%;')) }}
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