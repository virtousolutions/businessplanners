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
        
        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add("index-js", "assets/javascript/index.js");

        $this->layout->content = View::make("home.index", ['features' => $this->getFeatures(), 'packages' => $this->getPackage()]);
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

    public function license()
    {
        Asset::container('header')->add('terms-and-conditions-css', 'assets/css/terms_and_conditions.css');

        $this->layout = View::make('layout.other');
        $this->layout->content = View::make("home.license");
    }

    public function order($number)
    {
        $data = Input::old();
        $countries = DB::table('countries')->orderBy('country_name')->lists('country_name', 'id');
        $data['countries'] = ['' => 'Select'] + $countries;

        $package = $this->getPackage($number);

        $data['package'] = $package;
        $data['features'] = $this->getFeatures();
        $data['show_button'] = false;

        Asset::container('footer')->add('bootstrap-validator-js', 'assets/plugins/bootstrap_validator/js/bootstrapValidator.js');
        Asset::container('footer')->add('wills-js', 'assets/javascript/package.js');

        $this->layout = View::make('layout.other');
        $this->layout->content = View::make("home.order", $data);
    }

    public function orderSubmit($number)
    {
        $package        = $this->getPackage($number);
        $data           = Input::get();
        $amount         = $package['price'];
        $cancel_route   = 'order/' . $number;
        $complete_route = '';

        unset($data['_token']);
        
        $data['package_number'] = $number;
        $data['product_id'] = $number;
        $data['description']    = 'Payment for ' . $package['name'] . ' package';
        $data['amount']         = $amount;
        $data['cancel_route']   = $cancel_route;
        $data['complete_route'] = $complete_route;

        /*echo '<pre>';
        var_dump($data);
        die;
        echo '</pre>';

        die;*/

        return Redirect::to('start_payment')->withInput($data);
    }

    public function paymentComplete()
    {
        Asset::container('footer')->add("order-complete-js", "assets/javascript/order-complete.js");

        $old_data = Input::old();

        $package = $this->getPackage(isset($old_data['package_number']) ? $old_data['package_number'] : 1);

        $old_data['affiliation'] = 'The Business Planners';
        $old_data['product_name'] = $package['name'];
        $old_data['product_price'] = $package['price'];
        $old_data['product_brand'] = 'The Business Planners';
        $old_data['product_category'] = 'Service';
        $old_data['product_variant'] = $package['name'];
        $old_data['product_quantity'] = 1;

        $this->layout = View::make('layout.other');
        $this->layout->content = View::make("home.payment-complete", ['old_data' => $old_data]);
    }
}
