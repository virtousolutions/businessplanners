<div class="price-box col-xs-12">
    <div class="header">
        <div class="star">{{ $package['name'] }}</div>
        <div class="price">&pound;{{ number_format($package['price']) }}</div>
    </div>

    <ul class="list-unstyled" style="float: left;">
        @foreach ($features as $index => $text)
        <li>
            <img src="{{ (in_array($index, $package['features']) ? asset('assets/img/tick.png') : asset('assets/img/cross.png')) }}" align="right"/>
            <p>{{ $text }}</p>
        </li>
        @endforeach
    </ul>
    @if ($show_button == true)
    <a href="order/{{ $package['id'] }}" class="packages-btn">Buy now</a>
    @endif
</div>