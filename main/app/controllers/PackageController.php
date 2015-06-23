<?php

class PackageController extends BaseController {

	public function diy()
    {
        return View::make('package.diy');
    }

    public function value()
    {
        return View::make('package.value');
    }

    public function standard()
    {
        return View::make('package.standard');
    }

    public function professional()
    {
        return View::make('package.professional');
    }

    public function premium()
    {
        return View::make('package.premium');
    }
}

