<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait Publishable {

	static function bootPublishable()
	{

	}

	function websites()
	{
		return $this->morphToMany(__NAMESPACE__ . '\Website', 'publishable');
	}
}
