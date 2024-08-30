<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Hector Jaime Rondon Castillo <hecjairon@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);


use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\ExchangeController;

require __DIR__ . '/../vendor/autoload.php';

$routes = new RouteCollection();

$routes->add(
    'exchange', 
    new Route(
        '/exchange/{amount}/{from}/{to}/{rate}',
        [ 
            '_controller' => [ExchangeController::class, 'exchange'],
            'amount' => null,
            'from' => null,
            'to' => null,
            'rate' => null
        ]
    )
);

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

$request = Request::createFromGlobals();

try {
    $parameters = $matcher->match($request->getPathInfo());
    $controller = $parameters['_controller'];

    if (is_array($controller) && isset($controller[0]) && isset($controller[1])) {
        $controllerInstance = new $controller[0]();
        $method = $controller[1];
        
        if (method_exists($controllerInstance, $method)) {
            $request = Request::createFromGlobals();
            $response = call_user_func_array(
                [$controllerInstance, $method], 
                array_values($parameters)
            );
            $response->send();
        } else {
            throw new Exception('Método não definido.');
        }
    } else {
        throw new Exception('Controller não definida.');
    }
} catch (Exception $e) {
    $data = [
        "message" => "requisição inválida",
        'error' => $e->getMessage() ];
    $response = new JsonResponse($data, 400);
    $response->send();
}
