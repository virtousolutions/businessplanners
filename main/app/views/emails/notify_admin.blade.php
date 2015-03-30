<body>
    <p>
        Dear Admin,
    </p>
    <br>
    <br>
    <p>
        A new user has purchased a {{ $package_name}} package. Here are the details:
    </p>
    <p>
        Name: {{ $params['first_name'] . ' ' . $params['last_name'] }}
    </p>
    <p>
        Address 1: {{ $params['address_1'] }}
    </p>
    @if (! empty($params['address_2']))
    <p>
        Address 2: {{ $params['address_2'] }}
    </p>
    @endif
    <p>
        Town/City: {{ $params['city'] }}
    </p>
    <p>
        County: {{ $params['state'] }}
    </p>
    <p>
        Country: {{ $params['country_name'] }}
    </p>
    <p>
        Post Code: {{ $params['zip'] }}
    </p>
    <p>
        Email Address: {{ $params['email'] }}
    </p>
    <p>
        Contact Number: {{ $params['contact_number'] }}
    </p>
    <br>
    <p>
        Here are the payment details
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
    <br>
    <p>
        Best wishes
    </p>
</body>
