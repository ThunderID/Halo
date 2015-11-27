<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use \App\Jobs\ValidateContent as Validate;
use \App\JSend;
use \App\Models\Content;
use Auth;

class SavedContent extends Job implements SelfHandling
{
	protected $model;
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(Content $model)
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
		if (Auth::user()->id)
		{
			$model->users()->attach(Auth::user()->id, [$this->model->getOriginal->toJson(), $this->model->toJson()]);
		}

		return JSend::success();
	}
}
