<?php

namespace App\Controllers;

use Framework\View;

class LoginController
{
    public function login()
    {
        View::render('login');
    }
}