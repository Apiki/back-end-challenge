<?php
namespace App\Kernel;

use App\Kernel\Http\AbstractResponse;
use App\Kernel\Http\JsonResponse;

class Router
{
    private $routes = [];
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function run(): ?AbstractResponse
    {
        foreach( $this->routes as $route) {
            if (! $route instanceof Route) {
                throw new \Exception("Not is a route", 1); 
            }

            if($response = $route->execute()) {
                return $response;
            }
        }

        return null;
    }
}
