<?php

namespace App\Models;

class UserObserver {

	function saving($model)
	{
		if (\App\Models\User::validate($model) === false)
		{
			return false;
		}
	}	
}