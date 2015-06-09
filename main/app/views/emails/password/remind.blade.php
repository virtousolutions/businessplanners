<body>
    <p>
    {{ 'Hi, ' . sprintf("%s %s", $user->first_name, $user->last_name) }},
    </p>
    <br>
    <p>
        To reset your password, open the following link: {{ url('password/reset/'.$token) }}
    </p>
    <br>
    
</body>
