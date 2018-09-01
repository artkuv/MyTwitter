<?php

namespace App\Controllers;

use Framework\View;

class Error404Controller
{
    public function error404()
    {
        View::render('404');
    }
}