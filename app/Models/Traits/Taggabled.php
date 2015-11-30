<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait Taggabled {

	static function bootTaggable()
	{

	}

	function contents()
	{
		return $this->morphedByMany(__NAMESPACE__ . '\Content', 'taggable');
	}

	function directories()
	{
		return $this->morphedByMany(__NAMESPACE__ . '\Directory', 'taggable');
	}
}
