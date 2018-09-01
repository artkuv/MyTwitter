<?php

/*
Этот файл хранит в себе конфиги нашего роутера
*/

use Framework\Router;

Router::group(['namespace' => '\App\Controllers'], function () {
    Router::get('/','TestController@welcome');
    Router::get('/hello/{userName?}','TestController@hello');
    Router::get('/404','TestController@error404');
    Router::get('/register','RegisterController@register');
    Router::get('/login','RegisterController@login');
    Router::get('/login/forgotpass','RegisterController@forgotpass');
    Router::get('/profile/{userName}','UserController@profile');
    Router::get('/feed','UserController@feed');
});