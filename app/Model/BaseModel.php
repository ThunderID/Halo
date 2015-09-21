<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model {

	static function boot()
	{
		parent::boot();
		Static::observe(new BaseObserver);
	}
	
}