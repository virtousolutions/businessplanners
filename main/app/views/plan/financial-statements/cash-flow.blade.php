<?php
    $calculator = $data['calculator'];
    $data       = $calculator->getCashFlowData();
    $start_year = $business_plan->getStartYear();
?>
<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-title" style="margin-top: 15px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;"></div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">FY{{ $start_year }}</div>
            <div class="col-xs-4">FY{{ ($start_year + 1) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">FY{{ ($start_year + 2)}}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Operations</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;"></div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Net Profit</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['net_profit'][0]) }}</div>
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['net_profit'][1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $calculator->formatNumberDisplay($data['net_profit'][2]) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Depreciation and Amortization</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['depreciation'][0]) }}</div>
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['depreciation'][1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $calculator->formatNumberDisplay($data['depreciation'][2]) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Change in Accounts Receivable</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['change_in_accounts_recievable'][0]) }}</div>
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['change_in_accounts_recievable'][1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $calculator->formatNumberDisplay($data['change_in_accounts_recievable'][2]) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Change in Accounts Payable</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['change_in_accounts_payable'][0]) }}</div>
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['change_in_accounts_payable'][1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $calculator->formatNumberDisplay($data['change_in_accounts_payable'][2]) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Net Cash Flow From Operations</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['net_cash_flow_from_operations'][0]) }}</div>
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['net_cash_flow_from_operations'][1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $calculator->formatNumberDisplay($data['net_cash_flow_from_operations'][2]) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Investing and Finance</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;"></div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Assets Purchased or Sold</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">({{ $calculator->formatNumberDisplay($data['assets_purchased_or_sold'][0]) }})</div>
            <div class="col-xs-4">({{ $calculator->formatNumberDisplay($data['assets_purchased_or_sold'][1]) }})</div>
            <div class="col-xs-4" style="padding-right: 0px;">({{ $calculator->formatNumberDisplay($data['assets_purchased_or_sold'][2]) }})</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Change in Long-Term Debt</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['change_in_long_term_debt'][0]) }}</div>
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['change_in_long_term_debt'][1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $calculator->formatNumberDisplay($data['change_in_long_term_debt'][2]) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Net Cash Flow From Investing & Financing</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['net_cash_flow_from_investing_financing'][0]) }}</div>
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['net_cash_flow_from_investing_financing'][1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $calculator->formatNumberDisplay($data['net_cash_flow_from_investing_financing'][2]) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Cash at Beginning of Period</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['cash_at_beginning'][0]) }}</div>
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['cash_at_beginning'][1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $calculator->formatNumberDisplay($data['cash_at_beginning'][2]) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Net Change in Cash</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['net_change_in_cash'][0]) }}</div>
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['net_change_in_cash'][1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $calculator->formatNumberDisplay($data['net_change_in_cash'][2]) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Cash at End of Period</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['cash_at_end'][0]) }}</div>
            <div class="col-xs-4">{{ $calculator->formatNumberDisplay($data['cash_at_end'][1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $calculator->formatNumberDisplay($data['cash_at_end'][2]) }}</div>
        </div>
    </div>
</div>

<div class="col-xs-12" style="margin-bottom: 50px;">
</div>