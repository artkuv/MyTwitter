<?php

namespace App\Controllers;

use Framework\View;

class RegisterController
{
    public function register()
    {
        View::render('register');
    }
    
    public function login()
    {
        View::render('login');
    }

    public function forgotpass()
    {
        View::render('forgot-password');
    }
    
    public function empty()
    {
        View::render('empty');
    }
}