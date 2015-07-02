<body>
    <p>
        Survey Result
    </p>
    <br>
    <p>
        Name: {{ $full_name }} <br/>
        Email: {{ $email_address }} <br/>
        Telephone: {{ $contact_number }}
    </p>
    <p>
        1. What is your business plan for?
    </p>
    <p>
    @foreach ($business_plan_purpose as $str)
        {{ $str }} <br/>
    @endforeach
    </p>
    <p>
        2. Would you be interested in a remuneration report? Never assume your accountant knows everything about tax savings, as 98% of the time the accountants get it wrong. A remuneration report allows you to see where you can save money.
        <br/>
        {{ $remuneration_report }}
    </p>
    <p>
        Would you be interested in an IHT report? Having worked hard to generate your wealth, why give it to the Government on your death? We’ll show you how the rich and famous protect their assets to mitigate their IHT.
        <br/>
        {{ $iht_report }}
    </p>
    <br>
</body>
