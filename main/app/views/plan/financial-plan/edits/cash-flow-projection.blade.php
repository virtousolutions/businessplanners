@section('content')
<!--JAVASCRIPT SLIDER-->
<script>
    window.dhx_globalImgPath = "{{ asset('assets/css/plan/slider/codebase/imgs') . '/' }}";
</script>
<script  src="{{ asset('assets/css/plan/slider/codebase/dhtmlxcommon.js') }}"></script>
<script  src="{{ asset('assets/css/plan/slider/codebase/dhtmlxslider.js') }}"></script>
<script  src="{{ asset('assets/css/plan/slider/codebase/ext/dhtmlxslider_start.js') }}"></script>
<link rel="STYLESHEET" type="text/css" href="{{ asset('assets/css/plan/slider/codebase/dhtmlxslider.css') }}">    

<?php
$payment_type = (isset($options['payment_type']) && $options['payment_type'] == 'outgoing') ? 'outgoing' : 'incoming';
?>

<form name="cash-flow-projection" action="{{ asset('plan/financial-plan-cash-flow-projections') }}" method="POST">
    <input name="business_plan_id" value="{{ $business_plan->id }}" type="hidden"/>
    <input name="cash-flow-payment-type" value="{{ $payment_type }}" type="hidden"/>
    <div class="col-xs-12 financial-plan-editor">
        <legend class="modal-title" id="myModalLabel">Cash Flow Projections</legend>
        <div class="col-xs-12" style="padding: 0px;">
            <a class="backtoplan back-to-outline" href="{{ url('plan/financial-plan/cash-flow-projections/' . $business_plan->id) }}" >Back to Outline</a>
        </div>
        <div class="col-xs-12" style="padding: 15px 0px;">
            <div class="tableBuilder">
                <ul class="nav">
                    <li>
                        <a href="#" class="financial-plan-tab-edit {{ $payment_type == 'incoming' ? 'active' : '' }}" data-name="incoming" data-elem_name="cash-flow-payment-type">
                            <span class="num">
                                1</span>
                            <span class="label" style="width: 120px;">Incoming Payments</span>
                            <span class="clear"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="financial-plan-tab-edit {{ $payment_type == 'outgoing' ? 'active' : '' }}" data-name="outgoing" data-elem_name="cash-flow-payment-type">
                            <span class="num">
                             2</span>
                            <span class="label" style="width: 120px;">Outgoing Payments</span>
                            <span class="clear"></span>
                        </a>
                    </li>
                </ul>
                
                <div class="pages">
                    <div class="page financial-plan-tab-edit incoming-financial-plan-tab-edit" style="{{ $payment_type == 'incoming' ? '' : 'display: none;' }}">
                        <div class="page-body">
                            <div class="intro-block ">
                                <div class="widget-content">
                                    <h3>About your incoming payments</h3>
                                    <p>When planning your spending, it is 
                                    important to recognize the timing involved in any inbound sales on credit - 
                                    what your accountant will call "accounts receivable." If you make a sale 
                                    for cash today, that money is immediately available for you to use. If you 
                                    agree to invoice your customer for future payment, though, you have to 
                                    wait for that payment to come in before you can access the money owed to 
                                    you. You can minimize the effect of credit sales by following up with your 
                                    customers to ensure you are paid on time and managing your spending to 
                                    keep a reasonable buffer in the bank. Otherwise, it's possible to be 
                                    profitable on paper and end up going under anyway because the money
                                     owed in is not available in time.</p>
                                </div>
                            </div>
                            
                            <?php 
                            $incoming_params = [
                                'title' => 'Incoming payments', 
                                'type' => 'incoming',
                                'labels' => [
                                    'What percentage of your sales will be on credit?',
                                    'How many days will it take, on average, to collect incoming payments?'
                                ],
                                'instructions' => [
                                    'Select the estimated portion of your sales revenue that will be invoiced for later payment, rather than paid at the time of the purchase.',
                                    'Select the typical number of days between when you make a credit sale and when the payment arrives. Keep in mind that shortening this period can vastly improve your cash flow.'
                                ],
                                'values' => [
                                    $data ? $data->incoming_percentage : 0, 
                                    $data ? $data->incoming_collection : 0
                                ]

                            ]; 
                            ?>
                            @include('plan.financial-plan.edits.payment', $incoming_params)
                        </div><!--end .page-body-->
                    </div><!--end of page-->
                    
                    <div class="page financial-plan-tab-edit outgoing-financial-plan-tab-edit" style="{{ $payment_type == 'outgoing' ? '' : 'display: none;' }}">
                        <div class="page-body">
                            <div id="" class="intro-block">
                                <div class="widget-content">
                                    <h3>About your outgoing payments</h3>
                                    <p>Just as slow payments from your customers 
                                    will hurt your cash flow, so will fast payments to your suppliers. Think about 
                                    the timing of your outgoing payments - what your accountant will 
                                    call "accounts payable." Paying for more purchases later instead of 
                                    immediately will leave more cash in the bank for your business to work with.</p>
                                </div>
                            </div>

                            <?php 
                            $outgoing_params = [
                                'title' => 'Outgoing payments', 
                                'type' => 'outgoing',
                                'labels' => [
                                    'What percentage of your purchases will be on credit?',
                                    'How many days will you wait, on average, before making outgoing payments?'
                                ],
                                'instructions' => [
                                    'Select the approximate percentage of your company\'s purchases that will be billed for later payment, not paid up front.',
                                    'It is a good idea to pay your bills on a regular schedule, rather than immediately after receiving them. Your suppliers will typically provide 15, 30, or more days of leeway before payment is due. The longer you can keep the cash, the better for your working balance.'
                                ],
                                'values' => [
                                    $data ? $data->outgoing_percentage : 0, 
                                    $data ? $data->outgoing_collection : 0
                                ]

                            ]; 
                            ?>
                            @include('plan.financial-plan.edits.payment', $outgoing_params)
                        </div>
                    </div><!--end of page-->
                </div><!--end of pages-->
            </div><!--end .tableBuilder-->
        </div>
        <div class="col-xs-6" style="padding: 0px;">
            <div class="col-xs-12" style="padding: 0px; margin-top: 15px; display: none;" id="save-cfp-message">
                <img style="width: 30px; margin-right: 10px;" src="{{ asset('assets/img/loading.gif') }}"/>
                <span style="font-size: 15px;">Saving your changes. Please don't close the dialog box</span>
            </div>
            <div class="col-xs-12" style="padding: 15px; text-align: left; color: #3c763d; font-size: 15px; display: none;" id="save-cfp-message-success">
            </div>
            <div class="col-xs-12" style="padding: 15px; text-align: left; color: #a94442; font-size: 15px; display: none;" id="save-cfp-message-error">
            </div>
        </div>
        <div class="col-xs-6" style="padding: 10px 0px; text-align: right;">
            <a class="btn btn-primary" href="#" id="save-cash-flow-projection">Save</a>
            <a class="btn btn-default back-to-outline" href="{{ url('plan/financial-plan/cash-flow-projections/' . $business_plan->id) }}">I'm Done</a>
        </div>
    </div>
</form>
@stop