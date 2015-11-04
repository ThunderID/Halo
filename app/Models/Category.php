<?php

namespace App\Models;

class Category extends BaseModel
{
	use BelongsToManyWebsiteTrait;
    //
	protected $tables 		= 'categories';
	protected $fillable 	= 	[

								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at'];

}
