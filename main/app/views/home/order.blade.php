@section('content')
    <div class="col-xs-12" style="margin-top: 20px; margin-bottom: 20px;">
        @if ($package['id'] == 1)
            <div id="packages" class="col-sm-4" style="padding: 0px; margin-bottom: 20px; margin-top: 20px;">
                <div class="price-box col-xs-12">
                    <div class="header">
                        <div class="price">{{ $package['name'] }}</div>
                        <div class="price">&pound;{{ number_format($package['price']) }}</div>
                    </div>
                    <div class="diy-content">
                        With our DIY business plan, you can go and create your business plan yourself. (Please note that this service does not include a financial review). Make sure to also check out our three business plan packages
                    </div>
                </div>
            </div>
        @else
            <div id="packages" class="col-sm-4" style="padding: 0px; margin-bottom: 20px;">
                @include('package.package')
            </div>
        @endif
        <div class="col-sm-7 col-sm-offset-1 col-xs-12">
            <h2>Secure Payment Form</h2>
            <p>&nbsp;</p>
            <legend>Personal Details</legend>
            {{ Form::open(array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'package-form')) }}
                <div class="form-group">
                    <label class="col-sm-4 control-label">First Name</label>
                    <div class="col-sm-8">
                        {{ Form::text('first_name', (isset($first_name) ? $first_name : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Last Name</label>
                    <div class="col-sm-8">
                        {{ Form::text('last_name', (isset($last_name) ? $last_name : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Address 1</label>
                    <div class="col-sm-8">
                        {{ Form::text('address_1', (isset($address_1) ? $address_1 : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Address 2</label>
                    <div class="col-sm-8">
                        {{ Form::text('address_2', (isset($address_2) ? $address_2 : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Town/City</label>
                    <div class="col-sm-8">
                        {{ Form::text('city', (isset($city) ? $city : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">State</label>
                    <div class="col-sm-8">
                        {{ Form::text('county', (isset($county) ? $county : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Country:</label>
                    <div class="col-sm-8">
                    {{ Form::select('country', $countries, (isset($country) ? $country : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Post Code</label>
                    <div class="col-sm-8">
                        {{ Form::text('post_code', (isset($post_code) ? $post_code : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Email Address</label>
                    <div class="col-sm-8">
                        {{ Form::text('email_address', (isset($email_address) ? $email_address : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Telephone</label>
                    <div class="col-sm-8">
                        {{ Form::text('telephone', (isset($telephone) ? $telephone : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Mobile</label>
                    <div class="col-sm-8">
                        {{ Form::text('mobile', (isset($mobile) ? $mobile : null), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox col-sm-offset-4 col-sm-8">
                    <label>
                      <input type="checkbox" name="terms_and_conditions"> I accept the <a href="{{ url('') . '/terms' }}" target="_blank">terms and conditions</a>
                    </label>
                  </div>
                </div>
                <div class="col-sm-8 col-sm-offset-4" style="margin-top: 20px;">
                    <button class="btn btn-primary btn-lg" type="submit">Pay now!</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop