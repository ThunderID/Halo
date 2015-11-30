<?php

namespace App\Models;

class TagObserver {

	function saving($model)
	{
		if (\App\Models\Tag::validate($model) === false)
		{
			return false;
		}
	}	
}