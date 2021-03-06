<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait BelongsToManyContents {

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function bootBelongsToManyContents()
	{
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// RELATION
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function contents()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Content');
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// 
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function scopeOfContentByName($q, $v)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->whereHas('contents', function($q) use ($v) { 
				$q->whereIn(with(new \App\Models\Content)->getTable() . '.name', (is_array($v) ? $v : [$v]));
			});
		}
	}

	function scopeOfContentBySlug($q, $v)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->whereHas('contents', function($q) use ($v) { 
				$q->whereIn(with(new \App\Models\Content)->getTable() . '.slug', (is_array($v) ? $v : [$v]));
			});
		}
	}
}
