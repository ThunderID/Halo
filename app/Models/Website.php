<?php

namespace App\Models;

class Website extends BaseModel
{
	// use BelongsToManyUsersTrait;

	//
	protected $collection 	= 'v2_websites';
	protected $fillable 	= 	[
									'name', 'url', 'launched_at', 'facebook', 'twitter', 'instagram', 'small_logo', 'medium_logo', 'large_logo'
								]; 
	protected $hidden		= [ ];
	protected $dates		= [ 'created_at', 'deleted_at', 'launched_at'];

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// SCOPE
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function scopeName($q, $v=null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('name', 'regex', '/'.preg_quote($v).'/i');
		}
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// FB
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function getFacebookAttribute()
	{
		return $this->attributes['social_media']['facebook'];
	}

	function setFacebookAttribute($v)
	{
		$this->attributes['social_media']['facebook'] = $v;
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// Twitter
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function getTwitterAttribute()
	{
		return $this->attributes['social_media']['twitter'];
	}

	function setTwitterAttribute($v)
	{
		$this->attributes['social_media']['twitter'] = $v;
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// IG
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function getInstagramAttribute()
	{
		return $this->attributes['social_media']['instagram'];
	}

	function setInstagramAttribute($v)
	{
		$this->attributes['social_media']['instagram'] = $v;
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// Small Logo
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function getSmallLogoAttribute()
	{
		return $this->attributes['logo']['s'];
	}

	function setSmallLogoAttribute($v)
	{
		$this->attributes['logo']['s'] = $v;
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// Medium Logo
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function getMediumLogoAttribute()
	{
		return $this->attributes['logo']['m'];
	}

	function setMediumLogoAttribute($v)
	{
		$this->attributes['logo']['m'] = $v;
	}

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// Large Logo
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	function getLargeLogoAttribute()
	{
		return $this->attributes['logo']['l'];
	}

	function setLargeLogoAttribute($v)
	{
		$this->attributes['logo']['l'] = $v;
	}

}
