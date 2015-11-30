<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Validator;

class User extends BaseModel implements AuthenticatableContract,
									AuthorizableContract,
									CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword, HasName, HasImages, BelongsToManyContents;

	protected $table = 'users';
	protected $fillable = ['name', 'username', 'email', 'password'];
	protected $hidden = ['password', 'remember_token'];
	public $timestamps = true;
	protected $dates  = ['created_at', 'updated_at'];

	public static $name_field = 'name';
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// BOOT
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––	
	static function boot()
	{
		parent::boot();

		Static::observe(new UserObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------
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

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------
	public function setUsernameAttribute($v)
	{
		$this->attributes['username'] = strtolower($v);
	}

	public function setEmailAttribute($v)
	{
		$this->attributes['email'] = strtolower($v);
	}

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// FUNCTIONS
	// ----------------------------------------------------------------------
	static function validate($model)
	{
		$rules['name']       				= ['required'];
		$rules['username']      			= ['min:3'];
		$rules['email']     	 			= ['required', 'email'];
		$rules['password']      			= ['required', 'min:8'];

		$validator = Validator::make($model->toArray() + ['password' => $model->password], $rules);

		if ($validator->fails())
		{
			$model->setErrors($validator->messages());
			return false;
		}
		else
		{
			return true;
		}
	}

}
