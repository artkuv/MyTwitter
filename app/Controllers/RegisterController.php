<?php

namespace App\Controllers;

use Framework\View;

class RegisterController
{
    public function register()
    {
        View::render('register');
    }
}