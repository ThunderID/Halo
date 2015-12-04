<?php

namespace App\Models;

use Validator;

class Event extends BaseModel
{
	use HasName, HasSlug, HasImages, HasPublishedAt, Publishable, Taggable, BelongsToManyDirectories, BelongsToUser;

	protected $fillable 	= 	[
									'title', 'slug', 'summary', 'content', 'published_at', 'user_id', 'started_at', 'ended_at', 'location', 'komunitas'
								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at', 'published_at', 'started_at', 'ended_at'];

	static public $name_field	= 'title';

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
	function scopeUpcoming($q)
	{
		return $q->where(function($q) { 
				$q->where('started_at', '>=', \Carbon\Carbon::now())
					->orWhere('ended_at', '>=', \Carbon\Carbon::now());
				});
	}

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// FUNCTIONS
	// ----------------------------------------------------------------------
	public static function validate($model)
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
