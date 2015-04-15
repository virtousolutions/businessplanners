<?php
    $calculator = $data['calculator'];
    $data_sales = $calculator->getSales();
    $start_year = $business_plan->getStartYear();
?>

@if (!empty($data_sales))
<div class="col-xs-12" style="padding: 0px; margin-bottom: 50px; margin-top: 50px;">
    <h4>Sales Forecast Table</h4>
    <div class="click-to-edit" style="margin-right: -10px;  margin-top: -30px;">
        <div class="tuck">
            <a href="{{ url('plan/financial-plan-sales-forecast/' . $business_plan->id) }}">
                <div class="flag">
                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                </div>
            </a>
        </div>
    </div>
    <?php
    $unit_sales = "";
    $price_per_unit = "";
    $sales = "";
    $cost_per_unit = "";
    $costs = "";
    $total_sales = $calculator->getYearlyTotalSales();
    $total_costs = $calculator->getYearlyTotalDirectCosts();
    $gross_margin = $calculator->getYearlyGrossMargin();
    $gross_margin_percent = $calculator->getYearlyGrossMarginPercent();

    foreach ($data_sales as $sale) {
        $unit_sales .= '
            <div class="data-row">
                <div class="col-xs-5" style="padding-left: 0px;">' . $sale->sales_forecast_name . '</div>
                <div class="col-xs-7" style="padding: 0px; text-align: right;">
                    <div class="col-xs-4">' . number_format($sale->totals[0], 0) . '</div>
                    <div class="col-xs-4">' . number_format($sale->totals[1], 0) . '</div>
                    <div class="col-xs-4" style="padding-right: 0px;">' . number_format($sale->totals[2], 0) . '</div>
                </div>
            </div>';

        $price_per_unit .= '
            <div class="data-row">
                <div class="col-xs-5" style="padding-left: 0px;">' . $sale->sales_forecast_name . '</div>
                <div class="col-xs-7" style="padding: 0px; text-align: right;">
                    <div class="col-xs-4">&pound;' . number_format($sale->price, 2) . '</div>
                    <div class="col-xs-4">&pound;' . number_format($sale->price, 2) . '</div>
                    <div class="col-xs-4" style="padding-right: 0px;">&pound;' . number_format($sale->price, 2) . '</div>
                </div>
            </div>';

        $sales .= '
            <div class="data-row">
                <div class="col-xs-5" style="padding-left: 0px;">' . $sale->sales_forecast_name . '</div>
                <div class="col-xs-7" style="padding: 0px; text-align: right;">
                    <div class="col-xs-4">&pound;' . number_format($sale->total_sales[0], 2) . '</div>
                    <div class="col-xs-4">&pound;' . number_format($sale->total_sales[1], 2) . '</div>
                    <div class="col-xs-4" style="padding-right: 0px;">&pound;' . number_format($sale->total_sales[2], 2) . '</div>
                </div>
            </div>';

        $cost_per_unit .= '
            <div class="data-row">
                <div class="col-xs-5" style="padding-left: 0px;">' . $sale->sales_forecast_name . '</div>
                <div class="col-xs-7" style="padding: 0px; text-align: right;">
                    <div class="col-xs-4">&pound;' . number_format($sale->cost, 2) . '</div>
                    <div class="col-xs-4">&pound;' . number_format($sale->cost, 2) . '</div>
                    <div class="col-xs-4" style="padding-right: 0px;">&pound;' . number_format($sale->cost, 2) . '</div>
                </div>
            </div>';

        $costs .= '
            <div class="data-row">
                <div class="col-xs-5" style="padding-left: 0px;">' . $sale->sales_forecast_name . '</div>
                <div class="col-xs-7" style="padding: 0px; text-align: right;">
                    <div class="col-xs-4">&pound;' . number_format($sale->total_costs[0], 2) . '</div>
                    <div class="col-xs-4">&pound;' . number_format($sale->total_costs[1], 2) . '</div>
                    <div class="col-xs-4" style="padding-right: 0px;">&pound;' . number_format($sale->total_costs[2], 2) . '</div>
                </div>
            </div>';
    }

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
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Unit Sales
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
        </div>
    </div>
    {{ $unit_sales }}
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Price Per Unit
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
        </div>
    </div>
    {{ $price_per_unit }}
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Sales
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
        </div>
    </div>
    {{ $sales }}
    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Total Sales</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($total_sales[0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($total_sales[1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($total_sales[2], 2) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Direct Cost Per Unit
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
        </div>
    </div>
    {{ $cost_per_unit }}
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Direct Cost
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
        </div>
    </div>
    {{ $costs }}
    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Total Direct Costs</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($total_costs[0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($total_costs[1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($total_costs[2], 2) }}</div>
        </div>
    </div>
    <div class="data-row">
        <div class="col-xs-5" style="padding-left: 0px;">Gross Margin</div>
        <div class="col-xs-7" style="padding: 0px; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($gross_margin[0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($gross_margin[1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($gross_margin[2], 2) }}</div>
        </div>
    </div>
    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">Gross Margin %</div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">{{ number_format($gross_margin_percent[0], 2) }}</div>
            <div class="col-xs-4">{{ number_format($gross_margin_percent[1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ number_format($gross_margin_percent[2], 2) }}</div>
        </div>
    </div>
</div>
@else
<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <a href="{{ url('plan/financial-plan-sales-forecast/' . $business_plan->id) }}" class="launch-builder">
        <div class="sub-page-sub-section-container">
            <h4>Sales Forecast Table</h4>
            <div class="sub-page-sub-section-value-container" style="font-size: 14px; margin-bottom: 15px;">Launch the step-by-step table builder</div>
        </div>
    </a>
</div>
@endif