<?php

namespace App;

class Router
{
    protected $routes = [];

    private function error($error)
    {
        include "Views/error.php";
        die();
    }
    private function define($uri, $controller, $action, $method)
    {
        $this->routes[$uri][$method] = ['controller' => $controller, 'action' => $action];
    }
    public function dispatch($uri)
    {
        if (isset ($this->routes[$uri])) {
            if (isset ($this->routes[$uri][$_SERVER['REQUEST_METHOD']])) {
                $controller = $this->routes[$uri][$_SERVER['REQUEST_METHOD']]['controller'];
                $action = $this->routes[$uri][$_SERVER['REQUEST_METHOD']]['action'];
                $controller = new $controller();
                $controller->$action();
            } else {
                $this->error("Method not allowed");
            }
        } else {
            $this->error("Page not found");
        }
    }

    public function get(string $uri, string $controller, string $action)
    {
        $this->define($uri, $controller, $action, 'GET');
    }

    public function delete(string $uri, string $controller, string $action)
    {
        $this->define($uri, $controller, $action, 'DELETE');
    }

    public function post(string $uri, string $controller, string $action)
    {
        $this->define($uri, $controller, $action, 'POST');
    }

}