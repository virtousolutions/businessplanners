<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Payment Gateway
	|--------------------------------------------------------------------------
	|
	*/

	'gateway' => 'PayPal_Express',

	/*
	|--------------------------------------------------------------------------
	| Payment Currency
	|--------------------------------------------------------------------------
	|
	*/

	'currency' => 'GBP',

	/*
	|--------------------------------------------------------------------------
	| App Default Pricing
	|--------------------------------------------------------------------------
	|
	| Amount to charge to user without discount.
	| Please specify amount as a string or float, with decimal places 
	| (e.g. '10.00' to represent $10.00).
	|
	*/

	'pricing' => [1 => 999, 2 => 1750, 3 => 1950],

	/*
	|--------------------------------------------------------------------------
	| Payment Description
	|--------------------------------------------------------------------------
	|
	| This is the text that will appear on the PayPal payment page
	| and will serve as the description of the payment. Useful values
	| would include product name and expiration date
	|
	*/

	/*
	|--------------------------------------------------------------------------
	| PayPal Username
	|--------------------------------------------------------------------------
	|
	*/

	'username' => 'sandbox_dxc_bus_api1.test.com',
    /*'username' => 'payments_api1.practicepro.co.uk',*/

    /*
    |--------------------------------------------------------------------------
    | PayPal Password
    |--------------------------------------------------------------------------
    |
    */

    'password' => '1392007298',
    /*'password' => 'MB4YWQDQ6SQ2X7J4',*/

    /*
    |--------------------------------------------------------------------------
    | PayPal Account Signature
    |--------------------------------------------------------------------------
    |
    | @todo add link for generating signature
    */

    'signature' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAHEN5-o4LIjnhECPR825QdHT95XE',
    /*'signature' => 'AAZrCi1Vx5cadMQKSkY4BOKmx5ZYAR0i4lktii1.u1COTU.3W4OOg0yr',*/

    /*
    |--------------------------------------------------------------------------
    | Payment Environment
    |--------------------------------------------------------------------------
    |
    | Either 'true' or 'false'
    |
    */

    'test_mode' => true
    /*'test_mode' => false*/
);

