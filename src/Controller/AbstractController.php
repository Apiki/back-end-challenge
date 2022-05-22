<?php

namespace App\Controller;

use App\Kernel\Http\AbstractResponse;
use App\Kernel\Router;

abstract class AbstractController
{
    protected static $prefix = null;

    protected function route(array $routes): ?AbstractResponse
    {
        $router = new Router($routes);
        return $router->run();
    }

    public static function getPrefix()
    {
        return static::$prefix;
    }
}
