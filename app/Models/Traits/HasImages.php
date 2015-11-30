<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait HasImages {

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function bootHasImages()
	{
		Static::observe(new HasImagesObserver);
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// 
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function getImage($name)
	{
		if ($this->images->count())
		{
			return $this->images->where('name', $name)->first();
		}
	}
}
