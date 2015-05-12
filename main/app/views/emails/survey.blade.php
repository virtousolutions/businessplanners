<body>
    <p>
        Survey Result
    </p>
    <br>
    <br>
    <p>
        Name: {{ $first_name . ' ' . $last_name }},
    </p>
    <p>
        Email: {{ $email }}
    </p>
    <br>
    <p>
        1. What is your business plan for?
    </p>
    @foreach ($business_plan_purpose as $str)
        <p>
        {{ $str }}
        </p>
    @endforeach
    <br>
    <p>
        2. Would you be interested in a remuneration report? Never assume your accountant knows everything about tax savings, as 98% of the time the accountants get it wrong. A remuneration report allows you to see where you can save money.
    </p>
    <p>
        {{ $remuneration_report }}
    </p>
    <br>
    <p>
        Would you be interested in an IHT report? Having worked hard to generate your wealth, why give it to the Government on your death? We’ll show you how the rich and famous protect their assets to mitigate their IHT.
    </p>
    <p>
    {{ $iht_report }}
    </p>
    <br>
    <br>
</body>
