<?php

namespace App\Http\Kernel\Router;

class Route
{
    public $path;
    public $handler;

    public function __construct(string $path, $handler)
    {
        $this->path = $path;
        $this->handler = $handler;
    }

    public function matches($requestPath)
    {
        $routeParts = explode('/', $this->path);
        $requestParts = explode('/', $requestPath);
        if (count($routeParts) != count($requestParts)) {
            return false;
        }

        $parameters = [];
        foreach ($routeParts as $key => $routePart) {
            if (preg_match("/^[{]/", $routePart)) {
                $parameters[] = $requestParts[$key];
            } elseif ($routePart != $requestParts[$key]){
                return false;
            }
        }

        return $parameters;
    }
}
