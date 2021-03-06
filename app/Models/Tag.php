<?php

namespace App\Models;
use Validator;

class Tag extends BaseModel
{
	use HasName, HasSlug, HasImages, Taggabled;

	//
	protected $fillable 	= 	[
									'name', 'slug'
								]; 

	public static $name_field	= 'name';

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––	
	static function boot()
	{
		parent::boot();

		Static::observe(new TagObserver);
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
		$rules['slug']			= ['required'];

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
