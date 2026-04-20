<?php

/**
 * Routes endpoints.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Leonardo Silva <leonardosilvadelima534@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App;

/**
 * Routes endpoints.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Leonardo Silva <leonardosilvadelima534@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Router
{
    private array $_routes = [];
    private string $_prefix = '';

    /**
     * Registers a GET route.
     *
     * @param string         $path    Route path pattern.
     * @param callable|array $handler Handler executed when the route matches.
     *
     * @return void
     */
    public function get(string $path, callable|array $handler): void
    {
        $this->_addRoute('GET', $path, $handler);
    }

    /**
     * Registers a POST route.
     *
     * @param string         $path    Route path pattern.
     * @param callable|array $handler Handler executed when the route matches.
     *
     * @return void
     */
    public function post(string $path, callable|array $handler): void
    {
        $this->_addRoute('POST', $path, $handler);
    }

    /**
     * Registers a PUT route.
     *
     * @param string         $path    Route path pattern.
     * @param callable|array $handler Handler executed when the route matches.
     *
     * @return void
     */
    public function put(string $path, callable|array $handler): void
    {
        $this->_addRoute('PUT', $path, $handler);
    }

    /**
     * Registers a DELETE route.
     *
     * @param string         $path    Route path pattern.
     * @param callable|array $handler Handler executed when the route matches.
     *
     * @return void
     */
    public function delete(string $path, callable|array $handler): void
    {
        $this->_addRoute('DELETE', $path, $handler);
    }

    /**
     * Adds a route to the router.
     * 
     * @param string         $method  HTTP method (GET, POST, etc.).
     * @param string         $path    Route path pattern.
     * @param callable|array $handler Handler executed when the route matches.
     *
     * @return void
     */
    private function _addRoute(
        string $method,
        string $path,
        callable|array $handler
    ): void {
        $fullPath = $this->_prefix . $path;
        $pattern = $this->_convertToRegex($fullPath);

        $this->_routes[] = [
            'method'  => $method,
            'path'    => $fullPath,
            'pattern' => $pattern,
            'handler' => $handler,
        ];
    }

    /**
     * Converts a path with placeholders to a regular expression.
     *
     * @param string $path Route path pattern with placeholders.
     * 
     * @return string
     */
    private function _convertToRegex(string $path): string
    {
        $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[^/]+)', $path);
        return '#^' . $pattern . '$#';
    }

    /**
     * Dispatches the incoming request to the appropriate route handler.
     *
     * @return void
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri    = rtrim($uri, '/') ?: '/';

        $partialMatch = false;

        foreach ($this->_routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $this->_callHandler($route['handler'], $params);
                return;
            }

            if ($this->_isPartialMatch($route['path'], $uri)) {
                $partialMatch = true;
            }
        }

        if ($partialMatch) {
            $this->_badRequest();
            return;
        }

        $this->_notFound();
    }

    /**
     * Checks if the URI is a partial match for the route path.
     *
     * @param string $routePath The route path pattern.
     * @param string $uri       The request URI.
     * 
     * @return bool
     */
    private function _isPartialMatch(string $routePath, string $uri): bool
    {
        $staticPrefix = preg_replace('/\/?\{[^}]+\}.*$/', '', $routePath);

        if ($staticPrefix === '' || $staticPrefix === '/') {
            return false;
        }

        return str_starts_with($uri, $staticPrefix);
    }

    /**
     * Handles the 400 Bad Request response.
     *
     * @return void
     */
    private function _badRequest(): void
    {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['erro' => 'Parâmetros inválidos']);
    }

    /**
     * Calls the route handler with the provided parameters.
     *
     * @param callable|array $handler The route handler to call.
     * @param array          $params  The parameters extracted from the URI.
     * 
     * @return void
     */
    private function _callHandler(callable|array $handler, array $params): void
    {
        if (is_callable($handler)) {
            call_user_func_array($handler, array_values($params));
            return;
        }

        if (is_array($handler)) {
            [$class, $method] = $handler;
            $controller = new $class();
            $controller->$method($params);
        }
    }

    /**
     * Handles the 404 Not Found response.
     *
     * @return void
     */
    private function _notFound(): void
    {
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['erro' => '404 - not found']);
    }
}
