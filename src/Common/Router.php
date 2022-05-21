<?php

namespace App\Common;

use App\Common\Http\Request;
use App\Common\Http\Response;

class Router
{
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

        if (empty($this->args)) {
            $this->error = 404;
            return;
        }

        $this->normalizeArgs();
        $controller = new $this->routes[$this->request->getMethod()][$this->route]["handler"]();
        $controller->handle($this->request, $this->response, $this->args);
    }

    private function matchRoutes($key, $route)
    {
      if (preg_match_all('~' . $route['route'] . '~', $this->request->getUri(), $matches)) {
          unset($matches[0]);
          $this->args = [
              "route" => $key,
              "args" => $matches
          ];
      }
    }

    private function normalizeArgs()
    {
      preg_match_all("/(\{\w*})/", $this->args["route"], $matches);
      foreach ($matches[0] as $key => $value) {
          $matches[0][$key+1] = $value;
      }
      unset($matches[0][0]);

      $this->route = $this->args["route"];
      foreach ($this->args["args"] as $key => $value) {
          $this->args[ltrim(rtrim($matches[0][$key], "}"), "{")] = $value[0];
      }

      unset($this->args["route"]);
      unset($this->args["args"]);
    }

    private function parseUrl($path)
    {
        $path = str_replace("/", "\/", $path);
        return preg_replace("/(\{\w*})/", "(.*)", $path);
    }

    public function error()
    {
        return $this->error;
    }
}
