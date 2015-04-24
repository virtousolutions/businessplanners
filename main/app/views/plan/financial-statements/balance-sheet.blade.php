<?php
    $calculator = $data['calculator'];
    $data       = $calculator->getBalanceSheetData();
    $start_year = $business_plan->getStartYear();
?>
<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-title" style="margin-top: 15px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            As of Period's End
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">FY{{ $start_year }}</div>
            <div class="col-xs-4">FY{{ ($start_year + 1) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">FY{{ ($start_year + 2)}}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Cash</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['cash'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['cash'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['cash'][2], 2) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Accounts Receivable</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['accounts_receivable'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['accounts_receivable'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['accounts_receivable'][2], 2) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Total Current Assets</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['total_current_assets'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['total_current_assets'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['total_current_assets'][2], 2) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Long Term Assets</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['long_term_assets'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['long_term_assets'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['long_term_assets'][2], 2) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Accumulated Depreciation</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">(&pound;{{ number_format($data['accumulated_depreciation'][0] * -1, 2) }})</div>
            <div class="col-xs-4">(&pound;{{ number_format($data['accumulated_depreciation'][1] * -1, 2) }})</div>
            <div class="col-xs-4" style="padding-right: 0px;">(&pound;{{ number_format($data['accumulated_depreciation'][2] * -1, 2) }})</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Total Long-Term Assets</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['total_long_term_assets'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['total_long_term_assets'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['total_long_term_assets'][2], 2) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Total Assets</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['total_assets'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['total_assets'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['total_assets'][2], 2) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Accounts Payable</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['accounts_payable'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['accounts_payable'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['accounts_payable'][2], 2) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Total Current Liabilities</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['current_liabilities'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['current_liabilities'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['current_liabilities'][2], 2) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Long-Term Debt</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['long_term_debt'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['long_term_debt'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['long_term_debt'][2], 2) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Total Liabilities</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['total_liabilities'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['total_liabilities'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['total_liabilities'][2], 2) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Paid-in-capital</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['paid_in_capital'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['paid_in_capital'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['paid_in_capital'][2], 2) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Retained Earnings</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['retained_earnings'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['retained_earnings'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['retained_earnings'][2], 2) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Earnings</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['earnings'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['earnings'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['earnings'][2], 2) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Total Owner Equity</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['total_owner_equity'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['total_owner_equity'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['total_owner_equity'][2], 2) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Total Liabilities & Equity</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($data['total_liabilities_equity'][0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($data['total_liabilities_equity'][1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($data['total_liabilities_equity'][2], 2) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="margin-bottom: 50px;">
</div>