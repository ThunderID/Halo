<?php

namespace App\Models;

class Content extends BaseModel
{
	use BelongsToManyWebsiteTrait;
	//
	protected $tables 		= 'contents';
	protected $fillable 	= 	[

								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at', 'published_at' ];

}
