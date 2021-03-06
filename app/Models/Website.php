<?php

namespace App\Models;

use Validator;


class Website extends BaseModel
{
	use HasName, HasImages, Publishabled;

	//
	protected $table 		= 'websites';
	protected $fillable 	= 	[
									'name', 'url', 'launched_at'
								]; 
	protected $dates		= [ 'created_at', 'deleted_at', 'launched_at'];

	static public $name_field	= 'name';

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––	
	static function boot()
	{
		parent::boot();

		Static::observe(new WebsiteObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// FUNCTIONS
	// ----------------------------------------------------------------------
	static function validate($model)
	{
		$rules['name']			= ['required'];
		$rules['url']			= ['required', 'url'];
		$rules['launched_at']	= ['date'];

		$validator = Validator::make($model->toArray(), $rules);

		if ($validator->fails())
		{
			$model->setErrors($validator->messages());
			return false;
		}
		else
		{
			return true;
		}
	}
}
