<?php

namespace App\Models;

class Address extends BaseModel
{
	use HasImages;
    //
	protected $table = 'images';
	protected $fillable = [
							'road',
							'city',
							'longitude',
							'latitude'
						];

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();

		Static::observe(new AddressObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	function addressable()
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
		$rules['road']		= ['required'];
		$rules['city']		= ['required'];
		$rules['longitude']		= ['numeric'];
		$rules['latitude']		= ['numeric'];

		$validator = Validator::make($model->toArray(), $rules);

		if ($validator->fails())
		{
			$model->setErrors($model);
			return false;
		}
	}

}
