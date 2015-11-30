<?php

namespace App\Models;

class HasImagesObserver {

	function deleted($model)
	{
		foreach ($model->images as $image)
		{
			$image->delete();
		}
	}
}