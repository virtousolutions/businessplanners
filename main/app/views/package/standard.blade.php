@extends('app')

<!-- Page title and meta description -->

@section('title')
{{Lang::get('pagedetails.packages.standard.title')}}
@stop

@section('description')
{{Lang::get('pagedetails.packages.standard.description')}}
@stop

<!-- EOF of page title and meta description -->

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 45px;">
    <h2>Get a professionally written business plan and financial forecasting with the Professional business plan package</h2>
    
    <div style="margin-top: 20px;">
        <p>If you're an established business, it's still not too late to create a business plan - it's not just useful for start-ups. A business plan will enable you to keep a clear focus on the direction you want to head in, and will also help you to see any possible problems with your business, before they become an issue. </p>
        <br>
        <p><strong>Benefits of the Professional business plan package:</strong></p>
        <ul style="margin-left: 45px;">
            <li>A full, professionally written business plan</li>
            <li>A dedicated accounts manager to help you throughout the process</li>
            <li>Receive 1 year financial forecasting, to help you to get your finances in order</li>
        </ul>
        <br>
        <p><strong>With the Professional business plan package, you receive:</strong></p>
        <ul style="margin-left: 45px;">
            <li>A professionally written business plan</li>
            <li>A dedicated accounts manager</li>
            <li>A dedicated researcher</li>
            <li>1 year financial forecasting</li>
            <li>1 month access to our business planning platform</li>
            <li>Access to some of our fantastic bonus materials</li>
            <li>Discounts on our other great business services, that will help you with your business</li>
        </ul>
        <br>
        <p>Our standard package is perfect for those who have been in business for a while, and for just &pound;1,750 it's a fantastic price too.
        </p>
        <div style="margin-top: 30px;">
            <a href="{{ url('order/standard') }}"><img class="buynow-btn" src="{{ url('assets/img/buynow.png') }}" style="width: 175px;"></a>
        </div>
    </div>
</div>
@stop