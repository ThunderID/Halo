<?php

namespace App\Http\Controllers\HaloMalang;

use \App\Models\Website;

abstract class Controller extends \App\Http\Controllers\Controller { 

	protected $base_view;

	function __construct() 
	{
		$this->views['base'] 				= 'halomalang';
		$this->views['template'] 			= $this->views['base'] . '.templates.';
		$this->views['pages'] 				= $this->views['base'] . '.pages.';
		$this->views['widgets'] 			= $this->views['base'] . '.widgets.';

		// –––––––––––––––––––––––––––––––––––––––––––––––– TEMPLATE ––––––––––––––––––––––––––––––––––––––––––––––––
		$this->layout 			= view($this->views['template'] . 'v1');
		$this->layout->views	= $this->views;

		// –––––––––––––––––––––––––––––––––––––––––––––––– TEMPLATE CONTENT ––––––––––––––––––––––––––––––––––––––––––––––––
		$this->layout->content 			= view($this->views['template'] . 'v1_content');
		$this->layout->content->views 	= $this->views;
		
		// $this->layout->content->websites= Website::orderby('name')->get();
	}

}