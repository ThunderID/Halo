<?php

Route::group(['namespace' => '\API'], function(){
	Route::resource('/website', 'WebsiteController');
});