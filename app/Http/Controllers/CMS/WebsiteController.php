<?php

namespace App\Http\Controllers\CMS;

use Input;
use \App\Models\Website as Model;
use \App\Jobs\StoreWebsite as StoreCommand;
use \App\Jobs\DeleteWebsite as DeleteCommand;

class WebsiteController extends CrudController { 

	function __construct() 
	{
		$this->crud_name = 'website';
		$this->model = new Model;
		$this->filters = ['name'];
		$this->store_command = '\App\Jobs\StoreWebsite';
		$this->delete_command = '\App\Jobs\DeleteWebsite';

		parent::__construct();
	}

	public function getIndex()
	{
		$view = parent::getIndex();

		// ------------------------------------------------------------------------------------
		// GET LIST
		// ------------------------------------------------------------------------------------
		$this->layout->main->data = Model::name('*'.$this->layout->main->filters['name'].'*')->orderby('name')->paginate(25);

		// ------------------------------------------------------------------------------------
		// VIEW
		// ------------------------------------------------------------------------------------
		return $this->layout;
	}

	public function postStore($id)
	{
		$input = Input::all();
		$input['launched_at'] = \Carbon\Carbon::createFromFormat('d/m/Y', $input['launched_at']);

		return parent::postStore($id, $input);
	}

}