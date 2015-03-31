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

    protected function getPackage($id = null)
    {
        $pricing  = Config::get('paypal.pricing');

        $packages = [
            1 => [
                'id'         => 1,
                'name'       => '3 STAR',
                'price'      => $pricing[1],
                'features'   => [1, 2, 3, 4, 5]
            ],
            2 => [
                'id'         => 2,
                'name'       => '4 STAR',
                'price'      => $pricing[2],
                'features'   => [1, 2, 3, 4, 5, 6]
            ],
            3 => [
                'id'         => 3,
                'name'       => 'Gold',
                'price'      => $pricing[3],
                'features'   => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
            ]
        ];

        return ($id == null || !isset($packages[$id])) ? $packages : $packages[$id];
    }

    protected function getFeatures()
    {
        return [
            1 => 'Professionally written Business Plan written by MBA Graduates',
            2 => 'IHT Report',
            3 => 'Remuneration Report',
            4 => 'Company Will brochure',
            5 => 'Subscription to BizDoc Pro - 1 month',
            6 => 'Financial forecasting with qualified inhouse accountant - 3 years',
            7 => 'Business valuation',
            8 => 'Free trademark review',
            9 => 'Importance of protecting your business factsheet',
            10 => 'Access to legal docs & free review of your M&A with recommendations, & free review of company strucutre with recommendations'
        ];
    }
}
