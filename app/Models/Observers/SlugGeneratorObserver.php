<?php

namespace App\Models;
use Validator;

class SlugGeneratorObserver {

	function saving($model)
	{
		if (!$model->id)
		{
			$class_name = get_class($model);
			$static_property = new \ReflectionProperty($class_name, 'name_field'); 
			$name_field = $static_property->getValue();

			$i = 0;
			do {
				$slug = strtolower(str_slug($model->$name_field . ($i > 0 ? ' ' . $i : '')));

				$validator = Validator::make(['slug' => $slug], ['slug' => ['unique:' . $model->getTable() . ',slug']]);
				$i++;
			} while ($validator->fails()); 

			$model->slug = $slug;
		}
	}
	
}