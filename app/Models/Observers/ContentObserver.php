<?php

namespace App\Models;

class ContentObserver {

	function saving($model)
	{
		if (\App\Models\Content::validate($model) === false)
		{
			return false;
		}
	}
}