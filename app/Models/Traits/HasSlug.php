<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait HasSlug {

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function bootHasSlug()
	{
		Static::observe(new SlugGeneratorObserver);
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// 
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function scopeSlug($q, $v = null)
	{
		if (!is_null($v) || $v == "**")
		{	
			return $q;
		}
		else
		{
			return $q->where('slug', 'like', str_replace('*', '%', $v));
		}
	}
}
