<?php

namespace App\Http\Controllers\CMS;

use Input, Exception, Session;

class CrudController extends Controller { 

	protected $crud_name;
	protected $model;
	protected $filters = [];

	function __construct() 
	{
		parent::__construct();

		// ------------------------------------------------------------------------------------
		// MODEL
		// ------------------------------------------------------------------------------------
		if (!$this->model)
		{
			throw new Exception('Please initialize $model', 1);
		}

		// ------------------------------------------------------------------------------------
		// FILTERS
		// ------------------------------------------------------------------------------------
		if (!$this->filters)
		{
			throw new Exception('Please initialize $filters', 1);
		}

		// ------------------------------------------------------------------------------------
		// CRUD NAME
		// ------------------------------------------------------------------------------------
		if (!$this->crud_name)
		{
			throw new Exception('Please initialize $crud_name', 1);
		}
		else
		{
			$this->views['pages'] = $this->views['pages'] . str_plural($this->crud_name) . '.';
		}

		// ------------------------------------------------------------------------------------
		// STORE Command
		// ------------------------------------------------------------------------------------
		if (!$this->store_command)
		{
			throw new Exception('Please initialize $store_command', 1);
		}

	}

	function getIndex()
	{
		// ------------------------------------------------------------------------------------
		// GET FILTERS
		// ------------------------------------------------------------------------------------
		$filters = array_only(Input::all(), $this->filters);

		// ------------------------------------------------------------------------------------
		// VIEW
		// ------------------------------------------------------------------------------------
		$this->layout->main 			= view($this->views['pages'] . 'index');
		$this->layout->main->views 		= $this->views;
		$this->layout->main->filters	= $filters;
		
		return $this->layout;
	}

	function getCreate(Model $data = null)
	{
		// ------------------------------------------------------------------------------------
		// CREATE NEW DATA IF NEEDED
		// ------------------------------------------------------------------------------------
		if (!$data)
		{
			$data = new Model;
		}

		// ------------------------------------------------------------------------------------
		// VIEW
		// ------------------------------------------------------------------------------------
		$this->layout->main 			= view($this->views['pages'] . 'create');
		$this->layout->main->views 		= $this->views;
		$this->layout->main->data 		= $data;
		
		return $this->layout;
	}

	function getEdit($id)
	{
		// ------------------------------------------------------------------------------------
		// FIND DATA
		// ------------------------------------------------------------------------------------
		$data = $this->model->findorfail($id);

		// ------------------------------------------------------------------------------------
		// VIEW
		// ------------------------------------------------------------------------------------
		return $this->getCreate($data);
	}

	function getShow($id)
	{
		// ------------------------------------------------------------------------------------
		// GET
		// ------------------------------------------------------------------------------------
		$data = $this->model->findorfail($id);

		// ------------------------------------------------------------------------------------
		// VIEW
		// ------------------------------------------------------------------------------------
		$this->layout->main 			= view($this->views['pages'] . 'show');
		$this->layout->main->views 		= $this->views;
		$this->layout->main->data		= $data;
		
		return $this->layout;
	}

	function postStore($id = null, $input = null)
	{
		// ------------------------------------------------------------------------------------
		// CHECK ID
		// ------------------------------------------------------------------------------------
		if ($id)
		{
			$data = $this->model->findorfail($id);
		}
		else
		{
			$data = $this->model->newInstance();
		}

		// ------------------------------------------------------------------------------------
		// GET INPUT
		// ------------------------------------------------------------------------------------
		if (!$input)
		{
			$input = Input::all();
		}

		// ------------------------------------------------------------------------------------
		// CREATE
		// ------------------------------------------------------------------------------------
		$data->fill($input);
		$command_name = $this->store_command;
		$js = $this->dispatch(new $command_name($input, $data->id));

		// ------------------------------------------------------------------------------------
		// REDIRECT
		// ------------------------------------------------------------------------------------
		if ($js->isSuccess())
		{
			return redirect()->route('cms.' . $this->crud_name);
		}
		else
		{
			return redirect()->back()->withErrors($js->getData())->withInput();
		}
	}

	function putDelete($id)
	{
		// ------------------------------------------------------------------------------------
		// GET LIST
		// ------------------------------------------------------------------------------------
		$command_name = $this->delete_command;
		$js = $this->dispatch(new $command_name($id));

		// ------------------------------------------------------------------------------------
		// VIEW
		// ------------------------------------------------------------------------------------
		if ($js->isFail())
		{
			return redirect()->back()->withErrors($js->getData());
		}
		else
		{
			Session::flash('alert_success', '"'. $js->getData()->name . '" is deleted');
			return redirect()->route('cms.' . $this->crud_name);
		}
	}
}