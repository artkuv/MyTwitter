<?php

/*
Этот файл хранит в себе конфиги нашего роутера
*/

use Framework\Router;

Router::group(['namespace' => '\App\Controllers'], function () {
	Router::get('/','TestController@test');
	Router::get('/hello/{userName?}','TestController@hello');
	Router::post('/hello/{userName}','TestController@hello');
});