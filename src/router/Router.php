<?php

namespace TestApi\router;

class Router{
    protected $routes = [];

    public function create(string $method, string $path, callable $callback){
        $this->routes[$method][$path] = $callback;
    }

    public function init(){
        header('Content-Type: application/json; charset=utf-8');

        $httpMethod = $_SERVER["REQUEST_METHOD"];
        $requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        if (isset($this->routes[$httpMethod])) {
            foreach ($this->routes[$httpMethod] as $path => $callback) {

                $pattern = preg_replace('/\{[a-zA-Z]+\}/', '([a-zA-Z0-9\._-]+)', $path);
                $pattern = str_replace('/', '\/', $pattern);
                $pattern = '/^' . $pattern . '$/';

                if (preg_match($pattern, $requestUri, $matches)) {
                    array_shift($matches);
                    
                    return call_user_func_array($callback, $matches);
                }
            }
        }

        http_response_code(400);
        echo json_encode(['error' => 'Route not found']);
        return;
    }
}