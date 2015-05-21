@section('content')
    @if ($package == 'diy')
        @include('emails.notify_user');
    @elseif ($package == 'premium')
        @include('emails.notify_user_premium');
    @endif
@stop