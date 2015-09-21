<?php

use Illuminate\Database\Seeder;

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
		$user->full([
				'name'			=> 'Erick Mo',
				'email'			=> 'mo@thunderlab.id',
				'password'		=> '123123123'
			]);

		$user->save();
	}
}
