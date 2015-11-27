<?php 

namespace App\Models;

use Illuminate\Support\MessageBag;

trait HasLogs {

	static function bootHasLogs()
	{

	}

	// --------------------------------------------------------------------
	// SCOPE
	// --------------------------------------------------------------------
	public function logs()
	{
		return $this->morphMany(__NAMESPACE__ . '\Log', 'logged');
	}

	public function oldest_logs()
	{
		return $this->morphMany(__NAMESPACE__ . '\Log', 'logged')->oldest('created_at');
	}

	public function latest_logs()
	{
		return $this->morphMany(__NAMESPACE__ . '\Log', 'logged')->latest('created_at');
	}


	// --------------------------------------------------------------------
	// ACCESSOR
	// --------------------------------------------------------------------

}
