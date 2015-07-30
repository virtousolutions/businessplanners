@extends('app')

<!-- Page title and meta description -->

@section('title')
{{Lang::get('pagedetails.packages.premium.title')}}
@stop

@section('description')
{{Lang::get('pagedetails.packages.premium.description')}}
@stop

<!-- EOF of page title and meta description -->

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 45px;">
    <h2>Get your business in front of at least 10 Angel investors with the Entrepreneur business plan package</h2>
    
    <div style="margin-top: 20px;">
        <p>Securing that all important funding can be difficult. A clear and detailed business plan can make all the different in impressing investors and getting the capital you need. With the Entrepreneur package, you'll receive a professionally written business plan, which will then be put in front of at least 10 Angel investors, to help you improve your chances of getting the funding you need.</p>
        <br>
        <p><strong>Benefits of the premium business plan package:</strong></p>
        <ul style="margin-left: 45px;">
            <li>A professionally written business plan that will clearly define your goals and objectives</li>
            <li>Have your business plan shown to at least 10 Angel investors, helping you to improve your chances of securing investment</li>
            <li>A dedicated business accounts manager to help you if you have any questions or queries</li>
        </ul>
        <br>
        <p><strong>With the Entrepreneur business plan package, you receive:</strong></p>
        <ul style="margin-left: 45px;">
            <li>A professionally written business plan</li>
            <li>A dedicated accounts manager</li>
            <li>A dedicated researcher</li>
            <li>3 years of financial forecasting by a professionally qualified financial accountant</li>
            <li>Investor meeting where your business plan is shown to at least 10 Angel investors</li>
            <li>6 months access to our award-winning, in-house business planning platform</li>
            <li>Access to all our fantastic bonus materials</li>
            <li>Great discounts on our other fantastic business services</li>
        </ul>
        <br>
        <p>The Entrepreneur package, at just &pound;5000 is the perfect solution for those who want to plan out their goals with a professionally written business plan, and who want to increase their chances of securing investment. 
        </p>
        <div style="margin-top: 30px;">
            <a href="{{ url('order/premium') }}"><img class="buynow-btn" src="{{ url('assets/img/buynow.png') }}" style="width: 175px;"></a>
        </div>
    </div>
</div>
@stop