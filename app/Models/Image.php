<?php

namespace App\Models;

use Validator;

class Image extends BaseModel
{
	use hasName;

    //
	protected $table = 'images';
	protected $fillable = [
							'name',
							'title',
							'path', 
							'description', 
						];

	static protected $name_field	= 'name';

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();

		Static::observe(new ImageObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	function image()
	{
		return $this->morphTo();
	}

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
		$rules['name']		= ['required', 'in:sm,md,lg'];
		$rules['path']		= ['required'];
		$rules['title']		= ['max:255'];
		$rules['description'] = [''];

		$validator = Validator::make($model->toArray(), $rules);

		if ($validator->fails())
		{
			$model->setErrors($model);
			return false;
		}
	}

}
