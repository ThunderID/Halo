<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait HasName {

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function bootHasName()
	{
		if (!Static::$name_field)
		{
			throw new Exception(__CLASS__ . ' need $name_field set', 1);
		}
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// 
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function scopeName($q, $v = null)
	{
		if (!is_null($v) || $v == "**")
		{	
			return $q;
		}
		else
		{
			return $q->where(Static::$name_field, 'like', str_replace('*', '%', $v));
		}
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// ACCESSOR
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// public function getNameAttribute()
	// {
	// 	$name_field = Static::$name_field;
	// 	return $this->$name_field;
	// }
}
