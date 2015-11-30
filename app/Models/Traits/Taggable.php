<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait Taggable {

	static function bootTaggable()
	{

	}

	function taggable()
	{
		return $this->morphToMany(__NAMESPACE__ . '\Tag', 'taggable');
	}
}
