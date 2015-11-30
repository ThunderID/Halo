<?php

namespace App\Models;
use Validator;

class HasPublishedAtObserver {

	function saving($model)
	{
		if (!is_null($model->published_at))
		{
			$rules['published_at'] = ['date'];
			
			$validator = validator::make($model->toArray(), $rules);
			if ($validator->fails())
			{
				$model->setErrors($validator->messages());
				return false;
			}
		}
	}
}