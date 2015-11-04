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
		$js = $this->dispatch(new Authenticate(Input::get('email'), Input::get('password'), true));
		if ($js->isSuccess())
		{
			return redirect()->route('cms.dashboard');
		}
		else
		{
			return redirect()->back()->withErrors($js->getData());
		}
	}

	function Logout()
	{
		$js = $this->dispatch(new Logout());
		return redirect()->route('cms.login');
	}

}