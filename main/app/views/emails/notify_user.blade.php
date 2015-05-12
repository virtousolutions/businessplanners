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
        Password: {{ $temporary_password }}
    </p>
    <p>
    This is a temporary password, so after logging in, you will be asked to change your password.
    </p>
    <br>
    <p>
        But before you get started, please answer the survey so we can write the correct business plan for you. Click on the link to open the survey: {{ url('survey/' . $id) }}
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
        The Business Planners Team
    </p>
</body>
