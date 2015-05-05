<form id="plan-details-form" name="plan-details-form" method="post" class="no-enter" action="" target="">
    <h3>Plan Name</h3>
    <p>This name will appear on each page of your business plan. It also helps identify the plan on the list of plans created on your account.</p>
    <div class="col-xs-12" style="padding: 0px;">
        <div class="form-group col-xs-8" style="padding: 0px;">
            <input id="plan_name" class="form-control" type="text" name="plan_name" maxlength="60" size="60" value="{{ isset($plan_name) ? $plan_name : '' }}">
        </div>
    </div>
    <h3>Start Date</h3>
    <p>When do you expect to start executing your business plan? Make your best guess. This will be the first month in your financials etc.</p>
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
    <br/><br/>
    <input name="bp_user_id" type="hidden" value="<?php echo $bp_user_id; ?>"   /> 
    <input name="bp_id" type="hidden" value="<?php echo $bp_id; ?>"   /> 
    
    <div class="col-xs-12" style="margin: 20px 0; padding: 0px;">
        <button name="save_plan" type="submit" class="btn btn-primary">{{ $plan_details_form_button_text }}</button>
    </div>
</form> 