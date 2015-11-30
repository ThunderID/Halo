<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait BelongsToUser {

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function bootBelongsToUser()
	{
		Static::observe(new BelongsToUserObserver);
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// RELATION
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function user()
	{
		return $this->belongsTo(__NAMESPACE__ . '\User')
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// 
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function scopeOfUserByName($q, $v)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('user', function($q) use ($v) { 
				$q->whereIn(with(new \App\Models\User)->getTable() . '.name', (is_array($v) ? $v : [$v]));
			});
		}
	}

	function scopeUserId($q, $v)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('user_id', '=', $v);
		}
	}
}
