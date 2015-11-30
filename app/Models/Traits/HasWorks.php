<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait HasWorks {

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function bootHasWorks()
	{
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// HasImage
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function works()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Website', 'works', 'website_id', 'user_id')
					->withPivot('start_at', 'end_at', 'role')
					->withTimestamps();
	}

	function active_works()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Website', 'works', 'website_id', 'user_id')
									->withPivot('start_at', 'end_at', 'role')
									->withTimestamps()
									->wherePivot('start_at', '<=', \Carbon\Carbon::now())
									->WherePivot(function($q) { 
											$q->where('end_at', '>=', \Carbon\Carbon::now())
												->orwhereNull('end_at');
									});
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// 
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
}
