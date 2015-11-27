<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait Authored {

	static function bootAuthored()
	{

	}

	// --------------------------------------------------------------------
	// RELATIONS
	// --------------------------------------------------------------------
	public function authored()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\User', 'content_author')->withTimestamps()->orderBy('pivot_created_at', 'asc');
	}

	// --------------------------------------------------------------------
	// SCOPE
	// --------------------------------------------------------------------
	public function scopeBelongsToAuthorId($q, $v)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('authored', function($q) use ($v) {
				$q->whereIn(User::getTable() . '.id', is_array($v) ? $v : [$v] );
			});
		}
	}


	// --------------------------------------------------------------------
	// ACCESSOR
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// MUTATOR
	// --------------------------------------------------------------------

	// --------------------------------------------------------------------
	// FUNCTIONS
	// --------------------------------------------------------------------
}
