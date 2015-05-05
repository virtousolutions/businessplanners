<?php 

class UserPayment extends Eloquent {

	protected $fillable = [
		'user_id',
		'description',
		'transaction_id',	
		'order_time',
		'amount'
	];

}
