<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait HasSocialMedia {

	static function bootHasSocialMedia()
	{

	}

	// --------------------------------------------------------------------
	// SCOPE
	// --------------------------------------------------------------------

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
}
