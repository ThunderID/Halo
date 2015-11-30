<?php

namespace App\Models;

class WebsiteObserver {

	function saving($model)
	{
		if (\App\Models\Website::validate($model) === false)
		{
			return false;
		}
	}

	function deleting($model)
	{
		if ($model->launched_at->lt(\Carbon\Carbon::now()))
		{
			$model->setErrors(new MessageBag(['already_launched' => 'Live website cannot be deleted']));
			return false;
		}
	}
	
}