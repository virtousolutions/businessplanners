<body>
    <p>
        Dear {{ $params['first_name'] . ' ' . $params['last_name'] }},
    </p>
    <br>
    <br>
    <p>
        Thank you for your purchase. We will be in touch shortly. Here are the details of your payment:
    </p>
    <p>
        Name: {{ $params['first_name'] . ' ' . $params['last_name'] }}
    </p>
    <p>
        Transaction ID: {{ $payment_data['transaction_id'] }}
    </p>
    <p>
        Date: {{ date('d-m-Y', strtotime($payment_data['order_time'])) }}
    </p>
    <p>
        Amount: {{ $payment_data['amount'] }}
    </p>
    <br>
    <!--p>
        If you have any concerns, kindly email us at {{ Config::get('mail.contact_us.address') }}.
    </p-->
    <br>
    <br>
    <p>
        Best wishes,
        <br>
        Yours Slenderly Team
    </p>
</body>
