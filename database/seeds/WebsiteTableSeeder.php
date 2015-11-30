<?php

use Illuminate\Database\Seeder;

use \App\Models\Website; 

class WebsiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Website::create(['name'	=> 'HaloMalang', 'url' => 'http://halomalang.com', 'launched_at' => \Carbon\Carbon::parse('2012-03-01 00:00:00')]);
    }
}
