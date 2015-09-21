<?php

namespace App;

class Image extends BaseModel
{
	//
	protected $tables 		= 'images';
	protected $fillable 	= 	[

								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at' ];

}
