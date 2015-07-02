<?php
$selected_tab = isset($options['selected_tab']) ? $options['selected_tab'] : 'personnel';
?>
@section('content')
<div id="notification" class="col-xs-12" style="margin-bottom: 20px; padding: 0px;">
    @if(Session::get('message'))
        <div class="alert alert-dismissable alert-success" style="font-size: 14px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <b>{{ Session::get('message') }}</b>
        </div>
    @endif
</div>

<div class="col-xs-12 financial-plan-editor">
    <legend>Human Resources Table</legend>
    <div class="col-xs-12" style="padding: 0px;">
        <a class="backtoplan back-to-outline" href="{{ url('plan/financial-plan/human-resources/' . $business_plan->id) }}" >Back to Outline</a>
    </div>
    <div class="col-xs-12" style="padding: 15px 0px;">
        <div class="tableBuilder">
            <ul class="nav">
                <li>
                    <a href="#" class="financial-plan-tab-edit {{ $selected_tab == 'personnel' ? 'active' : '' }}" data-name="personnel" data-elem_name="budget-selected-tab">
                        <span class="num">
                            1</span>
                        <span class="label" style="width: 120px;">Personnel</span>
                        <span class="clear"></span>
                    </a>
                </li>
                <li>
                    <a href="#" class="financial-plan-tab-edit {{ $selected_tab == 'expenses' ? 'active' : '' }}" data-name="expenses" data-elem_name="budget-selected-tab">
                        <span class="num">
                         2</span>
                        <span class="label" style="width: 120px;">Related Expenses</span>
                        <span class="clear"></span>
                    </a>
                </li>
            </ul>
            
            <div class="pages">
                <div class="page financial-plan-tab-edit personnel-financial-plan-tab-edit" style="{{ $selected_tab == 'personnel' ? '' : 'display: none;' }}">
                    <div class="page-body">
                        <div class="intro-block ">
                            <div class="widget-content">
                                <h3>List your current and planned employees</h3>
                                <p>This is where you will cover salaries and wages paid to your employees and independent contractors, including your own pay. Depending on how big your company is, you can list every employee by name or title, or you can group them into employee types or groups if that makes more sense. Two things to keep in mind:</p>
                                <p>1. Don't include employee benefits and payroll taxes here. You'll handle that in the next step.</p>
                                <p>2. Don't forget to pay yourself! Your accountant may have you listing your own salary a different way for accounting purposes, but this is planning, and you need to include your own compensation as part of your expenses.</p>
                            </div>
                        </div>
                        <div class="col-xs-12" style="padding: 0px;" id="personnel-list">
                            @foreach ($data['employees'] as $row)
                                <div class="each-entry col-xs-12">
                                    <div class="each-entry-title col-xs-12">{{ $row->employee_name}}</div>
                                    <div class="click-to-edit" style="margin-right: -15px;  margin-top: -34px;">
                                        <div class="tuck">
                                            <a href="{{ url('plan/financial-plan-budget/edit/' . $row->employee_id) }}" class="edit-personnel" data-employee_id="{{ $row->employee_id }}" data-employee_name="{{ $row->employee_name }}" data-employee_start_date="{{ $row->employee_start_date }}" data-employee_type="{{ $row->employee_type }}" data-employee_pay_per_year="{{ $row->employee_pay_per_year }}" data-employee_pay_amount="{{ $row->employee_pay_amount }}">
                                                <div class="flag">
                                                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12" style="padding: 0px;">
                                    <?php $count = 1; ?>
                                    @foreach ($data['months'] as $month)
                                        <div class="col-xs-2" style="padding: 0 5px;">
                                            <p class="each-entry-month">{{ $month }}</p>
                                            <?php $key = "month_" . ($count < 10 ? '0' : '') . $count; ?>
                                            <p class="each-entry-value">&pound;{{ number_format($row->$key, 2) }}</p>
                                        </div>
                                        <?php $count++; ?>
                                    @endforeach
                                    </div>
                                    <?php 
                                    $year_totals = explode(",", $row->totals); 
                                    $count = 0;
                                    ?>
                                    <div class="col-xs-12" style="padding: 0px;">
                                    @foreach ($year_totals as $total)
                                        <div class="col-xs-2" style="padding: 0 5px;">
                                            <p class="each-entry-month">{{ 'FY' . ($row->financial_yr_forecast + $count) }}</p>
                                            <p class="each-entry-value">&pound;{{ number_format($total, 2) }}</p>
                                        </div>
                                        <?php $count++; ?>
                                    @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                <a href="#" class="btn btn-primary add-budget-data-button add-budget-data-button-expenses" id="add-personnel">Add an Employee</a>
                            </div>
                        </div>
                        <div class="col-xs-12" id="edit-personnel" style="padding: 0px; display: none;">
                            <form id="human-resources-personnel-form" action="{{ asset('plan/financial-plan-human-resources-personnel') }}" method="POST">
                                <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
                                <input name="business_plan_id" value="{{ $business_plan->id }}" type="hidden"/>
                                <input name="employee_id" value="" type="hidden"/>
                                
                                <div class="selected-expense">
                                    <div class="item-header">
                                        <h3>Fill in the details for this employee</h3>
                                    </div>
                                    <div class="expense-budget-entryMethod" style="width: 100%;">
                                        <div class="step expense-name" style="width: 100%;">
                                            <div class="num"> 1</div>
                                            <h4 class="label">What do you want to call this person or role?</h4>
                                            <div class="step-inner form-group"  style="width: 100%;">
                                                <input type="text" name="employee_name" value="Test 1" maxlength="255" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 2</div>
                                            <h4 class="label">How much will you pay them?</h4>
                                            <div class="step-inner form-group">
                                                <span class="currency" style="float: left; padding-right: 5px">&pound;</span>
                                                <input type="text" name="employee_pay_amount" value="" maxlength="14" class="form-control" style="float: left; margin-right: 15px; width: 185px;">
                                                <select name="employee_pay_per_year" class="entry-period form-control" size="1" style="float: left; width: 200px;">	
                                                    <option value="0">Per Month</option>
                                                    <option value="1">Per Year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 3</div>
                                            <h4 class="label">When will they start?</h4>
                                            <div class="step-inner form-group">
                                                <select name="employee_start_date" class="entry-period form-control" size="1" style="float: left; width: 200px;"  data-default_value="{{ $data['default_month_year'] }}">	
                                                    @foreach ($data['months'] as $key => $value)    
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 4</div>
                                            <h4 class="label">Is this a regular employee or contract hire?</h4>
                                            <div class="col-xs-12" style="font-size: 15px; padding-left: 50px;">
                                                The burden rate in the next tab (which covers payroll taxes and benefits) will not be applied to contract workers.
                                            </div>
                                            <div class="step-inner form-group">
                                                <div class="col-xs-12">
                                                    <label class="radio" style="margin-bottom: 0px;">
                                                        <input type="radio" name="employee_type" id="employee_type_regular" value="regular">
                                                        Regular employee
                                                    </label>
                                                </div>
                                                <div class="col-xs-12">
                                                    <label class="radio" style="margin-bottom: 0px;">
                                                        <input type="radio" name="employee_type" id="employee_type_contract" value="contract">
                                                        Contract hire
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                    <button type="submit" class="btn btn-primary" id="save-personnel">Save</button>
                                    <a href="{{ url('plan/financial-plan-human-resources-delete-personnel') }}"  class="btn btn-danger" id="delete-employee">Delete</a>
                                    <a href="#" class="btn btn-default" id="cancel-personnel">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div><!--end .page-body-->
                </div><!--end of page-->
                
                <div class="page financial-plan-tab-edit expenses-financial-plan-tab-edit" style="{{ $selected_tab == 'expenses' ? '' : 'display: none;' }}">
                    <div class="page-body">
                        <div id="" class="intro-block">
                            <div class="widget-content">
                                <h3>Enter your estimated rate for employee-related expenses</h3>
                                <p>Salaries and wages are far from the only expenses involved in having employees. Depending on your location, other employee-related expenses may include payroll taxes, worker's compensation insurance, health insurance, and other benefits and taxes.</p>
                                <p>These expenses need to be reflected in your plan. It's not necessary to try to predict these expenses in precise detail. Instead, business plans typically use what's called a "burden" rate. This is just a simple percentage of total employee compensation that is added to cover these related expenses. (Note that the burden rate does not apply to contract workers.)</p>
                                <p>In the profit and loss statement, you can see the calculated amount - total employee compensation multiplied by the burden percentage - on the "Employee Related Expenses" line.</p>
                            </div>
                        </div>
                        <div class="col-xs-12" style="padding: 0px;">
                            <form id="human-resources-expenses-form" action="{{ asset('plan/financial-plan-human-resources-expenses') }}" method="POST">
                                <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
                                <input name="business_plan_id" value="{{ $business_plan->id }}" type="hidden"/>
                                <div class="selected-expense">
                                    <div class="item-header">
                                        <h3>Burden Rate</h3>
                                    </div>
                                    <div class="expense-budget-entryMethod" style="width: 100%;">
                                        <div class="step expense-name" style="width: 100%; padding: 20px;">
                                            <h4 class="label">Enter your estimated rate for employee-related expenses</h4>
                                            <div class="step-inner form-group"  style="width: 100%; padding: 10px 0;">
                                                <input type="text" name="bp_related_expenses_in_percentage" value="{{ $business_plan->bp_related_expenses_in_percentage }}" maxlength="10" class="form-control" style="width: 100px; float: left; margin-right: 15px;">
                                                <span class="currency" style="float: left;">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                    <button type="submit" class="btn btn-primary" id="save-expenses">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>    
                </div>
            </div><!--end of pages-->
        </div><!--end .tableBuilder-->
    </div> <!--end no name div -->
    <legend></legend>
    <div class="col-xs-6" style="padding: 0px;">
        <div class="col-xs-12" style="padding: 0px; margin-top: 15px; display: none;" id="save-budget-message">
            <img style="width: 30px; margin-right: 10px;" src="{{ asset('assets/img/loading.gif') }}"/>
            <span style="font-size: 15px;">Saving your changes. Please don't close the dialog box</span>
        </div>
        <div class="col-xs-12" style="padding: 15px; text-align: left; color: #3c763d; font-size: 15px; display: none;" id="save-budget-message-success">
        </div>
    </div>
    <div class="col-xs-6" style="padding: 10px 0px; text-align: right;">
        <a class="btn btn-default back-to-outline" href="{{ url('plan/financial-plan/human-resources/' . $business_plan->id) }}" >I'm Done</a>
    </div>
</div> <!-- end row -->

@stop