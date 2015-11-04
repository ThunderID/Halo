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
	public function __construct(array $website_data)
	{
		//
		$this->website_data = $website_data;
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
		$rules['social_media.facebook']   	= ['required'];
		$rules['social_media.twitter']    	= ['required'];
		$rules['social_media.instagram']  	= ['required'];
		$rules['logo.s'] 					= ['required', 'url'];
		$rules['logo.m']					= ['required', 'url'];
		$rules['logo.l'] 					= ['required', 'url'];

		// validate
		$validator = Validator::make($this->website_data, $rules);

		if ($validator->fails())
		{
			$result = JSend::fail($validator->messages());
		}
		else
		{
			$result = JSend::success($this->website_data);
		}

		return $result;
	}
}
