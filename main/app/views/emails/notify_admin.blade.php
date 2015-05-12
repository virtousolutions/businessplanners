<body>
    <p>
        Dear Admin,
    </p>
    <br>
    <p>
        {{ $first_name . ' ' . $last_name }} has purchased a {{ ($package_nice) }} package.
    </p>
    <br>
    <p>
        Here are the login details: <br/>
        Email: {{ $email }} <br/>
        Password: {{ $temporary_password }} <br/>
        This is a temporary password, after logging in, you will be asked to change it.
    </p>
    <br>
    <p>
        Best wishes
    </p>
</body>
