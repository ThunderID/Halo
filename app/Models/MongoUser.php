<?php

namespace App\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class MongoUser extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 'users';

}