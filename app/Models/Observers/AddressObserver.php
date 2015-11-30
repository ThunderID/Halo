<?php

namespace App\Models;

class AddressObserver {

	function saving($model)
	{
		if (\App\Models\Address::validate($model) === false)
		{
			return false;
		}
	}	
}