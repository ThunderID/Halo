<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use Auth, Validator, \App\Jsend;
use \App\Models\User;

class Authenticate extends Job implements SelfHandling
{
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($email, $password, $is_team = 0)
	{
		//
		$this->email = $email;
		$this->password = $password;
		$this->is_team = (boolean) $is_team;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		// SETUP CREDENTIAL
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		$credential = [
			'email'  		=> $this->email,
			'password'  	=> $this->password,
		];

		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		// VALIDATE
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		$rules['email'] 	= ['required', 'email'];
		$rules['password'] 	= ['required'];

		$validator = Validator::make($credential, $rules);
		if ($validator->fails())
		{
			return JSend::fail($validator->messages()->toArray());
		}

		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		// AUTHENTICATE
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		$user = User::email($this->email)->first();
		if (!$user)
		{
			return JSend::fail(['InvalidCredential' => 'Invalid Credential']);
		}
		else
		{
			// CHECK PASSWORD
			if (Hash::check($this->password, $user->password))
			{
				
			}
		}


		if (Auth::attempt($credential))
		{
			return JSend::success(Auth::user());
		}
		else
		{
			return JSend::fail(['Authentication' => 'Invalid Email & Password Combination']);
		}
	}
}
