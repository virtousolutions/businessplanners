@section('title')
Profile
@stop

@section('content')
    <div class="col-sm-10 col-xs-12 col-sm-offset-1" style="padding: 20px;">
        @if($errors->any())
        <div class="alert alert-dismissable alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <ul style="list-style-type: none; padding: 0px; margin: 0px;">
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
        </div>
        @endif
        <legend style="margin-bottom: 50px;">Edit your personal information</legend>
        {{ Form::open(array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'profile-form')) }}
            <div class="form-group">
                <label class="col-sm-4 control-label">Package</label>
                <div class="col-sm-8">
                    {{ ucwords($user->getPackageNice()) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                    {{ $user->email }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">First Name</label>
                <div class="col-sm-8">
                    {{ Form::text('first_name', $user->first_name, array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Last Name</label>
                <div class="col-sm-8">
                    {{ Form::text('last_name', $user->last_name, array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Address 1</label>
                <div class="col-sm-8">
                    {{ Form::text('address_1', $user->address_1, array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Address 2</label>
                <div class="col-sm-8">
                    {{ Form::text('address_2', $user->address_2, array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Town/City</label>
                <div class="col-sm-8">
                    {{ Form::text('city', $user->city, array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                </div>
            </div>
            <!--div class="form-group">
                <label class="col-sm-4 control-label">State</label>
                <div class="col-sm-8">
                    {{ Form::text('county', $user->state, array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                </div>
            </div-->
            <div class="form-group">
                <label class="col-sm-4 control-label">Country:</label>
                <div class="col-sm-8">
                {{ Form::select('country', $countries, $user->country, array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Post Code</label>
                <div class="col-sm-8">
                    {{ Form::text('post_code', $user->post_code, array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Telephone</label>
                <div class="col-sm-8">
                    {{ Form::text('telephone', $user->telephone, array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Mobile</label>
                <div class="col-sm-8">
                    {{ Form::text('mobile', $user->mobile, array('class' => 'form-control', 'style' => 'width: 80%;')) }}
                </div>
            </div>
            <div class="col-sm-8 col-sm-offset-4" style="margin-top: 20px;">
                <button class="btn btn-primary btn-lg" type="submit">Save</button>
            </div>
        {{ Form::close() }}
    </div>
@stop