<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait HasImages {

	static function bootHasImages()
	{

	}

	// --------------------------------------------------------------------
	// SCOPE
	// --------------------------------------------------------------------
	public function images()
	{
		return $this->morphMany(__NAMESPACE__ . '\Image', 'image');
	}


	// --------------------------------------------------------------------
	// ACCESSOR
	// --------------------------------------------------------------------
	public function getSmallImagesAttribute()
	{
		// $this->load('images');
		return $this->images->where('name', 'small');
	}

	public function getMediumImagesAttribute()
	{
		// $this->load('images');
		return $this->images->where('name', 'medium');
	}

	public function getLargeImagesAttribute()
	{
		// $this->load('images');
		return $this->images->where('name', 'large');
	}

}
