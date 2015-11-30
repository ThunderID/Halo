<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use DB;
use MongoId, MongoDate, MongoRegex, \Hash;
use \App\Jobs\StoreWebsite, \App\Jobs\AssignImage, \App\Jobs\TagContent, \App\Jobs\AddContentToWebsite;
use \App\Models\User;
use \App\Models\Content;
use \App\Models\Website;
use \App\Models\Image;
use \App\Models\Tag;
use Illuminate\Foundation\Bus\DispatchesJobs;

class newHalo extends Command
{
	use DispatchesJobs;
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
		// --------------------------------------------------------
		// WEBSITE
		// --------------------------------------------------------
		$this->info('* Migrate website...');
		$this->migrate_website();
		
		// --------------------------------------------------------
		// USER
		// --------------------------------------------------------
		$this->info('* Migrate user...');
		$this->migrate_user();

		$this->info('* Migrate news...');
		$this->migrate_news();

		// $this->info('* Migrate serba-serbi...');
		// $this->migrate_news();

		// $this->info('* Migrate event...');
		// $this->migrate_events();

		// $this->info('* Migrate ads...');
		// $this->migrate_ads();
	}

	protected function migrate_website()
	{
		Website::truncate();

		$s_image = new Image(['name' => 'sm', 'path' => 'http://drive.thunder.id', 'title' => 'Logo', 'description' => '']);
		$m_image = new Image(['name' => 'md', 'path' => 'http://drive.thunder.id', 'title' => 'Logo', 'description' => '']);
		$l_image = new Image(['name' => 'lg', 'path' => 'http://drive.thunder.id', 'title' => 'Logo', 'description' => '']);

		$website = new Website(['name' 			=> 'HaloMalang', 
								'url'			=> 'http://halomalang.com', 
								'launched_at' 	=> \Carbon\Carbon::parse("2012-03-01"),
								'facebook'		=> 'halomalangcom',	
								'twitter'		=> 'halomalangcom',	
								'instagram'		=> 'halomalangcom',	
								]);
		if (!$website->save())
		{
			$this->error($website->getErrors());
		}

		$website->images()->updateOrCreate(['name' => 'small'], $s_image->toArray());
		$website->images()->updateOrCreate(['name' => 'medium'], $m_image->toArray());
		$website->images()->updateOrCreate(['name' => 'large'], $l_image->toArray());
	}

	protected function migrate_user()
	{
		$old_collection = 'users';
		$new_collection = 'v2_users';
		$website = Website::first();

		// get old articles
		User::truncate();

		DB::connection('mysql')->table('works')->truncate();
		DB::connection('mongodb')->collection($old_collection)->chunk(1000, function($data) use ($new_collection, $website) {

			foreach ($data as $x)
			{
				$user = new User([
						'name'				=> (isset($x['name']) ? $x['name'] : $x['username']),
						'username'			=> $x['username'],
						'email'				=> (isset($x['email']) ? $x['email'] : ''),
						'password'			=> \Hash::make('123123'),
					]);

				if ($user->save())
				{
					$user->works()->attach($website, ['start_at' => \Carbon\Carbon::now(), 'end_at' => null, 'role' => 'writer']);
				}
			}
		});
		$user = new User([
				'name'				=> "Erick Mo",
				'username'			=> "erickmo",
				'email'				=> "mo@thunderlab.id",
				'password'			=> \Hash::make('123123'),
			]);

		if ($user->save())
		{
			$user->works()->attach($website, ['start_at' => \Carbon\Carbon::now(), 'end_at' => null, 'role' => 'super']);
		}
	}

	protected function migrate_news()
	{
		$website = Website::first();

		$data_users = User::get();
		foreach ($data_users as $user)
		{
			$users[$user['username']] = $user;
		}

		Content::truncate();

		// get old articles
		DB::connection('mongodb')->collection('posts')->where('category', 'regex','/news/i')->chunk(1000, function($data) use ($new_collection, $users, $website) {
			foreach ($data as $x)
			{
				unset($tags);
				$tags[] = 'news';
				if (str_is('*arema*', strtolower($x['title'])) || str_is('*isl*', strtolower($x['title'])) || str_is('*ipl*', strtolower($x['title'])) || str_is('*cronus*', strtolower($x['title'])))
				{
					$tags[] = 'arema';
				}
				if (str_is('*persema*', strtolower($x['title'])))
				{
					$tags[] = 'persema';
				}
				if (str_is('*[lipsus]*', strtolower($x['title'])))
				{
					$tags[] = 'lipsus';
				}
				if (str_is('*[press release]*', strtolower($x['title'])))
				{
					$tags[] = 'press release';
				}
				if (str_is('*gempa*', strtolower($x['title'])))
				{
					$tags[] = 'press release';
				}
				if (str_is('*pilkada*', strtolower($x['title'])))
				{
					$tags[] = 'pilkada';
				}
				if (str_is('*halo malang*', strtolower($x['title'])) || str_is('*halomalang*', strtolower($x['title'])))
				{
					$tags[] = 'halomalang';
				}
				if (str_is('*wisata*', strtolower($x['title'])) || str_is('*halomalang*', strtolower($x['title'])))
				{
					$tags[] = 'wisata';
				}
				if (str_is('*beasiswa*', strtolower($x['title'])) || str_is('*guru*', strtolower($x['title'])) || str_is('*pendidikan*', strtolower($x['title'])))
				{
					$tags[] = 'pendidikan';
				}
				if (str_is('*bpjs*', strtolower($x['title'])))
				{
					$tags[] = 'bpjs';
				}

				if ($x['tgl_published'])
				{
					$news = new Content([
							'title'				=> $x['title'],
							'slug'				=> str_replace('.','',$x['url']),
							'summary'			=> str_limit(strip_tags(str_replace("\n", "", $x['full'])),125),
							'content'			=> $x['full'],
							'published_at' 		=> date('Y-m-d H:i:s', $x['tgl_published']->sec),
							'created_at' 		=> $x['tgl'],
							'updated_at' 		=> $x['tgl'],
							'user_id'			=> array_key_exists($x['author'], $users) ? $users[$x['author']]->id : $users['dita']->id,
						]);

					if (!$news->save())
					{
						print_r($news->toArray());	
						dd($news->getErrors());
					}
					
					// ----------------------------------------------------------------------------------------------------
					// IMAGE
					// ----------------------------------------------------------------------------------------------------
					$s_image = new Image(['name' => 'small', 'path' => $x['thumbmail'], 'title' => '', 'description' => '']);
					$m_image = new Image(['name' => 'medium', 'path' => $x['image'], 'title' => '', 'description' => '']);
					$l_image = new Image(['name' => 'large', 'path' => $x['image'], 'title' => '', 'description' => '']);

					$news->images()->updateOrCreate(['name' => 'small'], $s_image->toArray());
					$news->images()->updateOrCreate(['name' => 'medium'], $m_image->toArray());
					$news->images()->updateOrCreate(['name' => 'large'], $l_image->toArray());

					// ----------------------------------------------------------------------------------------------------
					// TAG
					// ----------------------------------------------------------------------------------------------------
					unset($tags_model);
					$tags_model = new Collection;
					foreach ($tags as $tag)
					{
						$tags_model[] = Tag::firstOrCreate(['name' => $tag]);
					}
					foreach ($tags_model as $k => $v)
					{
						if (!$tags_model[$k]->save())
						{
							dd($tags_model[$k]->getErrors());
						}
					}

					if (count($tags_model))
					{
						$news->tags()->sync($tags_model->lists('id'));
					}

					// ----------------------------------------------------------------------------------------------------
					// WEBSITE
					// ----------------------------------------------------------------------------------------------------
					$news->websites()->sync([$website->id]);

					// ----------------------------------------------------------------------------------------------------
					// LOG
					// ----------------------------------------------------------------------------------------------------
					// $news->authored()->attach(array_key_exists($x['author'], $users) ? $users[$x['author']]->id : $users['dita']->id, ['original_data' => json_encode([]), 'updated_data' => $news->toJson()]);
				}

				// $news->websites()->associate($website);
				// $news->save();
			}
		});


		// save to new tables
	}

	// protected function migrate_events()
	// {
	// 	$old_collection = 'posts';
	// 	$new_collection = 'v2_events';

	// 	$data_users = DB::collection('v2_users')->get();
	// 	foreach ($data_users as $user)
	// 	{
	// 		$users[$user['username']] = $user;
	// 	}

	// 	// get old articles
	// 	DB::collection($new_collection)->truncate();
	// 	DB::collection($old_collection)->where('category', 'events')->chunk(1000, function($data) use ($new_collection, $users) {
	// 		foreach ($data as $x)
	// 		{
	// 			$obj = [
	// 					'title'				=> $x['title'],
	// 					'slug'				=> $x['url'],
	// 					'summary'			=> str_limit(strip_tags($x['full'],200)),
	// 					'content'			=> $x['full'],
	// 					'published_at' 		=> $x['tgl_published'],
	// 					'created_at' 		=> $x['tgl'],
	// 					'author'			=> new MongoId($users[$x['author']]['_id']),
	// 					'images'			=> 	[
	// 												'thumbnail'	=> $x['thumbnail'],
	// 												'xs'		=> $x['image'],
	// 												'sm'		=> $x['image'],
	// 												'md'		=> $x['image'],
	// 												'lg'		=> $x['image'],
	// 												'gallery'	=> $x['extra_field']['gallery']
	// 											],
	// 					'started_at'		=> ($x['extra_field']['event_tgl_start']),
	// 					'ended_at'			=> (isset($x['extra_field']['event_tgl_end']) ? $x['extra_field']['event_tgl_end'] : $x['extra_field']['event_tgl_start']),
	// 					'location'			=> (isset($x['extra_field']['event_lokasi']) ? $x['extra_field']['event_lokasi'] : '') ,
	// 					'komunitas'			=> (isset($x['extra_field']['event_komunitas']) ? $x['extra_field']['event_komunitas'] : ''),
	// 					'views'				=> (isset($x['views']) ? $x['views'] : 0),
	// 				];
	// 			DB::collection($new_collection)->insert($obj);
	// 		}
	// 	});


	// 	// save to new tables
	// }

	// protected function migrate_ads()
	// {
	// 	$old_collection = 'posts';
	// 	$new_collection = 'v2_ads';

	// 	$data_users = DB::collection('v2_users')->get();
	// 	foreach ($data_users as $user)
	// 	{
	// 		$users[$user['username']] = $user;
	// 	}

	// 	// get old articles
	// 	DB::collection($new_collection)->truncate();
	// 	$categories = ['mobil', 'motor', 'lowongan', 'property'];
	// 	foreach ($categories as $category)
	// 	{
	// 		DB::collection($old_collection)->where('category', 'like', "iklan\|" . $category ."*")->chunk(1000, function($data) use ($new_collection, $users, $category) {
	// 			foreach ($data as $x)
	// 			{
	// 				$obj = [
	// 						'title'				=> $x['title'],
	// 						'slug'				=> $x['url'],
	// 						'summary'			=> str_limit(strip_tags($x['full'],200)),
	// 						'content'			=> $x['full'],
	// 						'published_at' 		=> $x['tgl_published'],
	// 						'created_at' 		=> $x['tgl'],
	// 						'category'			=> [$category],
	// 						'author'			=> new MongoId($users[$x['author']]['_id']),
	// 						'images'			=> 	[
	// 													'thumbnail'	=> $x['thumbnail'],
	// 													'xs'		=> $x['image'],
	// 													'sm'		=> $x['image'],
	// 													'md'		=> $x['image'],
	// 													'lg'		=> $x['image'],
	// 													'gallery'	=> $x['extra_field']['gallery']
	// 												],
	// 						'views'				=> (isset($x['views']) ? $x['views'] : 0),
	// 					];

	// 				if (str_is('iklan|mobil*', $x['category'][0]))
	// 				{
	// 					if (isset($x['extra_field']['iklan_otomotif_merk']) && !is_null($x['extra_field']['iklan_otomotif_merk']))
	// 					{
	// 						$obj['mobil']->merk			= $x['extra_field']['iklan_otomotif_merk'];
	// 						$obj['mobil']->tipe			= $x['extra_field']['iklan_otomotif_tipe_kend'];
	// 						$obj['mobil']->tahun		= (int)$x['extra_field']['iklan_otomotif_tahun'];
	// 						$obj['mobil']->warna		= $x['extra_field']['iklan_otomotif_warna'];
	// 						$obj['mobil']->transmisi	= str_is('automatic', $x['extra_field']['iklan_otomotif_transmisi']) ? 'A/T' : 'M/T';
	// 						$obj['mobil']->cc			= (int) $x['extra_field']['iklan_otomotif_cc'];
	// 						$obj['mobil']->harga		= $x['extra_field']['iklan_harga'];
	// 					}
	// 					else
	// 					{
	// 						unset($obj);
	// 					}
	// 				}
	// 				elseif (str_is('iklan|motor*', $x['category'][0]))
	// 				{
	// 					if (isset($x['extra_field']['iklan_otomotif_merk']))
	// 					{
	// 						$obj['motor']['merk']		= $x['extra_field']['iklan_otomotif_merk'];
	// 						$obj['motor']['tipe']		= $x['extra_field']['iklan_otomotif_tipe_kend'];
	// 						$obj['motor']['tahun']		= (int)$x['extra_field']['iklan_otomotif_tahun'];
	// 						$obj['motor']['warna']		= $x['extra_field']['iklan_otomotif_warna'];
	// 						$obj['motor']['transmisi']	= str_is('automatic', $x['extra_field']['iklan_otomotif_transmisi']) ? 'A/T' : 'M/T';
	// 						$obj['motor']['cc']		 	= (int) $x['extra_field']['iklan_otomotif_cc'];
	// 						$obj['motor']['harga']		= $x['extra_field']['iklan_harga'];
	// 					}
	// 					else
	// 					{
	// 						unset($obj);
	// 					}
	// 				}
	// 				elseif (str_is('iklan|property*', $x['category'][0]))
	// 				{
	// 					if (isset($x['extra_field']['iklan_property_lt']))
	// 					{
	// 						if (str_is('iklan|property|rumah-dijual', $x['category'][0]))
	// 						{
	// 							$obj['category'] = ['rumah', 'jual'];
	// 						}
	// 						elseif (str_is('iklan|property|rumah-disewakan', $x['category'][0]))
	// 						{
	// 							$obj['category'] = ['rumah', 'sewa'];
	// 						}
	// 						elseif (str_is('iklan|property|tanah-dijual', $x['category'][0]))
	// 						{
	// 							$obj['category'] = ['tanah', 'jual'];
	// 						}
	// 						elseif (str_is('iklan|property|tanah-disewakan', $x['category'][0]))
	// 						{
	// 							$obj['category'] = ['tanah', 'sewa'];
	// 						}
	// 						$obj['property']['lt']			= $x['extra_field']['iklan_property_lt'];
	// 						$obj['property']['lb']			= $x['extra_field']['iklan_property_lb'];
	// 						$obj['property']['kt']			= (int) $x['extra_field']['iklan_property_kt'];
	// 						$obj['property']['km']			= (int) $x['extra_field']['iklan_property_km'];
	// 						$obj['property']['kecamatan']	= $x['extra_field']['iklan_property_kecamatan'];
	// 						$obj['property']['longlat']		= $x['extra_field']['directory_map'];
	// 						$obj['property']['harga']		= $x['extra_field']['iklan_harga'];
	// 					}
	// 					else
	// 					{
	// 						unset($obj);
	// 					}
	// 				}
	// 				elseif (str_is('iklan|lowongan*', $x['category'][0]))
	// 				{
	// 					if (isset($x['extra_field']['iklan_lowongan_company']))
	// 					{
	// 						$obj['lowongan']['company']		= $x['extra_field']['iklan_lowongan_company'];
	// 						$obj['lowongan']['posisi']		= $x['extra_field']['iklan_lowongan_posisi'];
	// 						$obj['lowongan']['start']		= $x['published_at'];
	// 						$obj['lowongan']['end']			= \Carbon\Carbon::parse($x['published_at'])->addMonth(1);
	// 					}
	// 					else
	// 					{
	// 						unset($obj);
	// 					}
	// 				}
	// 				if (isset($obj))
	// 				{
	// 					DB::collection($new_collection)->insert($obj);
	// 				}
	// 			}
	// 		});
	// 	}


	// 	// save to new tables
	// }
}
