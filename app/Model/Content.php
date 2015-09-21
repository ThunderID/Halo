<?php

namespace App;

class Content extends BaseModel
{
	//
	protected $tables 		= 'contents';
	protected $fillable 	= 	[

								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at', 'published_at' ];

}
