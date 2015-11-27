<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use Validator;
use \App\JSend;

class ValidateWebsite extends Job implements SelfHandling
{
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(array $data)
	{
		//
		$this->data = $data;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		// rules
		$rules['name']       				= ['required'];
		$rules['url']        				= ['required', 'url'];
		$rules['launched_at']				= ['date'];

		// validate
		$validator = Validator::make($this->data, $rules);

		if ($validator->fails())
		{
			$result = JSend::fail($validator->messages());
		}
		else
		{
			$result = JSend::success($this->data);
		}

		return $result;
	}
}
