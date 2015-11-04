<?php

Route::group(['namespace' => '\CMS'], function(){
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// LOGIN
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	get('/', ['uses' => 'LoginController@show' ,'as' => 'cms.login']);
	post('/', ['uses' => 'LoginController@postLogin' ,'as' => 'cms.login.post']);
	get('/logout', ['uses' => 'LoginController@logout' ,'as' => 'cms.logout']);

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// DASHBOARD
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	Route::group(['prefix' => 'dashboard'], function(){
		get('/', ['uses' => 'DashboardController@index', 'as' => 'cms.dashboard']);
	});

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// SETTINGS
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	Route::group(['prefix' => 'settings'], function(){

		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		// CITIES
		// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		Route::controller('website', 'WebsiteController', [
					'getIndex'		=> 'cms.website',
					'getCreate'		=> 'cms.website.create',
					'postStore'		=> 'cms.website.store',
					'getEdit'		=> 'cms.website.edit',
					'getUpdate'		=> 'cms.website.update',
					'getShow'		=> 'cms.website.show',
					'putDelete'		=> 'cms.website.delete',
				]);
	});
});