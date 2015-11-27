<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel 
						// implements AuthenticatableContract,
						// 			AuthorizableContract,
						// 			CanResetPasswordContract
{
	// use Authenticatable, Authorizable, CanResetPassword, 
	use HasImages, Authoring, Managing;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'username', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	public $timestamps = true;
	protected $dates  = ['created_at', 'updated_at', 'start_at', 'end_at'];


	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// SCOPE
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	public function scopeUsername($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('username', 'like', $v);
		}
	}

	public function scopeEmail($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('email', 'like', $v);
		}
	}

	public function scopeGroup($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('group', 'like', $v);
		}
	}

	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// mutator
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	public function setUsernameAttribute($v)
	{
		$this->attributes['username'] = strtolower($v);
	}

	public function setEmailAttribute($v)
	{
		$this->attributes['email'] = strtolower($v);
	}
}
