<?php

namespace App\Core;

include __DIR__ . '/routes.php';


class Router
{
    /**
     * @var array
     */
    protected array $routes;

    /**
     * @var string
     */
    protected string $path;

    /**
     * @param string $uri
     * @param array $routes
     */
    public function __construct(string $uri, array $routes)
    {
        $this->getPath($uri);
        $this->routes = $routes;
    }

    /**
     * Recebe URI, geralmente o da $_SERVER['REQUEST_URI'] e limpa, sem nome de arquivo
     * @param string $uri
     * @return void
     */
    protected function getPath(string $uri): void
    {
        $this->path = str_replace('index.php', '', parse_url($uri, PHP_URL_PATH));
        $this->path = str_replace('.php', '', $this->path);
    }

    /**
     * Recebe o metodo recebido pelo servidor, e faz um loop sobre o array de routes
     * @param string $method
     * @return void
     */
    public function run(string $method): void
    {
        if (isset($this->routes[$this->path][$method])){
            [$controller, $action] = $this->routes[$this->path][$method];
            $controller::$action();
        }else{
            echo "404 - Página não encontrada";
        }

    }

}