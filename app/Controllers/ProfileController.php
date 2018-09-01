<?php

namespace App\Controllers;

use Framework\View;

class ProfileController
{
    public function profile($userName)
    {
        View::render('profile', ['userName' => $userName]);
    }
}