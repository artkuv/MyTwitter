<?php

/*
Этот файл хранит в себе конфиги нашего роутера
*/

use Framework\Router;

Router::group(['namespace' => '\App\Controllers'], function () {
    Router::get('/public/','TestController@welcome');
    Router::get('/public/hello/{userName?}','TestController@hello');
    Router::get('/public/404','ErrorsController@error404');
    Router::get('/public/register','RegisterController@register');
    Router::get('/public/login','LoginController@login');
    Router::get('/public/login/forgotpass','ForgotPassController@forgotpass');
    Router::get('/public/profile/{userName}','ProfileController@profile');
    Router::get('/public/feed','FeedController@feed');
    Router::get('/public/settings','SettingsController@settings');
});