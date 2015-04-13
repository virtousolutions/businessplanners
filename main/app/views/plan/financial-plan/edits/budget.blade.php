<?php
$selected_tab = isset($options['budget_selected_tab']) ? $options['budget_selected_tab'] : 'expenses';
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
    <legend>Budget Table</legend>
    <div class="col-xs-12" style="padding: 0px;">
        <a class="backtoplan back-to-outline" href="{{ url('plan/refresh-page?business_plan_id=' . $business_plan->id . '&page=financial-plan&pageurl=budget') }}" >Back to Outline</a>
    </div>
    <div class="col-xs-12" style="padding: 15px 0px;">
        <div class="tableBuilder">
            <ul class="nav">
                <li>
                    <a href="#" class="financial-plan-tab-edit {{ $selected_tab == 'expenses' ? 'active' : '' }}" data-name="expenses" data-elem_name="budget-selected-tab">
                        <span class="num">
                            1</span>
                        <span class="label" style="width: 120px;">Expenses</span>
                        <span class="clear"></span>
                    </a>
                </li>
                <li>
                    <a href="#" class="financial-plan-tab-edit {{ $selected_tab == 'purchases' ? 'active' : '' }}" data-name="purchases" data-elem_name="budget-selected-tab">
                        <span class="num">
                         2</span>
                        <span class="label" style="width: 120px;">Major Purchases</span>
                        <span class="clear"></span>
                    </a>
                </li>
                <li>
                    <a href="#" class="financial-plan-tab-edit {{ $selected_tab == 'taxes' ? 'active' : '' }}" data-name="taxes" data-elem_name="budget-selected-tab">
                        <span class="num">
                         2</span>
                        <span class="label" style="width: 120px;">Income Taxes</span>
                        <span class="clear"></span>
                    </a>
                </li>
            </ul>
            
            <div class="pages">
                <div class="page financial-plan-tab-edit expenses-financial-plan-tab-edit" style="{{ $selected_tab == 'expenses' ? '' : 'display: none;' }}">
                    <div class="page-body">
                        <div class="intro-block ">
                            <div class="widget-content">
                                <h3>List your company's expenses</h3>
                                <p>Get started on your budget by adding your projected expenses below. Expenses like these are all tax deductible and will affect your profits. Be sure not to add any major purchases with long-lasting value here. (We will deal with those later, since they are not immediately tax deductible.) If your company is just getting started, be sure to include any one-time or short-term startup expenses in the early months as you get up and running.</p>
                                <h3>Personnel Expenses</h3>
                                <p>The Salary and Employee Related Expenses lines are included on the Budget table. To edit them,   <a href="">go to the Personnel table</a>.</p>
                            </div>
                        </div>
                        <div class="col-xs-12" style="padding: 0px;" id="expenditure-list">
                            @foreach ($data['expenses'] as $row)
                                <div class="each-entry col-xs-12">
                                    <div class="each-entry-title col-xs-12">{{ $row->expenditure_name}}</div>
                                    <div class="click-to-edit" style="margin-right: -15px;  margin-top: -34px;">
                                        <div class="tuck">
                                            <a href="{{ url('plan/financial-plan-budget/edit/' . $row->exp_id) }}" class="edit-expenditure" data-id="{{ $row->exp_id }}" data-name="{{ $row->expenditure_name }}" data-start_date="{{ $row->expenditure_start_date }}" data-expected_change="{{ $row->expected_change }}" data-percentage_of_change="{{ $row->percentage_of_change }}" data-pay_per_year="{{ $row->pay_per_year }}" data-pay_amount="{{ $row->pay_amount }}">
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
                                <a href="#" class="btn btn-primary add-budget-data-button add-budget-data-button-expenses" id="add-expenditure">Add Expenditure</a>
                            </div>
                        </div>
                        <div class="col-xs-12" id="edit-expenditure" style="padding: 0px; display: none;">
                            <form id="budget-expenditure-form" action="{{ asset('plan/financial-plan-budget-expenditure') }}" method="POST">
                                <input name="business_plan_id" value="{{ $business_plan->id }}" type="hidden"/>
                                <input name="expenditure_id" value="" type="hidden"/>
                                
                                <div class="selected-expense">
                                    <div class="item-header">
                                        <h3>Fill in the details for this expense</h3>
                                    </div>
                                    <div class="expense-budget-entryMethod" style="width: 100%;">
                                        <div class="step expense-name" style="width: 100%;">
                                            <div class="num"> 1</div>
                                            <h4 class="label">What do you want to call this expense?</h4>
                                            <div class="step-inner form-group"  style="width: 100%;">
                                                <input type="text" name="expenditure_name" value="Test 1" maxlength="255" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 2</div>
                                            <h4 class="label">How much is it?</h4>
                                            <div class="step-inner form-group">
                                                <span class="currency" style="float: left; padding-right: 5px">&pound;</span>
                                                <input type="text" name="expenditure_how_much_is_it" value="" maxlength="14" class="form-control" style="float: left; margin-right: 15px; width: 185px;">
                                                <select name="expenditure_how_you_pay" class="entry-period form-control" size="1" style="float: left; width: 200px;">	
                                                    <option value="0">Per Month</option>
                                                    <option value="1">Per Year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 3</div>
                                            <h4 class="label">When does it start?</h4>
                                            <div class="step-inner form-group">
                                                <select name="expenditure_month_year_date" class="entry-period form-control" size="1" style="float: left; width: 200px;"  data-default_value="{{ $data['default_month_year'] }}">	
                                                    @foreach ($data['months'] as $key => $value)    
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 4</div>
                                            <h4 class="label">Expected Price Change Due to Inflation</h4>
                                            <div class="step-inner form-group">
                                                <select name="expenditure_expected_change" class="entry-period form-control" size="1" style="float: left; width: 200px;">	
                                                    <option value="increase">Increase</option>
                                                    <option value="decrease">Decrease</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 5</div>
                                            <h4 class="label">Forecasted Percentage Change Due to Inflation</h4>
                                            <div class="step-inner form-group">
                                                <input type="text" name="expenditure_percentage_of_change" value="" maxlength="14" class="form-control" style="float: left; margin-right: 15px; width: 200px;">
                                                <span class="currency" style="float: left;">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                    <button type="submit" class="btn btn-primary" id="save-expenditure">Save</button>
                                    <a href="#" class="btn btn-default" id="cancel-expenditure">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div><!--end .page-body-->
                </div><!--end of page-->
                
                <div class="page financial-plan-tab-edit purchases-financial-plan-tab-edit" style="{{ $selected_tab == 'purchases' ? '' : 'display: none;' }}">
                    <div class="page-body">
                        <div id="" class="intro-block">
                            <div class="widget-content">
                                <h3>List any major purchases with long-lasting value</h3>
                                <p>It is customary for major purchases that offer long-lasting value to be treated differently than regular expenses in the financials. The expenses you entered in the previous step here are typically used up within the period in which they are paid. Paying rent in January provides you with value in January but not in February or beyond. Its value is temporary. Buying a company work van in January, on the other hand, might result in a large cash outlay (or loan obligation) in January, but it will continue to provide value to you for years to come. This is the concept that accountants call "assets." We call them "major purchases" here, since that is a little easier to remember, but it's the same idea.</p>
                                <p>Note that depreciation is calculated automatically based on a plan option called Average Depreciation Period.</p>
                            </div>
                        </div>
                        <div class="col-xs-12" style="padding: 0px;" id="purchase-list">
                            @foreach ($data['purchases'] as $row)
                                <div class="each-entry col-xs-12">
                                    <div class="each-entry-title col-xs-12">{{ $row->mp_name}}</div>
                                    <div class="click-to-edit" style="margin-right: -15px;  margin-top: -34px;">
                                        <div class="tuck">
                                            <a href="{{ url('plan/financial-plan-budget/edit/' . $row->exp_id) }}" class="edit-expenditure" data-id="{{ $row->exp_id }}" data-name="{{ $row->mp_name }}" data-start_date="{{ $row->expenditure_start_date }}" data-expected_change="{{ $row->expected_change }}" data-percentage_of_change="{{ $row->percentage_of_change }}" data-pay_per_year="{{ $row->pay_per_year }}" data-pay_amount="{{ $row->pay_amount }}">
                                                <div class="flag">
                                                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12" style="padding: 0px;">
                                    <?php $count = 1; ?>
                                    @foreach ($data['months'] as $month)
                                        <div class="col-xs-1" style="padding: 0 5px;">
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
                                        <div class="col-xs-1" style="padding: 0 5px;">
                                            <p class="each-entry-month">{{ 'FY' . ($row->financial_yr_forecast + $count) }}</p>
                                            <p class="each-entry-value">&pound;{{ number_format($total, 2) }}</p>
                                        </div>
                                        <?php $count++; ?>
                                    @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                <a href="#" class="btn btn-primary" id="add-purchase">Add Major Purchase</a>
                            </div>
                        </div>
                        <div class="col-xs-12" id="edit-purchase" style="padding: 0px; display: none;">
                            <form id="budget-purchase-form" action="{{ asset('plan/financial-plan-budget-purchase') }}" method="POST">
                                <input name="business_plan_id" value="{{ $business_plan->id }}" type="hidden"/>
                                <input name="mp_id" value="" type="hidden"/>
                                
                                <div class="selected-expense">
                                    <div class="item-header">
                                        <h3>Fill in the details for this major purchase</h3>
                                    </div>
                                    <div class="expense-budget-entryMethod" style="width: 100%;">
                                        <div class="step expense-name" style="width: 100%;">
                                            <div class="num"> 1</div>
                                            <h4 class="label">What do you want to call this major purchase?</h4>
                                            <div class="step-inner form-group"  style="width: 100%;">
                                                <input type="text" name="mp_name" value="" maxlength="255" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 2</div>
                                            <h4 class="label">What's the price of this purchase?</h4>
                                            <div class="step-inner form-group">
                                                <span class="currency" style="float: left; padding-right: 5px">&pound;</span>
                                                <input type="text" name="mp_price" value="" maxlength="14" class="form-control" style="float: left; margin-right: 15px; width: 185px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 3</div>
                                            <h4 class="label">When will you make this purchase?</h4>
                                            <div class="step-inner form-group">
                                                <select name="mp_date" class="entry-period form-control" size="1" style="float: left; width: 200px;"  data-default_value="{{ $data['default_month_year'] }}">	
                                                    @foreach ($data['months'] as $key => $value)    
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 4</div>
                                            <h4 class="label">How do you want to depreciate this purchase?</h4>
                                            <div class="step-inner form-group">
                                                <label class="radio inline">
                                                    <input type="radio" value="1"/>
                                                    First
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="mp_depreciate" class="form-control" value="0">
                                                    Do not depreciate this purchase
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                    <button type="submit" class="btn btn-primary" id="save-purchase">Save</button>
                                    <a href="#" class="btn btn-default" id="cancel-purchase">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="page financial-plan-tab-edit taxes-financial-plan-tab-edit" style="{{ $selected_tab == 'taxes' ? '' : 'display: none;' }}">
                    <div class="page-body">
                        <div id="" class="intro-block">
                            <div class="widget-content">
                                <h3>Enter your estimated rate for income taxes</h3>
                                <p>If your business is profitable in a given year, you will need to pay a variety of taxes on that profit. Enter an overall tax rate to include in your plan. This estimated rate should cover all applicable income taxes - federal, state, local, etc. Don't stress too much about this. This is business planning, not tax planning. It's good to include a reasonable allotment for taxes. If you're not sure what to put, though, a 30% rate is probably close. These taxes typically apply only when you are profitable. Any year without a profit should show zero taxes.</p>
                                <p>Note that this rate is only for income taxes. Employee-related taxes like payroll and social welfare taxes are covered in the Personnel Plan table. Other taxes, such as property taxes, are generally best added as miscellaneous expenses.</p>
                            </div>
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
        <a class="btn btn-default back-to-outline" href="{{ url('plan/refresh-page?business_plan_id=' . $business_plan->id . '&page=financial-plan&pageurl=budget') }}" >I'm Done</a>
    </div>
</div> <!-- end row -->

@stop