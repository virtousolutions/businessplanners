<?php
    $calculator = $data['calculator'];
    $loans = $calculator->getLoans();
    $totals = $calculator->getLoansYearlyTotals();
    $start_year = $business_plan->getStartYear();
?>

@if (!empty($loans))
<div class="col-xs-12" style="padding: 0px; margin-bottom: 50px; margin-top: 50px;">
    <h4>Loans and Investments Table</h4>
    <div class="click-to-edit" style="margin-right: -10px;  margin-top: -30px;">
        <div class="tuck">
            <a href="{{ url('plan/financial-plan-loans-and-investments/' . $business_plan->id) }}">
                <div class="flag">
                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                </div>
            </a>
        </div>
    </div>
    <div class="data-title" style="margin-top: 15px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">FY{{ $start_year }}</div>
            <div class="col-xs-4">FY{{ ($start_year + 1) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">FY{{ ($start_year + 2)}}</div>
        </div>
    </div>

    @foreach ($loans as $loan)
        <div class="data-row">
            <div class="col-xs-5" style="padding-left: 0px;"><b>{{ $loan->loan_invest_name }}</b><br/>Loan at {{  number_format($loan->loan_invest_interest_rate, 2) }}% Interest</div>
            <div class="col-xs-7" style="padding: 0px; text-align: right;">
                <div class="col-xs-4">{{ number_format($loan->totals[0], 2) }}</div>
                <div class="col-xs-4">{{ number_format($loan->totals[1], 2) }}</div>
                <div class="col-xs-4" style="padding-right: 0px;">{{ number_format($loan->totals[2], 2) }}</div>
            </div>
        </div>
    @endforeach
    
    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Total Amount Received</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($totals[0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($totals[1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($totals[2], 2) }}</div>
        </div>
    </div>
</div>
@else
<div class="col-xs-12" style="padding: 0px; margin-top: 20px; margin-bottom: 20px;">
    <a href="{{ url('plan/financial-plan-loans-and-investments/' . $business_plan->id) }}" class="launch-builder">
        <div class="sub-page-sub-section-container">
            <h4>Loans and Investments Table</h4>
            <div class="sub-page-sub-section-value-container" style="font-size: 14px; margin-bottom: 15px;">Launch the step-by-step table builder</div>
        </div>
    </a>
</div>
@endif