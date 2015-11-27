<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use \App\Jobs\ValidateUser as Validate;
use \App\Models\User as Model;
use \App\JSend;

class DeletingUser extends Job implements SelfHandling
{
	protected $model;
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(Model $model)
	{
		//
		$this->model = $model;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		return JSend::fail(['delete user' => 'User cannot be deleted']);
	}
}
