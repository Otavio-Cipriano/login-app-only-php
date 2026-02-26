<?php

require __DIR__ . '/../vendor/autoload.php'; // Composer autoload

use App\Core\Router;

require __DIR__ . '/../src/Core/routes.php';


$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

/** @var $routes */
$router = new Router($uri, $routes);

$router->run($method);