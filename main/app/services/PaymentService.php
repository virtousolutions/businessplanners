<?php

use \Omnipay\Common\GatewayFactory;
use \Carbon\Carbon;

class PaymentService {

	protected $config;

	public function __construct()
	{
		$this->config = Config::get('paypal');
	}

	public function getConfig()
	{
		return $this->config;
	}

	public function getPricing()
	{
		return $this->config['pricing'];
	}

	public function getGateway()
	{
		$gateway = new GatewayFactory();
		$gateway = $gateway->create($this->config['gateway']);

		$gateway->setUsername($this->config['username']);
		$gateway->setPassword($this->config['password']); 
		$gateway->setSignature($this->config['signature']);
		$gateway->setTestMode($this->config['test_mode']);

		return $gateway;
	}

	public function getPurchaseData($params, $timestamp)
	{
		$now = Carbon::now();
        
        $paypal_data = array(
			'amount'      => (float) $params['amount'],
			'description' => $params['description'],
			'returnUrl'   => url('complete_payment', $timestamp),
			'cancelUrl'   => url('cancel_payment', $timestamp),
			'currency'    => $this->config['currency'],
		);

		return $paypal_data;
	}

    public function savePayment($payment_data)
    {
        $payment = new UserPayment();
        $payment->fill($payment_data);
        $payment->save();
    }
}
