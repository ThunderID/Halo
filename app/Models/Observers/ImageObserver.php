<?php

namespace App\Models;

class ImageObserver {

	function saving($model)
	{
		if (\App\Models\Image::validate($model) === false)
		{
			return false;
		}
	}
}