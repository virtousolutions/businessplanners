@extends('app')

@section('content')
<div class="container">
     <div class="col-md-10 col-md-offset-1 col-xs-12 tac-contents">
        <div class="col-xs-12 tac-title" style="text-align: left; font-size: 18px; margin-bottom: 30px;">
            @if ($package == 'diy')
            It would be great if you could fill in the three questions below for us, so we can find out a bit more about you and your needs
            @else
            Before we get started, we need you to answer a couple of questions for us so we can write the perfect business plan for you.
            @endif
        </div>
        {{ Form::open(array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'survey-form')) }}
        <div class="form-group">
            <div class="col-xs-12">
                <label class="col-sm-2" style="padding-left: 0px;">
                   Full Name
                </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{ $full_name }}" name="full_name"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label class="col-sm-2" style="padding-left: 0px;">
                   Email Address
                </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{ $email_address }}" name="email_address"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label class="col-sm-2" style="padding-left: 0px;">
                   Contact Number
                </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{ $contact_number }}" name="contact_number"/>
                </div>
            </div>
        </div>
        <div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
            <div class="section-number">1.</div><div class="section-title">What is your business plan for? (select all that apply) </div>
            <div class="section-content">
                <div class="form-group">
                    <div class="checkbox col-xs-12">
                        <label>
                            <input type="checkbox" name="business_plan_purpose[]" value="Selling my business">Selling my business
                        </label>
                    </div>
                    <div class="checkbox col-xs-12">
                        <label>
                            <input type="checkbox" name="business_plan_purpose[]" value="Borrowing money and raising finances">Borrowing money and raising finances
                        </label>
                    </div>
                    <div class="checkbox col-xs-12">
                        <label>
                            <input type="checkbox" name="business_plan_purpose[]" value="Venture capital/angel investment">Venture capital/angel investment
                        </label>
                    </div>
                    <div class="checkbox col-xs-12">
                        <label>
                            <input type="checkbox" name="business_plan_purpose[]" value="Business planning">Business planning
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
            <div class="section-number">2.</div><div class="section-title">Would you be interested in a remuneration report? Never assume your accountant knows everything about tax savings, as 98% of the time the accountants get it wrong. A remuneration report allows you to see where you can save money.</div>
            <div class="section-content">
                <div class="form-group">
                    <div class="checkbox col-xs-12">
                        <label>
                            <input type="radio" name="remuneration_report" value="Yes" style="margin-right: 10px;">Yes
                        </label>
                    </div>
                    <div class="checkbox col-xs-12">
                        <label>
                            <input type="radio" name="remuneration_report" value="No" style="margin-right: 10px;">No
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
            <div class="section-number">3.</div><div class="section-title">Would you be interested in an IHT report? Having worked hard to generate your wealth, why give it to the Government on your death? We'll show you how the rich and famous protect their assets to mitigate their IHT. </div>
            <div class="section-content">
                <div class="form-group">
                    <div class="checkbox col-xs-12">
                        <label>
                            <input type="radio" name="iht_report" value="Yes" style="margin-right: 10px;">Yes
                        </label>
                    </div>
                    <div class="checkbox col-xs-12">
                        <label>
                            <input type="radio" name="iht_report" value="No" style="margin-right: 10px;">No
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12" style="padding: 0px; margin-top: 20px;">
            <button class="btn btn-primary btn-lg" type="submit">Submit</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@stop