<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.0
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Diego Camilo Da Silva <dcs.silva22@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/exchange/{amount}/{from}/{to}/{rate}', 'App\\Controller\\Convert/conversion');
});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo json_encode(["message" => "Bad Request"]);
        http_response_code(400);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo json_encode(["message" => "Method Not Allowed"]);
        http_response_code(405);
        break;
    case FastRoute\Dispatcher::FOUND:
        list($class, $method) = explode("/", $routeInfo[1], 2);
        call_user_func_array(array(new $class, $method), $routeInfo[2]);
        break;
}