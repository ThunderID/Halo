<?php

namespace App\Http\Controllers\CMS;

use Input;
use \App\Models\News as Model;
use \App\Models\Website as Website;

class NewsController extends CrudController { 

	function __construct() 
	{
		$this->crud_name 		= 'news';
		$this->model 			= new Model;
		$this->filters 			= ['title', 'tags', 'web'];
		$this->store_command 	= '\App\Jobs\StoreNews';
		$this->delete_command 	= '\App\Jobs\DeleteNews';

		parent::__construct();
	}

	public function getIndex()
	{
		parent::getIndex();

		// ------------------------------------------------------------------------------------
		// GET WEBSITE LIST
		// ------------------------------------------------------------------------------------
		$this->layout->main->website_list = Website::orderBy('name')
											->get()->lists('name', 'name');

		// ------------------------------------------------------------------------------------
		// GET LIST
		// ------------------------------------------------------------------------------------
		if (Input::get('web'))
		{
			$websites = Website::name(Input::get('web'))->get();
		}

		$this->layout->main->data = Model::title('*'.$this->layout->main->filters['title'] .'*')
										->belongsToTags(Input::get('tags'))
										// ->belongsToWebsiteId($websites ? ($websites->count() ? $websites->lists('_id')->toArray() : []) : null)
										->latest('created_at')
										->paginate(25);

		// ------------------------------------------------------------------------------------
		// VIEW
		return $this->layout;
	}

	public function getCreate(Model $data)
	{
		parent::getCreate($data);

		// ------------------------------------------------------------------------------------
		// GET WEBSITE LIST
		// ------------------------------------------------------------------------------------
		$this->layout->main->website_list = Website::orderBy('name')
											->get()->lists('name', '_id');


		return $this->layout;
	}

	public function postStore($id)
	{
		$input = Input::all();
		$input['published_at'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $input['published_at']);
		
		return parent::postStore($id, $input);
	}


}