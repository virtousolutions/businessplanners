<?php

class User extends Eloquent {

	protected $fillable = [
		'first_name',
		'last_name',
		'address_1',
		'address_2',
		'city',
		'state',
		'country',
		'zip',
		'contact_number',
		'email',
        'password',
        'package_id'
	];

	public static $rules = [
		'county'         => 'required',
		'country'        => 'required',
		'zip'            => 'required',
		'contact_number' => 'required',
		'email'          => 'required|email',
	];
}
