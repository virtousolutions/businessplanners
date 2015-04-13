@if (!empty($data['expenses']))
<div class="col-xs-12" style="padding: 0px; margin-bottom: 20px;">
    <h4>Budget Table</h4>
    <div class="click-to-edit" style="margin-right: -40px;  margin-top: -30px;">
        <div class="tuck">
            <a href="{{ url('plan/financial-plan-budget/' . $business_plan->id) }}">
                <div class="flag">
                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                </div>
            </a>
        </div>
    </div>
    <?php 
        $list = $data['expenses'];
        $start_year = $list[0]->financial_yr_forecast;
    ?>

    <div class="data-row" style="margin-top: 15px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Expenses
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">{{ $start_year }}</div>
            <div class="col-xs-4">{{ ($start_year + 1) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">{{ ($start_year + 2)}}</div>
        </div>
    </div>

    <?php
    $expenses_totals = [0 => 0, 1 => 0, 2 => 0];
    ?>

    @foreach ($list as $row)
        <div class="data-row">
            <div class="col-xs-5" style="padding-left: 0px;">
            {{ $row->expenditure_name}}
            <?php 
            $year_totals = explode(",", $row->totals); 
            $expenses_totals[0] += $year_totals[0];
            $expenses_totals[1] += $year_totals[1];
            $expenses_totals[2] += $year_totals[2];
            ?>

            </div>
            <div class="col-xs-7" style="padding: 0px; text-align: right;">
                <div class="col-xs-4">&pound;{{ number_format($year_totals[0], 2) }}</div>
                <div class="col-xs-4">&pound;{{ number_format($year_totals[1], 2) }}</div>
                <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($year_totals[2], 2) }}</div>
            </div>
        </div>
    @endforeach

    <div class="data-title" style="margin-top: 0px;">
        <div class="col-xs-5" style="padding-left: 0px; font-weight: bold;">
            Total Expenses
        </div>
        <div class="col-xs-7" style="padding: 0px; font-weight: bold; text-align: right;">
            <div class="col-xs-4">&pound;{{ number_format($expenses_totals[0], 2) }}</div>
            <div class="col-xs-4">&pound;{{ number_format($expenses_totals[1], 2) }}</div>
            <div class="col-xs-4" style="padding-right: 0px;">&pound;{{ number_format($expenses_totals[2], 2) }}</div>
        </div>
    </div>

    
</div>
@else
<div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
    <a href="{{ url('plan/financial-plan-budget/' . $business_plan->id) }}" class="launch-builder">
        <div class="sub-page-sub-section-container">
            <h4>Budget Table</h4>
            <div class="sub-page-sub-section-value-container" style="font-size: 14px; margin-bottom: 15px;">Launch the step-by-step table builder</div>
        </div>
    </a>
</div>
@endif