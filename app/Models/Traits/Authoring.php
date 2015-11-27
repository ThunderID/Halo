<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait Authoring {

	static function bootAuthoring()
	{

	}

	// --------------------------------------------------------------------
	// RELATIONS
	// --------------------------------------------------------------------
	public function authoring()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Content', 'content_author')->withTimestamps()->orderBy('pivot_created_at', 'asc');
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
			return $q->where('authoring', function($q) use ($v) {
				$q->whereIn(Content::getTable() . '.id', is_array($v) ? $v : [$v] );
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
