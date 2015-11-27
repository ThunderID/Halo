<?php

namespace App\Models;

// use Jenssegers\Mongodb\Model;
use Illuminate\Database\Eloquent\Model;
use \App\Models\ErrorTrait;


abstract class BaseModel extends Model {

    protected $connection = 'mysql';

	use ErrorTrait;

	static function boot()
	{
		parent::boot();
		Static::observe(new BaseObserver);
	}
	
}