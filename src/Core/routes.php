<?php

use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\RegisterController;

$routes = [
    '/' => [
        'GET' => [HomeController::class, 'index']
    ],
    '/login' => [
        'GET' => [AuthController::class, 'index'],
        'POST' => [AuthController::class, 'login']
    ],
    '/logout' => [
        'GET' => [AuthController::class, 'logout']
    ],
    '/signin' => [
        'GET' => [RegisterController::class, 'index'],
        'POST' => [RegisterController::class, 'signin']
    ]
];
