<?php

namespace App\Models;

class SlugGeneratorObserver {

	function creating($model)
	{
		if (!$model->slug)
		{
			$class_name = get_class($model);
			$static_property = new ReflectionProperty($class_name, 'name_field'); 
			$name_field = $static_property->getValue();

			$i = 0;
			do {
				$model->slug = str_slug($model->$name_field . ($i ? ' ' . $i : ''));
				$i++;
			} while (!with(new $class_name)->slug($model->slug)->first()) 
		}
	}
	
}