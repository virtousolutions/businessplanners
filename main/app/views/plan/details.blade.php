@section('content')

@include('plan.includes.menu')

<div class="col-md-9 col-sm-8 col-xs-12" style="padding: 0px 30px;">
    <div id="notification" class="col-xs-12" style="margin-bottom: 20px; padding: 0px;">
        @if(Session::get('message'))
            <div class="alert alert-dismissable alert-success" style="font-size: 14px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b>{{ Session::get('message') }}</b>
            </div>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('#notification').fadeOut(10000);
                });
            </script>
        @endif
    </div>
    @include('plan.includes.details-form', $instructions)
</div>

@stop