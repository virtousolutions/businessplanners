@section('content')
<div class="col-xs-12" style="padding: 0px; margin-top: 30px;">
    <!--Star Left panel-->
    <div class="col-sm-3 col-xs-12">
        <p class="intro-text">To start a new business plan, just provide the details requested below. We will use this information to suggest which sections to include in your plan outline.</p>
        <p class="intro-text">Not sure which options to choose?<br><a href="{{ url('') . '/#contact' }}" target="_blank">Get help here</a></p>
        <div class="optional-container" style="display: none;">
            <a class="optional-toggle" href="javascript:void(0);">
                <h3>Optional Settings</h3>
                <h4>Adjust language, date format, financial details, and other plan settings.</h4>
                <span>Show Optional Settings</span>
            </a>
            <div class="optional" style="display: none;">
                <h3>Optional Settings Coming Soon!</h3>
                <span class="clear"></span>
            </div>
            <span class="clear"></span>
        </div>
    </div>
            
    <div class="col-sm-9 col-xs-12">
        @include('plan.includes.details-form')
    </div>
</div>
@stop