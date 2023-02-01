<?php

namespace Hikaru\MVC\Crowdfunding\App;

class Router {

    public static array $routes = [];

    public static function add(string $method,
                               string $path,
                               string $controller,
                               string $function,
                               array $middlewares = []) : void {

        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middlewares' => $middlewares
        ];


    }

    public static function run() : void {

        // url routing, default /
        $path = '/';


        if (isset($_SERVER['PATH_INFO'])) {
            $path =  $_SERVER['PATH_INFO'];
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            // patern regex di url path untuk mengantikan query param
            $pattern = '#^' . $route['path'] . '$#';

            if (preg_match($pattern, $path, $variables) && $method == $route['method']) {

                // management controller
                $function = $route['function'];
                $controller = new $route['controller'];

                // call middleware
                foreach ($route['middlewares'] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }

                array_shift($variables);
                call_user_func_array([$controller, $function], $variables);

                return;
            }
        }

        http_response_code(404);
        require_once __DIR__ . '/../View/Error/not-found-handler.php';

    }
}
