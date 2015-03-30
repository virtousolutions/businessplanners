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
        $this->layout = View::make('layout.index');

        Asset::container('footer')->add("index-js", "assets/js/index.js");
        $this->layout->content = View::make("home.index");
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

    public function terms()
    {
        Asset::container('header')->add('terms-and-conditions-css', 'assets/css/terms_and_conditions.css');

        $this->layout = View::make('layout.other');
        $this->layout->content = View::make("home.terms");
    }

    public function privacy()
    {
        Asset::container('header')->add('terms-and-conditions-css', 'assets/css/terms_and_conditions.css');

        $this->layout = View::make('layout.other');
        $this->layout->content = View::make("home.privacy");
    }
}
