<?php

namespace App\Models;

class Image extends BaseModel
{
    //
	protected $table = 'images';
	protected $fillable = [
							'path', 
							'name',
							'title',
							'description', 
						];

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
	// ACCESSORS
	// ----------------------------------------------------------------------

}
