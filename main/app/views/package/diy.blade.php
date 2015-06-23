@extends('app')

<!-- Page title and meta description -->

@section('title')
{{Lang::get('pagedetails.packages.diy.title')}}
@stop

@section('description')
{{Lang::get('pagedetails.packages.diy.description')}}
@stop

<!-- EOF of page title and meta description -->

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 45px;">
    <h2>Write your own business plan with our award-winning business planning platform</h2>
    
    <div style="margin-top: 20px;">
        <p>Creating a business plan is so important for every business - it enables you to plan out your entire business and strategy, allowing you to see potential problems and keeping you on track. However, it can be a daunting process.</p>

        <p>That's why with our DIY business plan, creating your own business plan has never been easier. Our award-winning business-planning platform will guide you through everything that you need to include, explaining each section and helping you along the way. Writing your own business plan has never been easier.</p>
        <br>
        <p><strong>Benefits of the DIY business plan package:</strong></p>
        <ul style="margin-left: 45px;">
            <li>Access to our award winning business plan writing platform</li>
            <li>Step by step guidance on what to include in your business plan</li>
            <li>Have your business plan reviewed by a professional business plan writer and researcher once you're done</li>
        </ul>
        <br>
        <p><strong>With the DIY business plan package, you receive:</strong></p>
        <ul style="margin-left: 45px;">
            <li>Access to our award winning, in-house business planning platform</li>
            <li>A business plan review by a professional business plan writer</li>
            <li>Dedicated business account manager</li>
            <li>Dedicated researcher</li>
            <li>Access to our great bonus materials</li>
            <li>1 month access to our business planning platform </li>
        </ul>
        <br>
        <p>For just &pound;199, the DIY business plan package is fantastic for those on a budget who wish to create their own business plan, but need a bit of guidance along the way.
        </p>
        <div style="margin-top: 30px;">
            <a href="{{ url('order/diy') }}"><img class="buynow-btn" src="{{ url('assets/img/buynow.png') }}" style="width: 175px;"></a>
        </div>
    </div>
</div>
@stop