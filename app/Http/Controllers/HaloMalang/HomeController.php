<?php

namespace App\Http\Controllers\HaloMalang;

use \App\Models\Content;
use \App\Models\Event;
use \App\Models\Directory;

class HomeController extends Controller { 

	function __construct() 
	{
		parent::__construct(); 

		$this->views['pages'] 				.= 'home.';
	}

	function index()
	{
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		// LATEST NEWS
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		$data['news'] = Content::published('now')->latest('published_at')->limit(5)->get();

		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		// UPCOMING EVENTS
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		$data['upcoming_events'] = Event::published('now')->upcoming()->oldest('started_at')->limit(10)->get();

		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		// KULINER
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		$data['kuliner'] = Directory::published('now')->orderByRaw('rand()')->limit(1)->get();

		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		// GENERATE VIEW
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		$this->layout->main 		= view($this->views['pages'] . 'home');
		$this->layout->main->views	= $this->views;
		foreach ($data as $k => $v)
		{
			$this->layout->main->$k = $v;
		}

		return $this->layout;
	}

}