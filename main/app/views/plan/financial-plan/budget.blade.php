<?php
    $budget_calculator = $data['calculator'];
    $expenses = $budget_calculator->getExpenses();
    $total_expenses = $budget_calculator->getExpensesYearlyTotals();
    $purchases = $budget_calculator->getPurchases();
    $total_purchases = $budget_calculator->getPurchasesYearlyTotals();
    $start_year = $business_plan->getStartYear();
?>
@if (!empty($expenses) || !empty($purchases))
<div class="col-xs-12" style="padding: 0px; margin-bottom: 50px;">
    <h4>Budget Table</h4>
    <div class="click-to-edit" style="margin-right: -10px;  margin-top: -30px;">
        <div class="tuck">
            <a href="{{ url('plan/financial-plan-budget/' . $business_plan->id . '?selected_tab=' . (isset($options['b-tab']) ? $options['b-tab'] : 'expenses')) }}">
                <div class="flag">
                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                </div>
            </a>
        </div>
    </div>
    <div class="data-row" style="margin-top: 15px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Expenses
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">FY{{ $start_year }}</div>
            <div class="col-xs-4">FY{{ ($start_year + 1) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">FY{{ ($start_year + 2)}}</div>
        </div>
    </div>
    @foreach ($expenses as $row)
        <div class="data-row">
            <div class="col-xs-5" style="padding-left: 0px;">
                {{ $row->expenditure_name}}
            </div>
            <div class="col-xs-7" style="padding: 0px; text-align: right;">
                <div class="col-xs-4">&pound;{{ number_format($row->totals[0], 2) }}</div>
                <div class="col-xs-4">&pound;{{ number_format($row->totals[1], 2) }}</div>
                <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($row->totals[2], 2) }}</div>
            </div>
        </div>
    @endforeach

    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Total Expenses
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($total_expenses[0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($total_expenses[1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($total_expenses[2], 2) }}</div>
        </div>
    </div>

    <div class="data-row" style="margin-top: 15px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Major Purchases
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">FY{{ $start_year }}</div>
            <div class="col-xs-4">FY{{ ($start_year + 1) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">FY{{ ($start_year + 2)}}</div>
        </div>
    </div>

    @foreach ($purchases as $row)
        <div class="data-row">
            <div class="col-xs-5" style="padding-left: 0px;">
            {{ $row->mp_name}}
            </div>
            <div class="col-xs-7" style="padding: 0px; text-align: right;">
                <div class="col-xs-4">&pound;{{ number_format($row->mp_price, 2) }}</div>
                <div class="col-xs-4">&pound;{{ number_format(0, 2) }}</div>
                <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format(0, 2) }}</div>
            </div>
        </div>
    @endforeach

    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Total Major Purchases
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($total_purchases[0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format(0, 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format(0, 2) }}</div>
        </div>
    </div>
</div>
@else
<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <a href="{{ url('plan/financial-plan-budget/' . $business_plan->id . '?selected_tab=' . (isset($options['b-tab']) ? $options['b-tab'] : 'expenses')) }}" class="launch-builder">
        <div class="sub-page-sub-section-container">
            <h4>Budget Table</h4>
            <div class="sub-page-sub-section-value-container" style="font-size: 14px; margin-bottom: 15px;">Launch the step-by-step table builder</div>
        </div>
    </a>
</div>
@endif