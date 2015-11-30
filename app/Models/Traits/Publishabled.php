<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait Publishabled {

	static function bootPublishabled()
	{

	}

	function contents()
	{
		return $this->morphedByMany(__NAMESPACE__ . '\Article', 'publishable');
	}

	function directories()
	{
		return $this->morphedByMany(__NAMESPACE__ . '\Directory', 'publishable');
	}
}
