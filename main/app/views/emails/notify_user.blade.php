<body>
    <p>
        {{ $first_name . ' ' . $last_name }},
    </p>
    <br>
    <br>
    <p>
        Thank you for for ordering our {{ ucwords($package) }} package. You may now log in to {{ url('login') }} using the following email and password:
    </p>
    <p>
        Email: {{ $email }}
    </p>
    <p>
        Password: {{ $valid_password }}
    </p>
    <br>
    <p>
        If you have any concerns, kindly email us at {{ Config::get('mail.contact_us.address') }}.
    </p>
    <br>
    <br>
    <p>
        Best wishes,
        <br>
        The CREATE MY CV Team
    </p>
</body>
