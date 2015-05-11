<?php

class UserService {
    protected $user = null;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function setTemporaryPassword()
    {
        $password = $this->generateRandomString();
        
        DB::table('temp_passwords')->insert(
            array('user_id' => $this->user->id, 'password' => Hash::make($password))
        );

        return $password;
    }

    public function getNewExpirationDate()
    {
        if ($this->user->expires_at) {
            $start = $this->user->expires_at;
        }
        else {
            $start = $this->user->created_at->timestamp;
        }

        $expiration = [
            'diy' => 30,
            'value' => 30,
            'standard' => 90,
            'professional' => 90,
            'premium' => 365
        ];

        $expires = date('Y-m-d', strtotime(date('Y-m-d', $start) . " +" . $expiration[$this->user->package] . "days"));
        
        return $expires;
    }

    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $chars_length = strlen($characters);
        $str = '';

        for ($i = 0; $i < $length; $i++) {
            $str .= $characters[rand(0, $chars_length - 1)];
        }

        return $str;
    }
}
