<?php

namespace App\Models;

use Jenssegers\Mongodb\Model;
use \App\Models\ErrorTrait;


class BaseModel extends Model {

	use ErrorTrait;

	static function boot()
	{
		parent::boot();
		Static::observe(new BaseObserver);
	}
	
}