@extends('app')

@section('title')
Order Package
@stop

@section('content')
<div class="col-xs-12" style="margin-bottom: 20px;">
    <!--div class="col-xs-12" style="padding: 0px; margin-bottom: 30px;">
        <div class="btn-primary logo" style="width: 150px; padding: 15px; border-radius">
            <img style="width: 120px;" src="assets/img/logo-white.png"/>
        </div>
    </div-->
    
    <div class="container">
        <div class="col-xs-12" style="padding: 50px 25px; min-height: 250px;">
            <h3 style="line-height: 35px;">Thank you for ordering our {{ ucwords($package) }} package. Kindly check your email for your login details.</h3>
        </div>
    </div>
</div>
@stop

