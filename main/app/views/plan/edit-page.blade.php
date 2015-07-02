@section('content')

<script type="text/javascript">
    var SELECTED_SUB_PAGE = "{{ $section == 'index' ? '' : $section }}";
    var THE_URL = '{{ Config::get("app.url") }}';
</script>

@include('plan.includes.menu')

<?php
    $title = $plan_main_page_id && isset($plan_main_pages[$plan_main_page_id]) ? $plan_main_pages[$plan_main_page_id]->pagetitle : '';
    $sub_pages = $plan_main_page_id && isset($plan_sub_pages[$plan_main_page_id]) ? $plan_sub_pages[$plan_main_page_id] : [];
?>

<div class="col-md-9 col-sm-8 col-xs-12" style="padding: 0px;">
    <div class="col-xs-12 chapter-container">
        <div id="notification" class="col-xs-12" style="margin-bottom: 20px; padding: 0px;">
        @if(Session::get('message'))
            <div class="alert alert-dismissable alert-success" style="font-size: 14px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b>{{ Session::get('message') }}</b>
            </div>
        @endif
        </div>
        <div class="col-xs-12 chapter-main" style="padding: 0px;">
            <legend>{{ $title }}</legend>
            <p>
                <strong>Here's what we will cover in this chapter.</strong> Click any file heading to get started. Certain files may not be relevant to your company, complete only those you feel are necessary to your business plan.
            </p>
            
            <div class="col-xs-12" style="margin: 20px 0; padding: 0;">
                @include('plan.includes.sections', ['sub_pages' => $sub_pages])
            </div>
        </div>
        
        @include('plan.includes.sections-edit')
        
    </div>

    
</div>




@stop