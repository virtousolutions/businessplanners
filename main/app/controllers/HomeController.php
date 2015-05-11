<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function index()
    {
        // $this->layout = View::make('layout.index');
        
        // Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        // Asset::container('footer')->add("index-js", "assets/javascript/index.js");

        // $this->layout->content = View::make("home.index", ['features' => $this->getFeatures(), 'packages' => $this->getPackage()]);
        
        return View::make('home.home');
    }

	public function sendContactUs() 
    {
        $input = Input::get();

        $input['the_message'] = $input['message'];

        Mail::send('emails.contact_us', (array)$input, function($message) use ($input)
        {
            $to = Config::get('mail.contact_us');

            $message->from($input['email'], $input['name']);
            $message->to($to['address']);
            $message->bcc('markjoymacaso@gmail.com');
            $message->subject('Yours Slenderly Concern');
        });

        echo json_encode(['type' => 'success', 'text' => "Thank you for contacting us. We'll be in touch shortly."]);
        exit;
    }

    public function contactus()
    {
        $input = Input::get();
        
        $input['the_message'] = $input['message'];
        #print_r($input);

       Mail::send('emails.contact_us', (array)$input, function($message) use ($input)
        {
            $to = Config::get('mail.contact_us');

            $message->from($input['email'], $input['name']);
            $message->to($to['address']);
            $message->bcc('markjoymacaso@gmail.com');
            $message->subject('Yours Slenderly Concern');
        });

       echo json_encode(['type' => 'success', 'text' => "Thank you for contacting us. We'll be in touch shortly."]);

        exit();
    }

    public function terms()
    {
        Asset::container('header')->add('terms-and-conditions-css', 'assets/css/terms_and_conditions.css');

        return View::make("home.terms");
    }

    public function privacy()
    {
        Asset::container('header')->add('terms-and-conditions-css', 'assets/css/terms_and_conditions.css');

        return View::make("home.privacy");
       
    }

    public function license()
    {
        Asset::container('header')->add('terms-and-conditions-css', 'assets/css/terms_and_conditions.css');

        return View::make("home.license");
    }

    public function order($package)
    {
        $data = Input::old();
        $countries = DB::table('countries')->orderBy('country_name')->lists('country_name', 'id');
        $data['countries'] = ['' => 'Select'] + $countries;

        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add('wills-js', 'assets/javascript/package.js');
        
        return View::make("home.order", $data);
    }

    public function orderSubmit($package)
    {
        $data           = Input::get();
        unset($data['_token']);
        unset($data['terms_and_conditions']);

        // check if email already exist.
        $user_id = DB::table('users')->where('email', $data['email'])->pluck('id');
        
        if ($user_id) {
            $this->message_bag->add('email', 'An account associated to the email address already exist');
        	return Redirect::to('order/' . $package)->withInput()->withErrors($this->message_bag);
        }

        /*echo '<pre>';
        var_dump($data);
        die;
        echo '</pre>';

        die;*/
        
        Session::put('order_data', base64_encode(http_build_query($data)));
        
        // TODO: redirect to the order form
        // For now, redirect to the payment complete first
        return Redirect::to('order-complete/' . $package);
    }

    public function orderComplete($package)
    {
        $str = base64_decode(Session::get('order_data'));
        
        if (! $str) {
            return Redirect::to('/');
        }

        // forget data so that it will not be reused
        Session::forget('order_data');

        parse_str($str, $data);

        $data['package'] = $package;

        /*echo '<pre>';
        var_dump($data);
        die;
        echo '</pre>';

        die;*/

        $user = new User();
        $user = $user->create($data);

        $service = new UserService($user);

        // create temporary password
        $service->setTemporaryPassword();
        // set expiration
        $user->expires_at = $service->getNewExpirationDate();

        $user->save();

        $email_data = $user->getAttributes();
        $email_data['valid_password'] = $user->getValidPassword();

        // send an email to admin
        Mail::send('emails.notify_admin', $email_data, function($message) use ($user)
        {
            $from = Config::get('mail.from');
            $to   = Config::get('mail.purchase_info');

            $message->from($from['address'], $from['name']);
            $message->to($to['address']);
            $message->bcc('markjoymacaso@gmail.com');
            $message->subject('The Busines Planners Package Purhase');
        });

        // send an email to the user
        Mail::send('emails.notify_user', (array)$email_data, function($message) use ($user)
        {
            $from = Config::get('mail.from');
            
            $message->from($from['address'], $from['name']);
            $message->to($user->email);
            $message->bcc('markjoymacaso@gmail.com');
            $message->subject('The Business Planners Package Purhase');
        });

        // create user and sent credentials to user
        return View::make("home.order-complete", $email_data);
    }
}
