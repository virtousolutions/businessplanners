@if ($data)
<div class="col-xs-12" style="padding: 0px; margin-top: 30px; margin-bottom: 30px;">
    <h4>Cash Flow Projections</h4>
    <div class="click-to-edit" style="margin-right: -10px;  margin-top: -30px;">
        <div class="tuck">
            <a href="{{ url('plan/financial-plan-cash-flow-projections/' . $business_plan->id . '?payment_type=' . (isset($options['c-tab']) ? $options['c-tab'] : 'incoming')) }}" class="">
                <div class="flag">
                    <span class="click-to-edit-text" id="ext-gen6"> &nbsp;</span> 
                </div>
            </a>
        </div>
    </div>
    <div class="data-title">Cash Inflow</div>
    <div class="data-row">
        <div class="data-row-left">
            % of Sales on Credit
        </div>
        <div class="data-row-right">
            {{ $data->incoming_percentage }}%
        </div>
    </div>
    <div class="data-row">
        <div class="data-row-left">
            Avg Collection Period (Days)
        </div>
        <div class="data-row-right">
            {{ $data->incoming_collection }}
        </div>
    </div>
    <div class="data-title">Cash Outflow</div>
    <div class="data-row">
        <div class="data-row-left">
            % of Purchases on Credit
        </div>
        <div class="data-row-right">
            {{ $data->outgoing_percentage }}%
        </div>
    </div>
    <div class="data-row">
        <div class="data-row-left">
            Avg Payment Delay (Days)
        </div>
        <div class="data-row-right">
            {{ $data->outgoing_collection }}
        </div>
    </div>
</div>
@else
<div class="col-xs-12" style="margin-top: 30px; padding: 0px;">
    <a href="{{ url('plan/financial-plan-cash-flow-projections/' . $business_plan->id) }}" class="launch-builder">
        <div class="sub-page-sub-section-container">
            <h4>Cash Flow Projections</h4>
            <div class="sub-page-sub-section-value-container" style="font-size: 14px; margin-bottom: 15px;">Launch the step-by-step table builder</div>
        </div>
    </a>
</div>
@endif