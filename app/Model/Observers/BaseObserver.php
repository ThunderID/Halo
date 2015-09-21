<?php

namespace App;

class BaseObserver { 

    use DispatchesJobs;

	function get_class_name($model)
	{
		$reflect = new ReflectionClass($model);
		return $reflect->getShortName();
	}

	function callJob($model, $prefix)
	{
		$class_name = $this->get_class_name($model);
		$class_name = $prefix . $class_name;
		if (class_exists($class_name))
		{
			return $this->dispatch(new $class_name($model));
		}
	}

	function saving($model) {
		return $this->callJob($model, 'Saving');
	}
	
	function saved($model) {
		return $this->callJob($model, 'Saved');

	}
	
	function creating($model) {
		return $this->callJob($model, 'Creating');

	}
	
	function created($model) {
		return $this->callJob($model, 'Created');

	}
	
	function updating($model) {
		return $this->callJob($model, 'Updating');

	}
	
	function updated($model) {
		return $this->callJob($model, 'Updated');

	}
	
	function deleting($model) {
		return $this->callJob($model, 'Deleting');

	}
	
	function deleted($model) {
		return $this->callJob($model, 'Deleted');

	}
}