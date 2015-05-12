<?php

class BaseController extends Controller {

	/**
	 * Initializer.
	 *
	 */
	public function __construct()
	{
		$this->view = App::make('view');
		$this->request = App::make('request');
		$this->session = App::make('session');
		$this->redirect = App::make('redirect');
		$this->validator = App::make('validator');
		$this->message_bag = new Illuminate\Support\MessageBag;

		// @todo: move this to config, start or global
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! isset($this->template)) 	{
			//$this->template = 'layout.home'; 
		}
	}

    protected function base64UrlEncode($input) {
        return strtr(base64_encode($input), '+/=', '-_~');
    }

    function base64UrlDecode($input) {
        return base64_decode(strtr($input, '-_~', '+/='));
    }
}
