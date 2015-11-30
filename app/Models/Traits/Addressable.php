<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait Addressable {

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function bootHasAddress()
	{
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// RELATIONS
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function addressable()
	{
		return $this->morphMany(__NAMESPACE__ . '\Address', 'addressable');
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// 
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
}