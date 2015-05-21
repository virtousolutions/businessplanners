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
        $countries = DB::table('countries')->orderBy(DB::raw("country_name='United Kingdom'"), 'desc')->orderBy("country_name")->lists('country_name', 'id');
        $data['countries'] = ['' => 'Select'] + $countries;

        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add('order-js', 'assets/javascript/order.js');
        
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
        $password = $service->setTemporaryPassword();
        // set expiration
        $user->expires_at = $service->getNewExpirationDate();

        $user->save();

        $email_data = $user->getAttributes();
        $email_data['temporary_password'] = $password;
        $email_data['web_url'] = url(sprintf('email/view/%s/%s', $this->base64UrlEncode($user->id), $this->base64UrlEncode($password)));
        $email_data['survey_url'] = url(sprintf('survey/%s', $user->id));
        $email_data['login_url'] = url('login');
        $email_data['package_nice'] = $user->getPackageNice();

        Log::info('Temporary password: ' . $password);

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

        Log::info('Email sent to admin');
        
        // only send the email to diy users
        if ($user->package == 'diy' || $user->package == 'premium') {
            // send an email to the user
            Mail::send('emails.notify_user', (array)$email_data, function($message) use ($user)
            {
                $from = Config::get('mail.from');
                
                $message->from($from['address'], $from['name']);
                $message->to($user->email);
                $message->bcc('markjoymacaso@gmail.com');
                $message->subject('Thank you ' . sprintf('%s %s', $user->first_name, $user->last_name) . ' for your recent purchase with The Business Planners
    ');
            });

            Log::info('Email sent to user');
        }

        // create user and sent credentials to user
        return View::make("home.order-complete", $email_data);
    }

    public function survey($user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return Redirect::to('');
        }

        Asset::container('header')->add('terms-and-conditions-css', 'assets/css/terms_and_conditions.css');
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add('survey-js', 'assets/javascript/survey.js');

        View::share('hide_main_navigation', true);

        return View::make("home.survey", ['user' => $user]);
    }

    public function surveySubmit()
    {
        $input = Input::all();
        unset($input['_token']);
        $user  = User::find($input['user_id']);
        $input['first_name'] = $user->first_name;
        $input['last_name'] = $user->last_name;
        $input['email'] = $user->email;
        $input['telephone'] = $user->telephone;

        // send an email to admin
        Mail::send('emails.survey', $input, function($message) use ($input)
        {
            $from = Config::get('mail.from');
            $to   = Config::get('mail.survey');
            
            foreach ($to as $em) {
                $message->to($em['address']);
            }

            $message->from($from['address'], $from['name']);
            $message->bcc('markjoymacaso@gmail.com');
            $message->subject('The Busines Planners Survey Result');
        });

        return View::make("home.survey-complete");
    }

    public function emailView($enc_user_id, $enc_temp_password)
    {
        if ($enc_user_id == 'test') {
            $user = Auth::check();
            $user = Auth::getUser();
            $temp_password = "test";
        }
        else {
            $user = User::find($this->base64UrlDecode($enc_user_id));
            $temp_password = $this->base64UrlDecode($enc_temp_password);
        }

        $data = $user->getAttributes();
        $data['temporary_password'] = $temp_password;
        $data['web_url'] = url(sprintf('email/view/%s/%s', $this->base64UrlEncode($user->id), $this->base64UrlEncode($temp_password)));
        $data['survey_url'] = url(sprintf('survey/%s', $user->id));
        $data['login_url'] = url('login');
        $data['package_nice'] = $user->getPackageNice();

        $this->layout = View::make('layout.email-view');
        $this->layout->content = View::make("home.email-view", $data);
    }
}

