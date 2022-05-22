<?php

namespace App\Common;

use App\Common\Http\Request;
use App\Common\Http\Response;

class Router
{
    use RouterTrait;

    private $routes;
    private $request;
    private $response;
    private $args;
    private $route;
    private $error;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    /**
     * Optei por não permitir Closures (funções anônimas) pois não as utilizaria
     */
    public function get(string $route, string $handler)
    {
        $this->routes["GET"][$route] = [
            "route" => $this->parseUrl($route),
            "handler" => $handler
        ];
    }

    public function run()
    {
        if (!key_exists($this->request->getMethod(), $this->routes)) {
            $this->error = 405;
            return;
        }

        foreach ($this->routes[$this->request->getMethod()] as $key => $route) {
            $this->matchRoutes($key, $route);
        }

        if (empty($this->args) && !$this->issetRoute($this->request->getUri())) {
            $this->error = 400;
            return;
        }

        $this->normalizeArgs($this->args, $this->route);
        $controller = new $this->routes[$this->request->getMethod()][$this->route]["handler"]();
        $controller->handle($this->request, $this->response, $this->args);
    }

    private function issetRoute($route)
    {
        if (array_key_exists($route, $this->routes[$this->request->getMethod()])) {
            $this->args = [
                "route" => $route,
                "args" => []
            ];

            return true;
        }

        return false;
    }

    private function matchRoutes($key, $route)
    {
        if (strpos($key, "{") && preg_match_all('~' . $route['route'] . '~', $this->request->getUri(), $matches)) {
            unset($matches[0]);
            $this->args = [
                "route" => $key,
                "args" => $matches
            ];
        }
    }

    public function error()
    {
        return $this->error;
    }
}
