<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait Managing {

	static function bootManaging()
	{

	}

	// --------------------------------------------------------------------
	// RELATIONS
	// --------------------------------------------------------------------
	public function managing()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Website')->withTimestamps()->withPivot('role', 'start_at', 'end_at')->orderBy('pivot_created_at', 'asc');
	}

	// --------------------------------------------------------------------
	// SCOPE
	// --------------------------------------------------------------------
	public function scopeManagingById($q, $v)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('managing', function($q) use ($v) {
				$q->whereIn(Website::getTable() . '.id', is_array($v) ? $v : [$v] );
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
