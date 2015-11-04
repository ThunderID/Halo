<?php

namespace App\Http\Controllers\CMS;

use Input;
use \App\Models\Website;
use \App\Jobs\StoreWebsite;
use \App\Jobs\DeleteWebsite;

class WebsiteController extends Controller { 

	function __construct() 
	{
		parent::__construct();

		$this->views['pages'] = $this->views['pages'] . 'websites.';
	}

	function getIndex()
	{
		// ------------------------------------------------------------------------------------
		// GET FILTERS
		// ------------------------------------------------------------------------------------
		$filters = Input::only('name');

		// ------------------------------------------------------------------------------------
		// GET WEBSITES LIST
		// ------------------------------------------------------------------------------------
		$websites = Website::name($filters['name'])->orderby('name')->paginate(25);

		// ------------------------------------------------------------------------------------
		// VIEW
		// ------------------------------------------------------------------------------------
		$this->layout->main 			= view($this->views['pages'] . 'index');
		$this->layout->main->views 		= $this->views;
		$this->layout->main->websites	= $websites;
		$this->layout->main->filters	= $filters;
		
		return $this->layout;
	}

	function getCreate(Website $website = null)
	{
		if (!$website)
		{
			$website = new Website;
		}
		// ------------------------------------------------------------------------------------
		// GET WEBSITES LIST
		// ------------------------------------------------------------------------------------

		// ------------------------------------------------------------------------------------
		// VIEW
		// ------------------------------------------------------------------------------------
		$this->layout->main 			= view($this->views['pages'] . 'create');
		$this->layout->main->views 		= $this->views;
		$this->layout->main->website 	= $website;
		
		return $this->layout;
	}

	function getEdit($id)
	{
		$website = Website::findorfail($id);

		return $this->getCreate($website);
	}

	function getShow($id)
	{
		// ------------------------------------------------------------------------------------
		// GET WEBSITE
		// ------------------------------------------------------------------------------------
		$website = Website::findorfail($id);

		// ------------------------------------------------------------------------------------
		// VIEW
		// ------------------------------------------------------------------------------------
		$this->layout->main 			= view($this->views['pages'] . 'show');
		$this->layout->main->views 		= $this->views;
		$this->layout->main->website	= $website;
		
		return $this->layout;
	}

	function postStore($id = null)
	{
		// ------------------------------------------------------------------------------------
		// CHECK ID
		// ------------------------------------------------------------------------------------
		if ($id)
		{
			$website = Website::findorfail($id);
		}
		else
		{
			$website = new Website;
		}

		// ------------------------------------------------------------------------------------
		// GET INPUT
		// ------------------------------------------------------------------------------------
		$input = Input::all();
		$input['launched_at'] = \Carbon\Carbon::createFromFormat('d/m/Y', $input['launched_at']);

		// ------------------------------------------------------------------------------------
		// CREATE WEBSITE
		// ------------------------------------------------------------------------------------
		$js = $this->dispatch(new StoreWebsite($input, $website->id));


		// ------------------------------------------------------------------------------------
		// REDIRECT
		// ------------------------------------------------------------------------------------
		if ($js->isSuccess())
		{
			return redirect()->route('cms.website');
		}
		else
		{
			return redirect()->back()->withErrors($js->getData())->withInput();
		}
	}

	function putDelete($id)
	{
		// ------------------------------------------------------------------------------------
		// GET WEBSITES LIST
		// ------------------------------------------------------------------------------------
		$js = $this->dispatch(new DeleteWebsite($id));

		// ------------------------------------------------------------------------------------
		// VIEW
		// ------------------------------------------------------------------------------------
		if ($js->isFail())
		{
			return redirect()->back()->withErrors($js->getData());
		}
		else
		{
			$request->session()->flash('alert_success', 'Website ' . $js->getData()->name . ' is deleted');
			return redirect()->route('cms.website')->with('alert_success');
		}
	}
}