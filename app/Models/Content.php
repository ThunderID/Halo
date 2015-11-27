<?php

namespace App\Models;

class Content extends BaseModel
{
	use BelongsToUser, HasImages, BelongsToManyTags, BelongsToManyWebsites, HasLogs, Authored;

	protected $table		= 'contents';
	protected $fillable 	= 	[
									'title', 'slug', 'summary', 'content', 'published_at',
								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at', 'published_at' ];
	public $timestamps 		= true;

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// SCOPE
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function scopeTitle($q, $v=null)
	{
		if (is_null($v) || $v == "**")
		{
			return $q;
		}
		else
		{
			return $q->where('title', 'like', $v);
		}
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// MUTATOR
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function setSummaryAttribute($v)
	{
		$this->attributes['summary'] = strip_tags($v);
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// ACCESSOR
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function getNameAttribute()
	{
		return $this->attributes['title'];
	}

}
