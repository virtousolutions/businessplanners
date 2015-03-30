<body>
    <p>
        Dear Admin,
    </p>
    <br>
    <br>
    <p>
        {{ $the_message }}
    </p>
    @if (isset($phone))
    <br>
    <p>
        Phone number: {{ $phone }}
    </p>
    @endif
    <br>
    <br>
    <p>
        Best wishes
        <br>
        {{ $name }}
    </p>
</body>
