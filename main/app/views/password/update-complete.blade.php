@extends('app')

@section('title')
Reset Password
@stop

@section('content')
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="col-sm-6 col-xs-12 col-sm-offset-3">
        <div style="padding: 30px 20px 50px;">
            You have successfully changed your password. Click <a id="login_url" href="{{ url('login') }}">here</a> to login. Redirecting in <span id="seconds">5</span>.
        </div>
    </div>
</div>
@stop