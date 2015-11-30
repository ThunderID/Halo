<?php

namespace App\Models;

// use Jenssegers\Mongodb\Model;
use Illuminate\Database\Eloquent\Model;
use \App\Models\ErrorTrait;


abstract class BaseModel extends Model implements IValidatable {

    protected $connection = 'mysql';

	use ErrorTrait;
}