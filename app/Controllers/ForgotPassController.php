<?php

namespace App\Controllers;

use Framework\View;

class ForgotPassController
{
    public function forgotpass()
    {
        View::render('forgot-password');
    }
}