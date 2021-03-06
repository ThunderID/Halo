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
	// HasImage
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function images()
	{
		return $this->morphMany(__NAMESPACE__ . '\Image', 'image');
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
