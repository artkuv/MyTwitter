<?php

namespace App\Controllers;

use Framework\View;

class UserController
{
    public function profile()
    {
        View::render('profile');
    }

    public function feed()
    {
        View::render('feed');
    }
}