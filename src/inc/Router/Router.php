<?php
/**
 * Classe Router
 *
 * A ideia aqui é fazer um FrontController, mesmo que estejamos somente
 * com um endpoint, fiz imaginando uma estrutura que poderia crescer
 *
 * @category Routing
 * @package  Back-end
 * @author   math42gimenez <math42gimenez@gmail.com>
 * @license  MIT License
 * @link     https://example.com
 */
class Router
{
    /**
     * @var array
     */
    private $_routes = [];

    /**
     * Adiciona uma rota
     *
     * @param string $routeStr            A string da rota
     * @param array  $httpMethods         Os métodos HTTP permitidos
     * @param array  $controllerFunction  O controlador e o método associados à rota
     *
     * @return void
     */
    public function add(string $routeStr, array $httpMethods, array $controllerFunction): void
    {
        $controllerClass = $controllerFunction[0];
        $controllerMethod = $controllerFunction[1];
        $controllerFunction = function ($params) use ($controllerClass, $controllerMethod) {
            call_user_func([$controllerClass, $controllerMethod], $params);
        };

        $this->_routes[$routeStr] = [
            'methods' => $httpMethods,
            'controller' => $controllerFunction
        ];
    }

    /**
     * Lida com a requisição atual
     *
     * @return void
     */
    public function handleRequest(): void
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = strtok($url, '?');

        $routeFound = false;
        foreach ($this->_routes as $route => $routeConfig) {
            $controllerFunction = $routeConfig['controller'];
            $routeMethods = $routeConfig['methods'];
            $pattern = $this->_buildPatternFromRoute($route);
            if(!in_array($_SERVER['REQUEST_METHOD'], $routeMethods)){
                continue;
            }
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                preg_match_all('/\{(\w+)\}/', $route, $paramNames);
                $paramNames = $paramNames[1];
                $params = [];
                foreach ($paramNames as $paramName) {
                    $params[$paramName] = $matches[$paramName];
                }
                call_user_func($controllerFunction, $params, $_REQUEST);

                $routeFound = true;
                break;
            }
        }

        if (!$routeFound) {
            jsonResponse([], 400);
        }
    }

    /**
     * Constrói o padrão de regex a partir da rota
     *
     * @param string $route A rota
     *
     * @return string O padrão de regex
     */
    private function _buildPatternFromRoute(string $route): string
    {
        $escapedRoute = str_replace('/', '\/', $route);
        $pattern = preg_replace('/\{(\w+)\}/', '(?<$1>[^\/]+)', $escapedRoute);
        $pattern = '/^' . $pattern . '$/';

        return $pattern;
    }
}