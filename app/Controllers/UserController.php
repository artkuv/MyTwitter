<?php

namespace App\Controllers;

use Framework\View;

class UserController
{
    public function profile($userName)
    {
        View::render('profile', ['userName' => $userName]);
    }

    public function feed()
    {
        View::render('feed');
    }
}