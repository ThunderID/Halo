<?php

namespace App\Models;

class BelongsToUserObserver {

	function saving($model)
	{
		$rules['user_id'] = ['exists' . with(new \App\Models\User)->getTable() . ',id'];
		$validator = Validator::make($model->toArray, $rules);

		if ($validator->fails())
		{
			$model->setErrors($validator->messages());
			return false;
		}
	}
}