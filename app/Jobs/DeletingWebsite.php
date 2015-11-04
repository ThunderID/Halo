<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use \App\Jobs\ValidateWebsite;
use \App\JSend;

class DeletingWebsite extends Job implements SelfHandling
{
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($model)
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
		// ------------------------- CHECK IF WEBSITE HAS CONTENTS -------------------------
		// if ($this->model->contents->count())
		// {
		// 	return Jsend::fail(['contents' => 'This website has some contents associated to it']);
		// }

		// ------------------------- CHECK IF WEBSITE HAS DIRECTORIES -------------------------
		// if ($this->model->directories->count())
		// {
		// 	return Jsend::fail(['contents' => 'This website has some contents associated to it']);
		// }
		
		// ------------------------- CHECK IF WEBSITE HAS DIRECTORIES -------------------------
		return JSend::success($model);
	}
}
