<?php
$countries = DB::table('countries')->orderBy(DB::raw("country_name='United Kingdom'"), 'desc')->orderBy('country_name')->lists('country_name', 'id');
$countries = ['' => 'Select'] + $countries;
?>

<form id="plan-details-form" name="plan-details-form" method="post" class="no-enter" action="" target="">
{{ Form::open(array('id' => 'plan-details-form', 'name' => 'plan-details-form', 'method' => 'POST', 'class' => 'no-enter')) }}
    <h3>Plan Name</h3>
    <p>This name will appear on each page of your business plan. It also helps identify the plan on the list of plans created on your account.</p>
    <div class="col-xs-12" style="padding: 0px;">
        <div class="form-group col-xs-8" style="padding: 0px;">
            <input id="plan_name" class="form-control" type="text" name="plan_name" maxlength="60" size="60" value="{{ isset($plan_name) ? $plan_name : '' }}">
        </div>
    </div>
    <h3 style="margin-top: 15px; float: left;">Start Date</h3>
    <div class="col-xs-12" style="padding: 0px;">
        <p>When do you expect to start executing your business plan? Make your best guess. This will be the first month in your financials etc.</p>
    </div>
    <div class="col-xs-12" style="padding: 0px;">
        <label class="start-date-text">
            <span class="title">Start Date:</span>
        </label>
        <div class="form-group col-xs-3">
            <select id="start_month" name="start_month" size="1" style="float: left" class="form-control">	
                @foreach($months as $month)
                    <option value='{{ $month }}' {{ (isset($plan_month) && $plan_month == $month) ? 'selected' : '' }}>{{ $month }}</option>
                @endforeach
            </select>
        </div>   
        <label class="start-date-text" style="width: 20px;"> <span class="title">of</span></label>
        <div class="form-group col-xs-3">
            <input id="start_year" type="text" name="start_year" value="<?php echo $plan_year; ?>" maxlength="4" class="form-control">
        </div>
    </div>
    <h3 style="margin-top: 15px; float: left;">Company Information</h3>
    <div class="col-xs-12" style="padding: 0px;">
        <p>This information will appear on the cover page of your plan report.</p>
    </div>
    <div class="col-xs-12" style="padding: 0px;">
        <div class="form-group col-xs-3" style="padding-left: 0px;">
            <label class="start-date-text" style="width: 100%;">
                <span class="title">Contact Name:</span>
            </label>
        </div>
        <div class="form-group col-xs-8">
            <input class="form-control" type="text" name="contact_name" maxlength="150" value="{{ isset($contact_name) ? $contact_name : '' }}">
        </div>
        <div class="form-group col-xs-3" style="padding-left: 0px;">
            <label class="start-date-text" style="width: 100%;">
                <span class="title">Address 1:</span>
            </label>
        </div>
        <div class="form-group col-xs-8">
            <input class="form-control" type="text" name="address_1" maxlength="255" value="{{ isset($address_1) ? $address_1 : '' }}">
        </div>
        <div class="form-group col-xs-3" style="padding-left: 0px;">
            <label class="start-date-text" style="width: 100%;">
                <span class="title">Address 2</span>
            </label>
        </div>
        <div class="form-group col-xs-8">
            <input class="form-control" type="text" name="address_2" maxlength="255" value="{{ isset($address_2) ? $address_2 : '' }}">
        </div>
        <div class="form-group col-xs-3" style="padding-left: 0px;">
            <label class="start-date-text" style="width: 100%;">
                <span class="title">City/Town:</span>
            </label>
        </div>
        <div class="form-group col-xs-8">
            <input class="form-control" type="text" name="city" maxlength="100" value="{{ isset($city) ? $city : '' }}">
        </div>
        <div class="form-group col-xs-3" style="padding-left: 0px;">
            <label class="start-date-text" style="width: 100%;">
                <span class="title">Country:</span>
            </label>
        </div>
        <div class="form-group col-xs-8">
            {{ Form::select('country', $countries, isset($country) ? $country : null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group col-xs-3" style="padding-left: 0px;">
            <label class="start-date-text" style="width: 100%;">
                <span class="title">Post Code</span>
            </label>
        </div>
        <div class="form-group col-xs-8">
            <input class="form-control" type="text" name="post_code" maxlength="50" value="{{ isset($post_code) ? $post_code : '' }}">
        </div>
        <div class="form-group col-xs-3" style="padding-left: 0px;">
            <label class="start-date-text" style="width: 100%;">
                <span class="title">Email:</span>
            </label>
        </div>
        <div class="form-group col-xs-8">
            <input class="form-control" type="text" name="email" maxlength="100"  value="{{ isset($email) ? $email : '' }}">
        </div>
        <div class="form-group col-xs-3" style="padding-left: 0px;">
            <label class="start-date-text" style="width: 100%;">
                <span class="title">Telephone:</span>
            </label>
        </div>
        <div class="form-group col-xs-8">
            <input class="form-control" type="text" name="telephone" maxlength="60" value="{{ isset($telephone) ? $telephone : '' }}">
        </div>
    </div>
    <br/><br/>
    <input name="bp_user_id" type="hidden" value="<?php echo $bp_user_id; ?>"   /> 
    <input name="bp_id" type="hidden" value="<?php echo $bp_id; ?>"   /> 
    
    <div class="col-xs-12" style="margin: 20px 0; padding: 0px;">
        <button name="save_plan" type="submit" class="btn btn-primary">{{ $plan_details_form_button_text }}</button>
    </div>
</form> 