<?php

namespace App\Models;

class Tag extends BaseModel
{
	use BelongsToManyContents;

    //
    protected $table	= 'tags';
    protected $fillable = ['tag'];
    public $timestamps 	= true;

    public function scopeTag($q, $v)
    {
    	if (!$v)
    	{
    		return $q;
    	}
    	else
    	{
    		return $q->whereIn('tag', is_array($v) ? str_replace('*', '%', $v) : [$v]);
    	}
    }

}
