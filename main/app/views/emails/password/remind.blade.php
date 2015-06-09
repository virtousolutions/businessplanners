<body>
    <p>
    {{ 'Hi, ' . sprintf("%s %s", $user->first_name, $user->last_name) }},
    </p>
    <br>
    <p>
        Click here to reset your password: {{ url('password/reset/'.$token) }}
    </p>
    <br>
    
</body>
