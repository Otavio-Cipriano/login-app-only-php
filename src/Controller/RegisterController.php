<?php

namespace App\Controller;

use App\Core\View;

class RegisterController
{
    public static function index(): void
    {
        $view = new View();
        $view->render('signin');
    }
}