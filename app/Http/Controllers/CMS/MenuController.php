<?php

namespace App\Http\Controllers\CMS;

use \App\Jobs\Authenticate;
use Input;
use Auth;

class MenuController extends Controller { 

	function __construct() 
	{
		parent::__construct();

		$this->views['pages'] = $this->views['pages'] . 'menu.';
	}

	function index()
	{
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		// MAIN VIEW
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		$this->layout->main 			= view($this->views['pages'] . 'index');
		$this->layout->main->views 		= $this->views;

		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		// SHOW VIEW
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		return $this->layout;
	}
}