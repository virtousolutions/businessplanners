<?php
$selected_tab = isset($options['selected_tab']) ? $options['selected_tab'] : 'expenses';
$start_year = $business_plan->getStartYear();
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
        <a class="backtoplan back-to-outline" href="{{ url('plan/financial-plan/budget/' . $business_plan->id) }}" >Back to Outline</a>
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
                    <a href="#" class="financial-plan-tab-edit {{ $selected_tab == 'tax' ? 'active' : '' }}" data-name="tax" data-elem_name="budget-selected-tab">
                        <span class="num">
                         3</span>
                        <span class="label" style="width: 120px;">Income Taxes</span>
                        <span class="clear"></span>
                    </a>
                </li>
                <li>
                    <a href="#" class="financial-plan-tab-edit {{ $selected_tab == 'dividends' ? 'active' : '' }}" data-name="dividends" data-elem_name="budget-selected-tab">
                        <span class="num">
                         4</span>
                        <span class="label" style="width: 200px;">Dividends & Profit Distributions</span>
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
                                <?php
                                $months_data_html = "";
                                $months_display_html = "";
                                $years_data_html = "";
                                $years_display_html = "";
                                $year_totals = explode(",", $row->totals); 
                                    
                                foreach ($data['months'] as $index => $month) {
                                    $key = "month_" . (($index + 1) < 10 ? '0' : '') . ($index + 1); 
                                    $value = $row->$key;
                                    $months_data_html .= (empty($months_data_html) ? '' : ', ') . '"' . $index . '" : "' . $value . '"';
                                    $months_display_html .= '
                                        <div class="col-xs-2" style="padding: 0 5px;">
                                            <p class="each-entry-month" style="text-align: center;">' . $month . '</p>
                                            <p class="each-entry-value" style="text-align: center;">&pound;' . number_format($value, 2) . '</p>
                                        </div>';
                                }
                                ?>

                                <div class="each-entry col-xs-12">
                                    <div class="each-entry-title col-xs-12">{{ $row->expenditure_name}}</div>
                                    <div class="click-to-edit" style="margin-right: -15px;  margin-top: -34px;">
                                        <div class="tuck">
                                            <a href="{{ url('plan/financial-plan-budget/edit/' . $row->exp_id) }}" class="edit-expenditure" data-id="{{ $row->exp_id }}" data-name="{{ $row->expenditure_name }}" data-expenditure_months='{ {{ $months_data_html }} }'>
                                                <div class="flag">
                                                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12" style="padding: 0px;">
                                    <?php $count = 1; ?>
                                    {{ $months_display_html }}
                                    </div>
                                    <?php 
                                    $year_totals = explode(",", $row->totals); 
                                    $count = 0;
                                    ?>
                                    <div class="col-xs-12" style="padding: 0px;">
                                    @foreach ($year_totals as $total)
                                        <div class="col-xs-2" style="padding: 0 5px;">
                                            <p class="each-entry-month" style="text-align: center;">{{ 'FY' . ($row->financial_yr_forecast + $count) }}</p>
                                            <p class="each-entry-value" style="text-align: center;">&pound;{{ number_format($total, 2) }}</p>
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
                                <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
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
                                                @foreach ($data['months'] as $index => $month)
                                                <div class="col-xs-2">
                                                    <p>{{ $month }}</p>
                                                    <p><input class="expenditure-months" style="width: 70px;" type="text" name="expenditure_months[{{ $index }}]" value="" maxlength="11" class="form-control"></p>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!--div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 3</div>
                                            <h4 class="label">When does it start?</h4>
                                            <div class="step-inner form-group">
                                                <select name="expenditure_month_year_date" class="entry-period form-control" size="1" style="float: left; width: 200px;"  data-default_value="{{ $data['default_month_year'] }}">	
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
                                    </div-->
                                </div>
                                <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                    <button type="submit" class="btn btn-primary" id="save-expenditure">Save</button>
                                    <a href="{{ url('plan/financial-plan-budget-delete-expenditure') }}" class="btn btn-danger" id="delete-expenditure">Delete</a>
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
                                            <a href="{{ url('plan/financial-plan-budget/edit/' . $row->mp_id) }}" class="edit-purchase" data-mp_id="{{ $row->mp_id }}" data-mp_name="{{ $row->mp_name }}" data-mp_date="{{ $row->mp_date }}" data-mp_price="{{ $row->mp_price }}" data-mp_depreciate="{{ $row->mp_depreciate }}">
                                                <div class="flag">
                                                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12" style="padding: 0px;">
                                        <div class="col-xs-2" style="padding: 0 5px;">
                                            <p class="each-entry-month">{{ (strpos($row->mp_date,'Year 2') !== false) ? ('FY' . ($start_year + 1)) : ((strpos($row->mp_date,'Year 3') !== false) ? ('FY' . ($start_year + 2)) : $row->mp_date) }}</p>
                                            <p class="each-entry-value">&pound;{{ number_format($row->mp_price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                <a href="#" class="btn btn-primary" id="add-purchase">Add Major Purchase</a>
                            </div>
                        </div>
                        <div class="col-xs-12" id="edit-purchase" style="padding: 0px; display: none;">
                            <form id="budget-purchase-form" action="{{ asset('plan/financial-plan-budget-purchase') }}" method="POST">
                                <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
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
                                                <select name="mp_date" class="entry-period form-control" size="1" style="float: left; width: 240px;"  data-default_value="{{ $data['default_month_year'] }}">	
                                                    @foreach ($data['months'] as $key => $value)    
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                    <!-- add option for second year and third year --> 
                                                    <?php
                                                    $year_2 = sprintf('%s - %s (Year 2)', date('F Y', strtotime($data['months'][0] . " + 1 year")), date('F Y', strtotime($data['months'][0] . " + 23 months")));
                                                    $year_3 = sprintf('%s - %s (Year 3)', date('F Y', strtotime($data['months'][0] . " + 2 years")), date('F Y', strtotime($data['months'][0] . " + 35 months")));
                                                    ?>
                                                    <option value="{{ $year_2 }}">{{ $year_2 }}</option>
                                                    <option value="{{ $year_3 }}">{{ $year_3 }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 4</div>
                                            <h4 class="label">How do you want to depreciate this purchase?</h4>
                                            <div class="step-inner form-group">
                                                <div class="col-xs-12">
                                                    <label class="radio">
                                                        <input type="radio" name="mp_depreciate" id="mp_depreciate_1" value="1">
                                                        Use the Average Depreciation Period option
                                                    </label>
                                                </div>
                                                <div class="col-xs-12">
                                                    <label class="radio">
                                                        <input type="radio" name="mp_depreciate" id="mp_depreciate_0" value="0">
                                                        Do not depreciate this purchase
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                    <button type="submit" class="btn btn-primary" id="save-purchase">Save</button>
                                    <a href="{{ url('plan/financial-plan-budget-delete-purchase') }}"  class="btn btn-danger" id="delete-purchase">Delete</a>
                                    <a href="#" class="btn btn-default" id="cancel-purchase">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="page financial-plan-tab-edit tax-financial-plan-tab-edit" style="{{ $selected_tab == 'tax' ? '' : 'display: none;' }}">
                    <div class="page-body">
                        <div id="" class="intro-block">
                            <div class="widget-content">
                                <h3>Enter your estimated rate for income taxes</h3>
                                <p>
                                If your business is profitable in a given year, you will need to pay a variety of taxes on that profit. Enter an overall tax rate to include in your plan. This estimated rate should cover all applicable taxes – income, corporation , federal, state, local, etc. Don't stress too much about this. This is business planning, not tax planning. It's good to include a reasonable allotment for taxes. If you're not sure what to put, though, a 30% rate is probably close if you are self-employed or 20% if you are a limited company. These taxes typically apply only when you are profitable. Any year without a profit should show zero taxes.
                                </p>
                                <p>
                                Note that this rate is only for business-related taxes. Employee-related taxes like payroll and social welfare taxes are covered in the Personnel Plan table. Other taxes, such as property taxes, are generally best added as miscellaneous expenses.
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-12" style="padding: 0px;">
                            <form id="budget-tax-form" action="{{ asset('plan/financial-plan-budget-tax') }}" method="POST">
                                <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
                                <input name="business_plan_id" value="{{ $business_plan->id }}" type="hidden"/>
                                <div class="selected-expense">
                                    <div class="item-header">
                                        <h3>Income Tax Rate</h3>
                                    </div>
                                    <div class="expense-budget-entryMethod" style="width: 100%;">
                                        <div class="step expense-name" style="width: 100%; padding: 20px;">
                                            <h4 class="label">Enter your estimated rate for income taxes</h4>
                                            <div class="step-inner form-group"  style="width: 100%; padding: 10px 0;">
                                                <input type="text" name="bp_income_tax_in_percentage" value="{{ $business_plan->bp_income_tax_in_percentage }}" maxlength="10" class="form-control" style="width: 100px; float: left; margin-right: 15px;">
                                                <span class="currency" style="float: left;">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                    <button type="submit" class="btn btn-primary" id="save-tax">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>    
                </div>

                <div class="page financial-plan-tab-edit dividends-financial-plan-tab-edit" style="{{ $selected_tab == 'dividends' ? '' : 'display: none;' }}">
                    <div class="page-body">
                        <div class="intro-block ">
                            <div class="widget-content">
                                <h3>List your company's dividends and profit distributions</h3>
                                <p>Dividends and profits can only be distributed out of retained earnings after tax.</p>
                                <p>If retained earnings are negative then dividends and profits can not be distributed and therefore need to be reduced or removed or need to be reduced.</p>
                            </div>
                        </div>
                        <div class="col-xs-12" style="padding: 0px;" id="dividends-list">
                            @foreach ($data['dividends'] as $row)
                                <?php
                                $months_data_html = "";
                                $months_display_html = "";
                                $years_data_html = "";
                                $years_display_html = "";
                                $year_totals = explode(",", $row->totals); 
                                    
                                foreach ($data['months'] as $index => $month) {
                                    $key = "month_" . (($index + 1) < 10 ? '0' : '') . ($index + 1); 
                                    $value = $row->$key;
                                    $months_data_html .= (empty($months_data_html) ? '' : ', ') . '"' . $index . '" : "' . $value . '"';
                                    $months_display_html .= '
                                        <div class="col-xs-2" style="padding: 0 5px;">
                                            <p class="each-entry-month" style="text-align: center;">' . $month . '</p>
                                            <p class="each-entry-value" style="text-align: center;">&pound;' . number_format($value, 2) . '</p>
                                        </div>';
                                }

                                foreach ($year_totals as $index => $total) {
                                    $years_data_html .= (empty($years_data_html) ? '' : ', ') . '"' . $index . '" : "' . $total . '"';
                                    $years_display_html .= '<div class="col-xs-2" style="padding: 0 5px;">
                                        <p class="each-entry-month" style="text-align: center;">FY' . ($start_year + $index) . '</p>
                                        <p class="each-entry-value" style="text-align: center;">' . $total . '</p>
                                    </div>';
                                }
                                ?>
                                <div class="each-entry col-xs-12">
                                    <div class="each-entry-title col-xs-12">{{ $row->dividend_name}}</div>
                                    <div class="click-to-edit" style="margin-right: -15px;  margin-top: -34px;">
                                        <div class="tuck">
                                            <a href="{{ url('plan/financial-plan-budget/edit/' . $row->dividend_id) }}" class="edit-dividend" data-id="{{ $row->dividend_id }}" data-name="{{ $row->dividend_name }}" data-dividend_months='{ {{ $months_data_html }} }' data-dividend_years='{ {{ $years_data_html }} }'>
                                                <div class="flag">
                                                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12" style="padding: 0px;">
                                    {{ $months_display_html }}
                                    </div>
                                    <div class="col-xs-12" style="padding: 0px;">
                                    {{ $years_display_html }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                <a href="#" class="btn btn-primary add-budget-data-button add-budget-data-button-dividends" id="add-dividend">Add Dividend and Distribution</a>
                            </div>
                        </div>
                        <div class="col-xs-12" id="edit-dividend" style="padding: 0px; display: none;">
                            <form id="budget-dividend-form" action="{{ asset('plan/financial-plan-budget-dividend') }}" method="POST">
                                <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
                                <input name="business_plan_id" value="{{ $business_plan->id }}" type="hidden"/>
                                <input name="dividend_id" value="" type="hidden"/>
                                
                                <div class="selected-expense">
                                    <div class="item-header">
                                        <h3>Fill in the details for this dividend and distribution</h3>
                                    </div>
                                    <div class="expense-budget-entryMethod" style="width: 100%;">
                                        <div class="step expense-name" style="width: 100%;">
                                            <div class="num"> 1</div>
                                            <h4 class="label">What do you want to call this dividend and profit distribution?</h4>
                                            <div class="step-inner form-group"  style="width: 100%;">
                                                <input type="text" name="dividend_name" value="" maxlength="255" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expense-budget-entryMethod">
                                        <div class="step expense-name">
                                            <div class="num"> 2</div>
                                            <h4 class="label">How much is it?</h4>
                                            <div class="step-inner form-group">
                                                @foreach ($data['months'] as $index => $month)
                                                <div class="col-xs-2">
                                                    <p>{{ $month }}</p>
                                                    <p><input class="dividend-months" style="width: 70px;" type="text" name="dividend_months[{{ $index }}]" value="" maxlength="11" class="form-control"></p>
                                                </div>
                                                @endforeach
                                                <?php $start_year = $business_plan->getStartYear(); ?>
                                                <div class="col-xs-2">
                                                    <p>FY{{ $start_year }}</p>
                                                    <p><input style="width: 70px;" type="text" name="dividend_years[0]" value="" maxlength="11" class="form-control" disabled></p>
                                                </div>
                                                <div class="col-xs-2">
                                                    <p>FY{{ $start_year + 1 }}</p>
                                                    <p><input style="width: 70px;" type="text" name="dividend_years[1]" value="" maxlength="11" class="form-control"></p>
                                                </div>
                                                <div class="col-xs-2">
                                                    <p>FY{{ $start_year + 2 }}</p>
                                                    <p><input style="width: 70px;" type="text" name="dividend_years[2]" value="" maxlength="11" class="form-control"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="padding: 0px; text-align: right;">
                                    <button type="submit" class="btn btn-primary" id="save-dividend">Save</button>
                                    <a href="{{ url('plan/financial-plan-budget-delete-dividend') }}" class="btn btn-danger" id="delete-dividend">Delete</a>
                                    <a href="#" class="btn btn-default" id="cancel-dividend">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div><!--end .page-body-->
                </div><!--end of page-->


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
        <a class="btn btn-default back-to-outline" href="{{ url('plan/financial-plan/budget/' . $business_plan->id) }}" >I'm Done</a>
    </div>
</div> <!-- end row -->

@stop