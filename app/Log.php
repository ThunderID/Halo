<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $table = 'tags';
    protected $fillable = [];
    public $timestamps = true;

    public function logged()
    {
    	$this->morphTo();
    }

}
