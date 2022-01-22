<?php

namespace App\Http\Kernel\Router;

use App\Http\Kernel\Request;

class Router
{
    private $request;
    private $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function route(string $path, $handler)
    {
        $this->routes[] = new Route($path, $handler);
    }

    /**
     * @throws \Exception
     */
    public function dispatch()
    {
        $path = $this->request->getPath();
        foreach ($this->routes as $route) {
            $match = $route->matches($path);
            if ($match === false) continue;

            $callback = $route->handler;
            if (is_array($callback)) {
                list($className, $action) = $callback;
                $controller = new $className;
                $callback = [$controller, $action];
            }

            return call_user_func_array($callback, $match);
        }

        throw new \Exception("Route not found");
    }
}
