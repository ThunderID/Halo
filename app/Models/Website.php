<?php

namespace App\Models;

class Website extends BaseModel
{
	use HasImages, 
		BelongsToManyContents, 
		Managed; #, HasSocialMedia;

	//
	protected $table 		= 'websites';
	protected $fillable 	= 	[
									'name', 'url', 'launched_at', 'facebook', 'twitter', 'instagram'
								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at', 'launched_at'];

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// SCOPE
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function scopeName($q, $v=null)
	{
		if (is_null($v) || $v == "**")
		{
			return $q;
		}
		else
		{
			return $q->where('name', 'like', $v);
		}
	}

	
}
