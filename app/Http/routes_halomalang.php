<?php

Route::group(['namespace' => '\HaloMalang'], function(){
	get('/',		['uses' => 'HomeController@index', 'as' => 'halomalang.home']);
});