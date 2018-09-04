<?php

/*
Этот файл хранит в себе конфиги нашего роутера
*/

use Framework\Router;

Router::group(['namespace' => '\App\Controllers'], function () {
    Router::get('/','TestController@welcome');
    Router::get('/hello/{userName?}','TestController@hello');
    Router::get('/404','ErrorsController@error404');
    Router::get('/register','RegisterController@register');
    Router::get('/login','LoginController@login');
    Router::get('/login/forgotpass','ForgotPassController@forgotpass');
    Router::get('/profile/{userName}','ProfileController@profile');
    Router::get('/feed','FeedController@feed');
    Router::get('/settings','SettingsController@settings');
});