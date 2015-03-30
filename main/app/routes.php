<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get("/", "HomeController@index");

Route::post("contact_us", array(
	'as' => 'contact_us',
	'uses' => "HomeController@sendContactUs"
));

Route::get("terms", 'HomeController@terms');
Route::get("privacy", 'HomeController@privacy');
/*Route::get("order/{number}", "HomeController@order");
Route::post("order/{number}", "HomeController@orderSubmit");
Route::get('paymentcomplete', 'HomeController@paymentComplete');*/

Route::post('start_payment', 'PaypalPaymentController@startPayment');
Route::get('cancel_payment/{timestamp}', 'PaypalPaymentController@cancelPayment');
Route::get('complete_payment/{timestamp}', 'PaypalPaymentController@completePayment');
Route::get('complete_payment_message', 'PaypalPaymentController@showMessage');