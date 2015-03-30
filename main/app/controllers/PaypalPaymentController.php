<?php

use \Carbon\Carbon;

class PaypalPaymentController extends Controller {

	protected $template = 'layout.payment';
	protected $owner;
	protected $will_type;
	protected $lpa_pa_id;
	protected $lpa_ha_id;
    protected $session_prefix = 'paypal_payment_';

	public function __construct()
	{
        View::share('payment', true);
		
		$this->payment =  new PaymentService();
	}

    protected function saveParams($data) 
	{
		$date      = new DateTime();
		$timestamp = $date->getTimestamp();
		
		Session::put($this->session_prefix . $timestamp, base64_encode(http_build_query($data)));
        Session::save();
		
		return $timestamp;
	}
	
	protected function getParams($timestamp) 
	{
		$params = base64_decode(Session::get($this->session_prefix . $timestamp));
		parse_str($params, $data);
		
		return $data;
	}
	
	protected function forgetParams($timestamp) 
	{
        $params = $this->getParams($timestamp);
        Session::forget($this->session_prefix . $timestamp);

        return $params;
	}

	public function startPayment() 
	{
		try {
			$params        = Input::get();
            $timestamp     = $this->saveParams($params);
            $purchase_data = $this->payment->getPurchaseData($params, $timestamp); 
			$gateway       = $this->payment->getGateway();
			$response      = $gateway->purchase($purchase_data)->send();

			if ($response->isRedirect()) {
				$response->redirect(); 
			} 
			else { 
				throw new Exception($response->getMessage()); 
			}

		} 
		catch (Exception $e) {
			throw $e;
		}
	}

    public function cancelPayment($timestamp)
	{
        $params  = $this->forgetParams($timestamp);
        return Redirect::to($params['cancel_route'])->withInput($params);
    }

	public function completePayment($timestamp)
	{
        $gateway      = $this->payment->getGateway();
        $params       = $this->forgetParams($timestamp);
        $payment_data = [];

        try {
            $purchase_data = $this->payment->getPurchaseData($params, $timestamp); 
			$gateway       = $this->payment->getGateway();
			$response      = $gateway->completePurchase($purchase_data)->send();

			if ($response->isSuccessful()) {
				
				$transaction_data = $response->getData();
                
				$payment_data['amount']         = $transaction_data['PAYMENTINFO_0_AMT'];
				$payment_data['transaction_id'] = $transaction_data['PAYMENTINFO_0_TRANSACTIONID'];
				$payment_data['order_time']     = $transaction_data['PAYMENTINFO_0_ORDERTIME'];
			} 
			else {
				throw new Exception($response->getMessage());
			}
		} 
		catch (Exception $e) {
			throw $e;
		}

        $owner = new Owner();
        $owner = $owner->create($params);

        $pricing = $this->payment->getPricing();
        $package  = $pricing[$params['product_id']];
        
        $payment_data += [ 
            'owner_id'    => $owner->id,
            'description' => $package['description'],
            'product_id'  => $params['product_id']
        ];

        $this->payment->savePayment($payment_data);

        $params['country_name'] = DB::table('countries')->where('id', $params['country'])->pluck('country_name');
        
        $blade_data = [
            'params'       => $params,
            'payment_data' => $payment_data,
            'package_name' => $package['description']
        ];

        // send an email to admin
        Mail::send('emails.notify_admin', (array)$blade_data, function($message) use ($params)
        {
            $from = Config::get('mail.from');
            $to   = Config::get('mail.purchase_info');

            $message->from($from['address'], $from['name']);
            $message->to($to['address']);
            $message->bcc('markjoymacaso@gmail.com');
            $message->subject('Yours Slenderly Package Purhase');
        });

        // send an email to the user
        Mail::send('emails.notify_user', (array)$blade_data, function($message) use ($params)
        {
            $from = Config::get('mail.from');
            
            $message->from($from['address'], $from['name']);
            $message->to($params['email']);
            $message->bcc('markjoymacaso@gmail.com');
            $message->subject('Yours Slenderly Package Purhase');
        });
        
        return Redirect::to($params['complete_route']);
	}
}

    