@extends('app')

@section('title')
Order Package
@stop

@section('content')
    <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="col-sm-8 col-xs-12 col-sm-offset-2" style="padding: 20px;">
            <legend>Please enter your personal details to continue with your order</legend>
            @if($errors->any())
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <ul style="list-style-type: none; padding: 0px; margin: 0px;">
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
            </div>
            @endif
            {{ Form::open(array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'package-form')) }}
                <div class="form-group">
                    <label class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-8">
                        {{ Form::text('first_name', (isset($first_name) ? $first_name : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-8">
                        {{ Form::text('last_name', (isset($last_name) ? $last_name : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Address 1</label>
                    <div class="col-sm-8">
                        {{ Form::text('address_1', (isset($address_1) ? $address_1 : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Address 2</label>
                    <div class="col-sm-8">
                        {{ Form::text('address_2', (isset($address_2) ? $address_2 : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Town/City</label>
                    <div class="col-sm-8">
                        {{ Form::text('city', (isset($city) ? $city : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div>
                <!--div class="form-group">
                    <label class="col-sm-3 control-label">State</label>
                    <div class="col-sm-8">
                        {{ Form::text('state', (isset($county) ? $county : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div-->
                <div class="form-group">
                    <label class="col-sm-3 control-label">Country:</label>
                    <div class="col-sm-8">
                    {{ Form::select('country', $countries, (isset($country) ? $country : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Post Code</label>
                    <div class="col-sm-8">
                        {{ Form::text('post_code', (isset($post_code) ? $post_code : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Email </label>
                    <div class="col-sm-8">
                        {{ Form::text('email', (isset($email) ? $email : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Telephone</label>
                    <div class="col-sm-8">
                        {{ Form::text('telephone', (isset($telephone) ? $telephone : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Mobile</label>
                    <div class="col-sm-8">
                        {{ Form::text('mobile', (isset($mobile) ? $mobile : null), array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox col-sm-offset-3 col-sm-8">
                    <label>
                      <input type="checkbox" name="terms_and_conditions"> I accept the <a href="{{ url('') . '/terms' }}" target="_blank">terms and conditions</a>
                    </label>
                  </div>
                </div>
                <div class="col-sm-8 col-sm-offset-3" style="margin-top: 20px;">
                    <button class="btn btn-primary btn-lg" type="submit">Pay now!</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop