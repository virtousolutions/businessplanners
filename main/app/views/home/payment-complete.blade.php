@section('title')
Order Package
@stop

@section('content')
<div class="col-xs-12" style="margin-bottom: 20px;">
    <!--div class="col-xs-12" style="padding: 0px; margin-bottom: 30px;">
        <div class="btn-primary logo" style="width: 150px; padding: 15px; border-radius">
            <img style="width: 120px;" src="assets/img/logo-white.png"/>
        </div>
    </div-->
    
    <div class="col-xs-12" style="padding: 20px 25px;">
        <h3 style="line-height: 35px;">Thank you for your purchase. We will keep in touch with you shortly. Kindly check your email for your payment details.</h3>
    </div>

    <script>
        var TRANSACTION_ID = '{{ isset($old_data['transaction_id']) ? $old_data['transaction_id'] : 'TRAN-1'}}';
        var AFFILIATION = '{{ isset($old_data['affiliation']) ? $old_data['affiliation'] : 'The Business Planners'}}';
        var REVENUE = '{{ isset($old_data['revenue']) ? $old_data['revenue'] : 1 }}';
        var PRODUCT_NAME = '{{ isset($old_data['product_name']) ? $old_data['product_name'] : 'Package 1' }}';
        var PRODUCT_ID = '{{ isset($old_data['product_id']) ? $old_data['product_id'] : 1 }}';
        var PRODUCT_PRICE = '{{ isset($old_data['product_price']) ? $old_data['product_price'] : 1 }}';
        var PRODUCT_BRAND = '{{ isset($old_data['product_brand']) ? $old_data['product_brand'] : 'The Business Planners' }}';
        var PRODUCT_CATEGORY = '{{ isset($old_data['product_category']) ? $old_data['product_category'] : 'Service' }}';
        var PRODUCT_VARIANT = '{{ isset($old_data['product_variant']) ? $old_data['product_variant'] : 'White' }}';
        var PRODUCT_QUANTITY = '{{ isset($old_data['product_quantity']) ? $old_data['product_quantity'] : 1 }}';
    </script>
</div>
@stop
