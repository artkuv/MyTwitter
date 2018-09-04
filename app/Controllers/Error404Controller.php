<?php

namespace App\Controllers;

use Framework\View;

class ErrorsController
{
    public function error404()
    {
        View::render('404');
    }
}