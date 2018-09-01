<?php

namespace App\Controllers;

use Framework\View;

class TestController
{
    public function test()
    {
        return 'Hello Doge!';
    }

    public function hello($userName = 'Doge')
    {
        return 'Hello ' . $userName;
    }

    public function view($userName = 'Artem')
    {
        View::render('test', ['userName' => $userName]);
    }
}