<?php

namespace App\Controllers;

use Framework\View;

class TestController
{
    public function welcome()
    {
        View::render('welcome');
    }

    public function hello($userName = 'Doge')
    {
        return 'Hello ' . $userName;
    }

    public function error404()
    {
        View::render('404');
    }
}