<?php

namespace App\Http\Controllers\CMS;

use \App\Jobs\Authenticate;
use Input;
use Auth;

class DashboardController extends Controller { 

	function __construct() 
	{
		parent::__construct();

		$this->views['pages'] = $this->views['pages'] . 'dashboard.';
	}

	function index()
	{
		// VIEW
		$this->layout->main = view($this->views['pages'] . 'overview');
		return $this->layout;
	}
}