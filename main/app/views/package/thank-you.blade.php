@extends('app')
<?php $num = rand(500, 10000); ?>
@if($prdt == 'diy')
    @section('tagmanager')
        <script>
            ga('require', 'ecommerce');

            ga('ecommerce:addTransaction', {
              'id': '{{$num}}',                     // Transaction ID. Required.
              'affiliation': 'The Business Planners',   // Affiliation or store name.
              'revenue': '199.99',               // Grand Total.
              'shipping': '0',                  // Shipping.
              'tax': '0'                     // Tax.
            });

            ga('ecommerce:addItem', {
              'id': '{{$num}}',                     // Transaction ID. Required.
              'name': 'DIY Business Plan',    // Product name. Required.
              'sku': 'BP001',                 // SKU/code.
              'category': 'The Business Planners',         // Category or variation.
              'price': '199.99',                 // Unit price.
              'quantity': '1'                   // Quantity.
            });

            ga('ecommerce:send');
        </script>
    @stop
@elseif($prdt == 'value')
    @section('tagmanager')
        <script>
            ga('require', 'ecommerce');

            ga('ecommerce:addTransaction', {
              'id': '{{$num}}',                     // Transaction ID. Required.
              'affiliation': 'The Business Planners',   // Affiliation or store name.
              'revenue': '999.99',               // Grand Total.
              'shipping': '0',                  // Shipping.
              'tax': '0'                     // Tax.
            });

            ga('ecommerce:addItem', {
              'id': '{{$num}}',                     // Transaction ID. Required.
              'name': 'Value Business Plan',    // Product name. Required.
              'sku': 'BP00',                 // SKU/code.
              'category': 'The Business Planners',         // Category or variation.
              'price': '999.99',                 // Unit price.
              'quantity': '1'                   // Quantity.
            });

            ga('ecommerce:send');
        </script>
    @stop
@elseif($prdt == 'standard')
    @section('tagmanager')
        <script>
            ga('require', 'ecommerce');

            ga('ecommerce:addTransaction', {
              'id': '{{$num}}',                     // Transaction ID. Required.
              'affiliation': 'The Business Planners',   // Affiliation or store name.
              'revenue': '1750.00',               // Grand Total.
              'shipping': '0',                  // Shipping.
              'tax': '0'                     // Tax.
            });

            ga('ecommerce:addItem', {
              'id': '{{$num}}',                     // Transaction ID. Required.
              'name': 'Standard Business Plan',    // Product name. Required.
              'sku': 'BP003',                 // SKU/code.
              'category': 'The Business Planners',         // Category or variation.
              'price': '1750.00',                 // Unit price.
              'quantity': '1'                   // Quantity.
            });

            ga('ecommerce:send');
        </script>
    @stop
@elseif($prdt == 'professional')
    @section('tagmanager')
        <script>
            ga('require', 'ecommerce');

            ga('ecommerce:addTransaction', {
              'id': '{{$num}}',                     // Transaction ID. Required.
              'affiliation': 'The Business Planners',   // Affiliation or store name.
              'revenue': '1950.00',               // Grand Total.
              'shipping': '0',                  // Shipping.
              'tax': '0'                     // Tax.
            });

            ga('ecommerce:addItem', {
              'id': '{{$num}}',                     // Transaction ID. Required.
              'name': 'Professional Business Plan',    // Product name. Required.
              'sku': 'BP004',                 // SKU/code.
              'category': 'The Business Planners',         // Category or variation.
              'price': '1950.00',                 // Unit price.
              'quantity': '1'                   // Quantity.
            });

            ga('ecommerce:send');
        </script>
    @stop
@elseif($prdt == 'premium')
    @section('tagmanager')
        <script>
            ga('require', 'ecommerce');

            ga('ecommerce:addTransaction', {
              'id': '{{$num}}',                     // Transaction ID. Required.
              'affiliation': 'The Business Planners',   // Affiliation or store name.
              'revenue': '5000.00',               // Grand Total.
              'shipping': '0',                  // Shipping.
              'tax': '0'                     // Tax.
            });

            ga('ecommerce:addItem', {
              'id': '{{$num}}',                     // Transaction ID. Required.
              'name': 'Premium Professional Business Plan',    // Product name. Required.
              'sku': 'BP005',                 // SKU/code.
              'category': 'The Business Planners',         // Category or variation.
              'price': '5000.00',                 // Unit price.
              'quantity': '1'                   // Quantity.
            });

            ga('ecommerce:send');
        </script>
    @stop
@endif

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
    
    <div class="container">
        <div class="col-xs-12" style="padding: 50px 25px; min-height: 250px;">
            <h3 style="line-height: 35px;">
                
                Thank you for ordering our {{ucwords($prdt)}} package. Kindly check your email for your login details. Check your spam folder if you cannot find the email in your inbox.

            </h3>
        </div>
    </div>
</div>
@stop

