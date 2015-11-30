<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait Taggable {

	static function bootTaggable()
	{

	}

	function tags()
	{
		return $this->morphToMany(__NAMESPACE__ . '\Tag', 'taggable');
	}
}
