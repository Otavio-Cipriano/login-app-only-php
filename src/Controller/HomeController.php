<?php

namespace App\Controller;

use App\Core\View;

class HomeController
{
    public static function index(): void
    {
        session_start();
        if(empty($_SESSION['user'])){
            header('Location: /login');
            exit();
        }
        $user = $_SESSION['user'];
        $view = new View();
        $view->render('home', params: [...$user]);
    }
}