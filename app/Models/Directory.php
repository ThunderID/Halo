<?php

namespace App\Models;

class Directory extends BaseModel
{
	use BelongsToManyWebsiteTrait;

    //
	protected $tables 		= 'directories';
	protected $fillable 	= 	[

								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at', 'published_at' ];

}
