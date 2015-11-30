<?php

namespace App\Models;

class DirectoryObserver {

	function saving($model)
	{
		if (\App\Models\Directory::validate($model) === false)
		{
			return false;
		}
	}
}