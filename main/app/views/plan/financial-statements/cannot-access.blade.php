@section('content')

<div class="col-xs-12" style="margin: 30px 0;">
    You need to complete the Financial Plan Section before you can view the financial statements. Click <a href="{{ url('plan/financial-plan/index/' . $business_plan->id) }}">here</a> to go to the Financial Plan Section.
</div>

@stop