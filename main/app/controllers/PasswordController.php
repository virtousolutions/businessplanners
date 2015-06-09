<?php

use Illuminate\Auth\Reminders\PasswordBroker;

class PasswordController extends BaseController {
     public function remind()
    {
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add('auth-login-js', 'assets/javascript/password/reset.js');

        return View::make('password.remind');
    }

    public function request()
    {
        $credentials = array('email' => Input::get('email'));
        $result = Password::remind($credentials);

        if ($result == PasswordBroker::REMINDER_SENT) {
            return Redirect::to('password/reset')->with('success', 'Success');
        }
        else if ($result == PasswordBroker::INVALID_USER) {
            return Redirect::to('password/reset')->withError('Invalid email address');
        }
    }

    public function reset($token)
    {
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add('auth-login-js', 'assets/javascript/password/update.js');

        return View::make('password.reset')->with('token', $token);
    }

    public function update($token)
    {
        $credentials = array(
            'email' => Input::get('email'), 
            'password' => Input::get('password'), 
            'password_confirmation' => Input::get('password_confirmation'),
            'token' => $token
        );
     
        $result = Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);
            $user->save();
        });

        if ($result == PasswordBroker::PASSWORD_RESET) {
            Asset::container('footer')->add('upate-complete-js', 'assets/javascript/password/update-complete.js');

            return View::make('password.update-complete');
        }

        if ($result == PasswordBroker::INVALID_TOKEN) {
            return Redirect::to('password/reset/' . $token)->withError('Invalid token');
        }
        
        if ($result == PasswordBroker::INVALID_USER) {
            return Redirect::to('password/reset/' . $token)->withError('Invalid email address');
        }
    }
}