<?php

namespace App\Models;

use Validator;

class Content extends BaseModel
{
	use HasName, HasSlug, HasImages, HasPublishedAt, Publishable, Taggable, BelongsToManyDirectories, BelongsToUser;

	protected $fillable 	= 	[
									'title', 'slug', 'summary', 'content', 'published_at', 'user_id'
								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at', 'published_at'];

	public static $name_field	= 'title';

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––	
	static function boot()
	{
		parent::boot();

		Static::observe(new ContentObserver);
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
		$rules['title']			= ['required'];
		$rules['slug']			= ['required', 'unique:' . $model->getTable() . ',slug,' . $model->id ];
		$rules['summary']		= [''];
		$rules['content']		= ['required'];
		$rules['published_at']	= ['date'];

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
