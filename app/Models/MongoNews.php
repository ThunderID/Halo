<?php

namespace App\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class MongoPost extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 'posts';

}