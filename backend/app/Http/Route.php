<?php

namespace App\Http;

class Route
{
    private static $routes = [];

    public static function add($method, $path, $action)
    {
        self::$routes[strtoupper($method)][] = ['path' => $path, 'action' => $action, 'params' => []];
    }

    public static function run($requestUri, $requestMethod)
    {
        foreach (self::$routes[strtoupper($requestMethod)] as $route) {
            $pathRegex = preg_replace('/\{[^}]+\}/', '([^/]+)', $route['path']);
            if (preg_match('#^' . $pathRegex . '$#', $requestUri, $matches)) {
                array_shift($matches); // Remove the full match result

                [$controller, $method] = explode('@', $route['action']);
                $controller = "App\\Controllers\\$controller";

                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    if (method_exists($controllerInstance, $method)) {
                        return $controllerInstance->$method(...$matches);
                    } else {
                        throw new \Exception("Method $method not found in $controller");
                    }
                } else {
                    throw new \Exception("Controller $controller not found");
                }
            }
        }

        // If no route matched
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
        exit;
    }
}
