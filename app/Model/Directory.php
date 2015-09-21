<?php

namespace App;

class Directory extends BaseModel
{
    //
	protected $tables 		= 'directories';
	protected $fillable 	= 	[

								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at', 'published_at' ];

}
