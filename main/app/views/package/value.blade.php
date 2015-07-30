@extends('app')

<!-- Page title and meta description -->

@section('title')
{{Lang::get('pagedetails.packages.value.title')}}
@stop

@section('description')
{{Lang::get('pagedetails.packages.value.description')}}
@stop

<!-- EOF of page title and meta description -->

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 45px;">
    <h2>Get a better understanding of your business goals with our Standard business plan package</h2>
    
    <div style="margin-top: 20px;">
        <p>It can be a difficult and daunting process writing your own business plan, but that's why The Business Planners are here to help. Our professional business plan writing service enables us to help you to create your own professional business plan, that will help you to better understand your goals and objectives, and get a clear understanding of the way your business is heading.</p>

        <p>You'll have a professional business plan writer working on your business plan, to provide you with a clear and concise business plan.</p>
        <br>
        <p><strong>Benefits of the Standard business plan package:</strong></p>
        <ul style="margin-left: 45px;">
            <li>Clear and concise business plan by a professional business plan writer, that will map out our goals and give you a clearer overview of what you want to achieve</li>
            <li>Dedicated business account manager to help you throughout the process, available for any questions or queries you might have</li>
            <li>A dedicated researcher that will research into your business and industry to help create an exceptionally detailed business plan</li>
        </ul>
        <br>
        <p><strong>With the Standard business plan package, you receive:</strong></p>
        <ul style="margin-left: 45px;">
            <li>Dedicated business account manager</li>
            <li>A professionally written business plan</li>
            <li>Dedicated researcher</li>
            <li>1 month access to our business planning platform</li>
            <li>Access to some of our fantastic bonus materials</li>
            <li>Discounts on our great business services, that will help you with your business</li>
        </ul>
        <br>
        <p>Our Standard business plan package is really perfect if you don't have time to write your own business plan, and for just &pound;999 you'll be able to get a clearer outlook on your business. 
        </p>
        <div style="margin-top: 30px;">
            <a href="{{ url('order/value') }}"><img class="buynow-btn" src="{{ url('assets/img/buynow.png') }}" style="width: 175px;"></a>
        </div>
    </div>
</div>
@stop