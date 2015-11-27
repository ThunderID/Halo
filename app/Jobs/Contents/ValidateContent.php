<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use Validator;
use \App\JSend;

class ValidateContent extends Job implements SelfHandling
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
		$rules['title']						= ['required'];
		$rules['slug']						= ['required', 'alpha_dash'];
		$rules['summary']					= ['max:150'];
		$rules['content']					= ['required'];
		$rules['published_at']				= ['required', 'date'];

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
