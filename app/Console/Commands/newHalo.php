<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use MongoId, MongoDate, MongoRegex;
use \App\Models\User;

class newHalo extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'halo:newdb';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Prepare new db.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		//
		$this->info('* Migrate user...');
		$this->migrate_user();

		$this->info('* Migrate article...');
		// $this->migrate_article();

		// $this->info('* Migrate serba-serbi...');
		// $this->migrate_article();

		$this->info('* Migrate event...');
		// $this->migrate_events();

		$this->info('* Migrate ads...');
		// $this->migrate_ads();
	}

	protected function migrate_user()
	{
		$old_collection = 'users';
		$new_collection = 'v2_users';

		// get old articles
		DB::collection($new_collection)->truncate();
		DB::collection($old_collection)->chunk(1000, function($data) use ($new_collection) {
			foreach ($data as $x)
			{
				if ($x['auth'] == 300)
				{
					$role = 'administrator';
				}
				elseif ($x['auth'] == 200)
				{
					$role = 'editors';
				}
				elseif ($x['auth'] == 100)
				{
					$role = 'writers';
				}
				else
				{
					$role = '';
				}

				if (isset($role))
				{
					if (isset($x['email']) && $x['email'])
					{
						User::create([
								'name'				=> (isset($x['name']) ? $x['name'] : $x['username']),
								'username'			=> $x['username'],
								'email'				=> (isset($x['email']) ? $x['email'] : ''),
								'password'			=> \Hash::make('123123'),
								'group'				=> 'teams',
								'role'				=> 	$role,
							]);
					}
				}
			}
		});
		User::create([
				'name'				=> "Erick Mo",
				'username'			=> "erickmo",
				'email'				=> "mo@thunderlab.id",
				'password'			=> \Hash::make('123123'),
				'group'				=> 'teams',
				'role'				=> 	'administrator',
			]);
	}

	protected function migrate_article()
	{
		$old_collection = 'posts';
		$new_collection = 'v2_news';

		$data_users = DB::collection('v2_users')->get();
		foreach ($data_users as $user)
		{
			$users[$user['username']] = $user;
		}

		// get old articles
		DB::collection($new_collection)->truncate();
		DB::collection($old_collection)->where('category', 'news')->chunk(1000, function($data) use ($new_collection, $users) {
			foreach ($data as $x)
			{
				DB::collection($new_collection)->insert([
						'title'				=> $x['title'],
						'slug'				=> $x['url'],
						'summary'			=> str_limit(strip_tags($x['full'],200)),
						'content'			=> $x['full'],
						'published_at' 		=> $x['tgl_published'],
						'created_at' 		=> $x['tgl'],
						'author'			=> new MongoId(!str_is('admin', $x['author']) ? $users[$x['author']]['_id'] : $users['dita']['_id']) ,
						'images'			=> 	[
													'thumbnail'	=> $x['thumbnail'],
													'xs'		=> $x['image'],
													'sm'		=> $x['image'],
													'md'		=> $x['image'],
													'lg'		=> $x['image'],
												],
						'views'				=> (isset($x['views']) ? $x['views'] : 0),
					]);
			}
		});


		// save to new tables
	}

	protected function migrate_events()
	{
		$old_collection = 'posts';
		$new_collection = 'v2_events';

		$data_users = DB::collection('v2_users')->get();
		foreach ($data_users as $user)
		{
			$users[$user['username']] = $user;
		}

		// get old articles
		DB::collection($new_collection)->truncate();
		DB::collection($old_collection)->where('category', 'events')->chunk(1000, function($data) use ($new_collection, $users) {
			foreach ($data as $x)
			{
				$obj = [
						'title'				=> $x['title'],
						'slug'				=> $x['url'],
						'summary'			=> str_limit(strip_tags($x['full'],200)),
						'content'			=> $x['full'],
						'published_at' 		=> $x['tgl_published'],
						'created_at' 		=> $x['tgl'],
						'author'			=> new MongoId($users[$x['author']]['_id']),
						'images'			=> 	[
													'thumbnail'	=> $x['thumbnail'],
													'xs'		=> $x['image'],
													'sm'		=> $x['image'],
													'md'		=> $x['image'],
													'lg'		=> $x['image'],
													'gallery'	=> $x['extra_field']['gallery']
												],
						'started_at'		=> ($x['extra_field']['event_tgl_start']),
						'ended_at'			=> (isset($x['extra_field']['event_tgl_end']) ? $x['extra_field']['event_tgl_end'] : $x['extra_field']['event_tgl_start']),
						'location'			=> (isset($x['extra_field']['event_lokasi']) ? $x['extra_field']['event_lokasi'] : '') ,
						'komunitas'			=> (isset($x['extra_field']['event_komunitas']) ? $x['extra_field']['event_komunitas'] : ''),
						'views'				=> (isset($x['views']) ? $x['views'] : 0),
					];
				DB::collection($new_collection)->insert($obj);
			}
		});


		// save to new tables
	}

	protected function migrate_ads()
	{
		$old_collection = 'posts';
		$new_collection = 'v2_ads';

		$data_users = DB::collection('v2_users')->get();
		foreach ($data_users as $user)
		{
			$users[$user['username']] = $user;
		}

		// get old articles
		DB::collection($new_collection)->truncate();
		$categories = ['mobil', 'motor', 'lowongan', 'property'];
		foreach ($categories as $category)
		{
			DB::collection($old_collection)->where('category', 'like', "iklan\|" . $category ."*")->chunk(1000, function($data) use ($new_collection, $users, $category) {
				foreach ($data as $x)
				{
					$obj = [
							'title'				=> $x['title'],
							'slug'				=> $x['url'],
							'summary'			=> str_limit(strip_tags($x['full'],200)),
							'content'			=> $x['full'],
							'published_at' 		=> $x['tgl_published'],
							'created_at' 		=> $x['tgl'],
							'category'			=> [$category],
							'author'			=> new MongoId($users[$x['author']]['_id']),
							'images'			=> 	[
														'thumbnail'	=> $x['thumbnail'],
														'xs'		=> $x['image'],
														'sm'		=> $x['image'],
														'md'		=> $x['image'],
														'lg'		=> $x['image'],
														'gallery'	=> $x['extra_field']['gallery']
													],
							'views'				=> (isset($x['views']) ? $x['views'] : 0),
						];

					if (str_is('iklan|mobil*', $x['category'][0]))
					{
						if (isset($x['extra_field']['iklan_otomotif_merk']) && !is_null($x['extra_field']['iklan_otomotif_merk']))
						{
							$obj['mobil']->merk			= $x['extra_field']['iklan_otomotif_merk'];
							$obj['mobil']->tipe			= $x['extra_field']['iklan_otomotif_tipe_kend'];
							$obj['mobil']->tahun		= (int)$x['extra_field']['iklan_otomotif_tahun'];
							$obj['mobil']->warna		= $x['extra_field']['iklan_otomotif_warna'];
							$obj['mobil']->transmisi	= str_is('automatic', $x['extra_field']['iklan_otomotif_transmisi']) ? 'A/T' : 'M/T';
							$obj['mobil']->cc			= (int) $x['extra_field']['iklan_otomotif_cc'];
							$obj['mobil']->harga		= $x['extra_field']['iklan_harga'];
						}
						else
						{
							unset($obj);
						}
					}
					elseif (str_is('iklan|motor*', $x['category'][0]))
					{
						if (isset($x['extra_field']['iklan_otomotif_merk']))
						{
							$obj['motor']['merk']		= $x['extra_field']['iklan_otomotif_merk'];
							$obj['motor']['tipe']		= $x['extra_field']['iklan_otomotif_tipe_kend'];
							$obj['motor']['tahun']		= (int)$x['extra_field']['iklan_otomotif_tahun'];
							$obj['motor']['warna']		= $x['extra_field']['iklan_otomotif_warna'];
							$obj['motor']['transmisi']	= str_is('automatic', $x['extra_field']['iklan_otomotif_transmisi']) ? 'A/T' : 'M/T';
							$obj['motor']['cc']		 	= (int) $x['extra_field']['iklan_otomotif_cc'];
							$obj['motor']['harga']		= $x['extra_field']['iklan_harga'];
						}
						else
						{
							unset($obj);
						}
					}
					elseif (str_is('iklan|property*', $x['category'][0]))
					{
						if (isset($x['extra_field']['iklan_property_lt']))
						{
							if (str_is('iklan|property|rumah-dijual', $x['category'][0]))
							{
								$obj['category'] = ['rumah', 'jual'];
							}
							elseif (str_is('iklan|property|rumah-disewakan', $x['category'][0]))
							{
								$obj['category'] = ['rumah', 'sewa'];
							}
							elseif (str_is('iklan|property|tanah-dijual', $x['category'][0]))
							{
								$obj['category'] = ['tanah', 'jual'];
							}
							elseif (str_is('iklan|property|tanah-disewakan', $x['category'][0]))
							{
								$obj['category'] = ['tanah', 'sewa'];
							}
							$obj['property']['lt']			= $x['extra_field']['iklan_property_lt'];
							$obj['property']['lb']			= $x['extra_field']['iklan_property_lb'];
							$obj['property']['kt']			= (int) $x['extra_field']['iklan_property_kt'];
							$obj['property']['km']			= (int) $x['extra_field']['iklan_property_km'];
							$obj['property']['kecamatan']	= $x['extra_field']['iklan_property_kecamatan'];
							$obj['property']['longlat']		= $x['extra_field']['directory_map'];
							$obj['property']['harga']		= $x['extra_field']['iklan_harga'];
						}
						else
						{
							unset($obj);
						}
					}
					elseif (str_is('iklan|lowongan*', $x['category'][0]))
					{
						if (isset($x['extra_field']['iklan_lowongan_company']))
						{
							$obj['lowongan']['company']		= $x['extra_field']['iklan_lowongan_company'];
							$obj['lowongan']['posisi']		= $x['extra_field']['iklan_lowongan_posisi'];
							$obj['lowongan']['start']		= $x['published_at'];
							$obj['lowongan']['end']			= \Carbon\Carbon::parse($x['published_at'])->addMonth(1);
						}
						else
						{
							unset($obj);
						}
					}
					if (isset($obj))
					{
						DB::collection($new_collection)->insert($obj);
					}
				}
			});
		}


		// save to new tables
	}
}
