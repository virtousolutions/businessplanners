<body>
    <p>
    {{ 'Hi, ' . sprintf("%s %s", $user->first_name, $user->last_name) }},
    </p>
    <br>
    <p>
        Click <a href="{{ url('password/reset/'.$token) }}">here</a> to reset your password.
    </p>
    <br>
    
</body>
