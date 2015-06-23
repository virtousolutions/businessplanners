@extends('app')

<!-- Page title and meta description -->

@section('title')
{{Lang::get('pagedetails.packages.professional.title')}}
@stop

@section('description')
{{Lang::get('pagedetails.packages.professional.description')}}
@stop

<!-- EOF of page title and meta description -->

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 45px;">
    <h2>Raise finances and venture capital with a professionally written business plan</h2>
    
    <div style="margin-top: 20px;">
        <p>When looking to raise finances, a well-written business plan can be the difference between securing the funding or not. Potential investors will want to see your business plan in order to make their decision, and having a poorly written, non detailed business plan, or not even one at all, could mean missing out on that all-important investment. </p>
        <br>
        <p><strong>Benefits of the Professional business plan package:</strong></p>
        <ul style="margin-left: 45px;">
            <li>Your professionally written business plan will help to secure funding, as it clearly outlines your goals and objectives</li>
            <li>3 years of financial forecasting to help raise venture capital</li>
            <li>Dedicated account manager to help should you have any questions or queries</li>
        </ul>
        <br>
        <p><strong>With the professional business plan package, you receive:</strong></p>
        <ul style="margin-left: 45px;">
            <li>A full, professionally written business plan</li>
            <li>Your own dedicated accounts manager</li>
            <li>Your own dedicated researcher</li>
            <li>3 years of financial forecasting, by a professionally qualified financial accountant</li>
            <li>3 months access to our award-winning in-house business planning platform</li>
            <li>Access to our fantastic bonus materials</li>
            <li>Discounts on our other great business services, that will help you with your business</li>
        </ul>
        <br>
        <p>At just &pound;1,950, you receive a clear, concise business plan and so much more, that will really help your business succeed and get the capital it needs
        </p>
        <div style="margin-top: 30px;">
            <a href="{{ url('order/professional') }}"><img class="buynow-btn" src="{{ url('assets/img/buynow.png') }}" style="width: 175px;"></a>
        </div>
    </div>
</div>
@stop