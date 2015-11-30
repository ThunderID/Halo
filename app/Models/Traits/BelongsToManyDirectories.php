<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait BelongsToManyDirectories {

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function bootBelongsToManyDirectories()
	{
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// RELATION
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function directories()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Directory');
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// 
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function scopeOfDirectoryByName($q, $v)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->whereHas('directories', function($q) use ($v) { 
				$q->whereIn(with(new \App\Models\Directory)->getTable() . '.name', (is_array($v) ? $v : [$v]));
			});
		}
	}

	function scopeOfDirectoryBySlug($q, $v)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->whereHas('directories', function($q) use ($v) { 
				$q->whereIn(with(new \App\Models\Directory)->getTable() . '.slug', (is_array($v) ? $v : [$v]));
			});
		}
	}
}
