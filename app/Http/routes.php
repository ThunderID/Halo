<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
View::composer('*', function($view){
    View::share('widget_name', $view->getName());
});


include 'routes_halomalang.php';
include 'routes_cms.php';
