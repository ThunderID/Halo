<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait HasPublishedAt {

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function bootHasPublishedAt()
	{
		Static::observe(new HasPublishedAtObserver);
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// 
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	static function scopePublished($q, $v = null)
	{
		if (!$v)
		{	
			return $q->where('published_at', '!=', '0000-00-00 00:00:00');
		}
		else
		{
			return $q->where('published_at', '<=', \Carbon\Carbon::parse($v))
					->where('published_at', '!=', '0000-00-00 00:00:00');
		}
	}

	static function scopeUpcoming($q, $v = null)
	{
		if (!$v)
		{	
			return $q->where('published_at', '>', \Carbon\Carbon::now());
		}
		else
		{
			return $q->where('published_at', '<=', \Carbon\Carbon::parse($v))
					->where('published_at', '!=', '0000-00-00 00:00:00');
		}
	}

	static function scopeDraft($q)
	{
		return $q->where('published_at', '=', '0000-00-00 00:00:00');
	}
}
