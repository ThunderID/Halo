<?php

use Illuminate\Database\Seeder;
use \App\Models\User;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//
		$user = new User;
		$user->fill([
				'name'			=> 'Erick Mo',
				'email'			=> 'mo@thunderlab.id',
				'password'		=> '123123123'
			]);

		$user->save();
	}
}
