<?php

class AuthController extends BaseController {

	/**
	 * Account sign in.
	 *
	 * @return View
	 */
	public function login()
	{
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add('auth-login-js', 'assets/javascript/auth/login.js');

		// Show the page
		return View::make('auth.login');
	}

	/**
	 * Account sign in form processing.
	 *
	 * @return Redirect
	 */
	public function loginSubmit()
	{
		// Declare the rules for the form validation
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required|between:3,32',
		);

        $input = Input::all();

		// Create a new validator instance from our validation rules
		$validator = Validator::make($input, $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
		
		$user_id = DB::table('users')->where('email', $input['email'])->pluck('id');
        
        if (!$user_id) {
            $this->message_bag->add('email', 'Incorrect email or password');
        	return Redirect::to('login')->withInput()->withErrors($this->message_bag);
        }

        $user = User::find($user_id);
        
        // check password
        if (! (Hash::check($input['password'], $user->password) || Hash::check($input['password'], $user->getTemporaryPassword()))) {
            $this->message_bag->add('email', 'Incorrect email or password');
        	return Redirect::to('login')->withInput()->withErrors($this->message_bag);
        }

        Auth::login($user);
        
        return Redirect::to('plan/');
	}
    
    public function changeTempPassword()
    {
        $user = Auth::getUser();

        if ($user->password) {
            Redirect::to('');
        }

        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add('auth-change-password-js', 'assets/javascript/auth/change_temp_password.js');

		// Show the page
		return View::make('auth.change-temp-password');
    }

    public function changeTempPasswordSubmit()
    {
        $user = Auth::getUser();

        if ($user->password) {
            Redirect::to('');
        }

        $input = Input::all();

		if ($input['new_password'] != $input['confirm_password']) {
            $this->message_bag->add('new_password', 'Wrong confirm password');
        	return Redirect::back()->withInput()->withErrors($this->message_bag);
        }

        $user = Auth::getUser();
        $user->password = Hash::make($input['new_password']);
        $user->save();

        DB::table('temp_passwords')->where('user_id', $user->id)->delete();

        // remove temporary password

        return Redirect::to('plan')->with('the-message', 'Successfully changed your temporary password');
    }

	/**
	 * Forgot password page.
	 *
	 * @return View
	 */
	public function forgotPassword()
	{
		// Show the page
		return View::make('auth.forgot-password');
	}

	/**
	 * Forgot password form processing page.
	 *
	 * @return Redirect
	 */
	public function forgotPasswordSubmit()
	{
		// Declare the rules for the validator
		$rules = array(
			'email' => 'required|email',
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			// Ooops.. something went wrong
			return Redirect::to('forgot_password')->withInput()->withErrors($validator);
		}

		try {
			// Get the user password recovery code
			$user = Sentry::getUserProvider()->findByLogin(Input::get('email'));

			// Data to be used on the email view
			$data = array(
				'user'              => $user,
				'forgotPasswordUrl' => URL::route('forgot-password-confirm', $user->getResetPasswordCode()),
			);

			// Send the activation code through email
			Mail::queue('emails.forgot-password', $data, function($m) use ($user)
			{
				$m->to($user->email, $user->first_name . ' ' . $user->last_name);
				$m->subject('Account Password Recovery');
			});
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			// Even though the email was not found, we will pretend
			// we have sent the password reset code through email,
			// this is a security measure against hackers.
		}

		//  Redirect to the forgot password
		return Redirect::to('forgot_password')->with('success', 'An email has been sent to recover your password.');
	}

	/**
	 * Forgot Password Confirmation page.
	 *
	 * @param  string  $passwordResetCode
	 * @return View
	 */
	public function getForgotPasswordConfirm($passwordResetCode = null)
	{
		try
		{
			// Find the user using the password reset code
			$user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);
		}
		catch(Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			// Redirect to the forgot password page
			return Redirect::route('forgot-password')->with('error', 'No account was found.');
		}

		// Show the page
		return View::make('frontend.auth.forgot-password-confirm');
	}

	/**
	 * Forgot Password Confirmation form processing page.
	 *
	 * @param  string  $passwordResetCode
	 * @return Redirect
	 */
	public function postForgotPasswordConfirm($passwordResetCode = null)
	{
		// Declare the rules for the form validation
		$rules = array(
			'password'         => 'required',
			'password_confirm' => 'required|same:password'
		);

		// Create a new validator instance from our dynamic rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			// Ooops.. something went wrong
			return Redirect::route('forgot-password-confirm', $passwordResetCode)->withInput()->withErrors($validator);
		}

		try {
			// Find the user using the password reset code
			$user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);

			// Attempt to reset the user password
			if ($user->attemptResetPassword($passwordResetCode, Input::get('password')))
			{
				// Password successfully reseted
				return Redirect::route('signin')->with('success', Lang::get('auth/message.forgot-password-confirm.success'));
			}
			else
			{
				// Ooops.. something went wrong
				return Redirect::route('signin')->with('error', Lang::get('auth/message.forgot-password-confirm.error'));
			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
			// Redirect to the forgot password page
			return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
		}
	}

	/**
	 * Logout page.
	 *
	 * @return Redirect
	 */
	public function logout()
	{
		// Log the user out
		Auth::logout();

		return Redirect::to('/');
	}
}