<?php
    $sales_calculator = $data['sales_calculator'];
    $budget_calculator = $data['budget_calculator'];
    $fs_calculator = $data['fs_calculator'];
    $data_sales = $sales_calculator->getSales();
    $expenses = $budget_calculator->getExpenses();
    $total_expenses = $budget_calculator->getExpensesYearlyTotals();
    $personnels = $budget_calculator->getPersonnelsYearlyTotals();
    $yearly_totals = $budget_calculator->getRelatedExpensesYearlyTotals();
    $start_year = $business_plan->getStartYear();
    $operating_income = $fs_calculator->getYearlyOperatingIncome();
    $interests = $fs_calculator->getYearlyInterestIncurred();
    $depreciation = $fs_calculator->getYearlyDepreciation();
    $tax = $fs_calculator->getYearlyIncomeTax();
    $net_profit = $fs_calculator->getYearlyNetProfit();
?>
@if (!empty($data_sales))
<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <?php
    $total_sales = $sales_calculator->getYearlyTotalSales();
    $total_costs = $sales_calculator->getYearlyTotalDirectCosts();
    $gross_margin = $sales_calculator->getYearlyGrossMargin();
    $gross_margin_percent = $sales_calculator->getYearlyGrossMarginPercent();
    ?>

    <div class="data-title" style="margin-top: 15px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">FY{{ $start_year }}</div>
            <div class="col-xs-4">FY{{ ($start_year + 1) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">FY{{ ($start_year + 2)}}</div>
        </div>
    </div>
    <div class="data-title">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Revenue</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($total_sales[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($total_sales[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($total_sales[2]) }}</div>
        </div>
    </div>
    <div class="data-title">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Direct Cost</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($total_costs[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($total_costs[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($total_costs[2]) }}</div>
        </div>
    </div>
    <div class="data-row" style="margin-top: 15px;">
        <div class="col-xs-5" style="padding-left: 0px;">Gross Margin</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($gross_margin[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($gross_margin[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($gross_margin[2]) }}</div>
        </div>
    </div>
    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Gross Margin %</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">{{ number_format($gross_margin_percent[0]) }}%</div>
            <div class="col-xs-4">{{ number_format($gross_margin_percent[1]) }}%</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ number_format($gross_margin_percent[2]) }}%</div>
        </div>
    </div>
</div>
@endif

@if (!empty($expenses))
<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Expenses
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">FY{{ $start_year }}</div>
            <div class="col-xs-4">FY{{ ($start_year + 1) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">FY{{ ($start_year + 2)}}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">
            Salary
        </div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($personnels[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($personnels[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($personnels[2]) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">
            Employee Related Expenses
        </div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($yearly_totals[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($yearly_totals[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($yearly_totals[2]) }}</div>
        </div>
    </div>
    @foreach ($expenses as $row)
        <div class="data-row">
            <div class="col-xs-5" style="padding-left: 0px;">
                {{ $row->expenditure_name}}
            </div>
            <div class="col-xs-7" style="padding: 0px; text-align: right;">
                <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($row->totals[0]) }}</div>
                <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($row->totals[1]) }}</div>
                <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($row->totals[2]) }}</div>
            </div>
        </div>
    @endforeach

    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Total Expenses
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($total_expenses[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($total_expenses[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($total_expenses[2]) }}</div>
        </div>
    </div>
</div>
@endif

@if (!empty($operating_income))
<div class="col-xs-12" style="padding: 0px; margin-top: 15px;">
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Operating Income
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($operating_income[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($operating_income[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($operating_income[2]) }}</div>
        </div>
    </div>
</div>
@endif

<div class="col-xs-12" style="padding: 0px; margin-top: 15px;">
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Interest Incurred</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($interests[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($interests[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($interests[2]) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Depreciation and Amortization</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($depreciation[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($depreciation[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($depreciation[2]) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Income Taxes</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($tax[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($tax[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($tax[2]) }}</div>
        </div>
    </div>
    <div class="data-row" style="font-weight: bold;">
        <div class="col-xs-5" style="padding-left: 0px;">Net Profit</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($net_profit[0]) }}</div>
            <div class="col-xs-4">{{ $fs_calculator->formatNumberDisplay($net_profit[1]) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ $fs_calculator->formatNumberDisplay($net_profit[2]) }}</div>
        </div>
    </div>
    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px;">Net Profit / Sales</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">{{ number_format(($net_profit[0] / $total_sales[0]) * 100) }}%</div>
            <div class="col-xs-4">{{ number_format(($net_profit[1] / $total_sales[1]) * 100) }}%</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ number_format(($net_profit[2] / $total_sales[2]) * 100) }}%</div>
        </div>
    </div>
</div>

<?php if($net_profit[0] >= 100000) : ?>
<div class="col-xs-12" style="margin-top: 30px;">
    <p>
        Did you know...
    </p>
    <p>
        This client is suitable for the Darwin Corporation Tax mitigation structure.
        <b>You can earn 20% comission</b> for successfully referring this client whilst
        helping them minimise their Corporation Tax exposure.
    </p>
    <p>
        Click <a href="http://www.contractorspro.co.uk/about-us">here</a> to learn more about Darwin and how both you and your client benefit
    </p>
</div>
<?php endif; ?>

<div class="col-xs-12" style="margin-bottom: 50px;">
</div>