<?php

namespace App\Http\Controllers\CMS;

use \App\Jobs\Authenticate, \App\Jobs\Logout;
use Input;
use Auth;

class LoginController extends Controller { 

	function __construct() {
		parent::__construct();

		$this->views['pages'] = $this->views['pages'] . 'login.';
	}

	function show()
	{
		// VIEW
		$this->layout->main = view($this->views['pages'] . 'form');
		return $this->layout;
	}

	function postLogin()
	{
		$credential = Input::only('email', 'password');
		if (Auth::attempt($credential))
		{
			return redirect()->route('cms.menu');
		}
		else
		{
			return redirect()->back();
		}
	}

	function Logout()
	{
		Auth::logout();
		return redirect()->route('cms.login');
	}

}