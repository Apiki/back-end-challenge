<?php


error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/src/CurrencyConverter.php';
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Currency\CurrencyConverter;
use InvalidArgumentException;

require __DIR__ . '/vendor/autoload.php';

$config = ['settings' => [
    'displayErrorDetails' => true, 
]];

$app = new \Slim\App($config);

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello, World!");
    return $response;
});

$app->get('/exchange/{amount}/{from}/{to}/{rate}', function (Request $request, Response $response, array $args) {
    $amount = $args['amount'];
    $from = $args['from'];
    $to = $args['to'];
    $rate = $args['rate'];

    $converter = new CurrencyConverter($amount, $from, $to, $rate);

    try {
        $converter->validate();
        $data = $converter->convert();
       $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    } catch (InvalidArgumentException $e) {
        $error = ['error' => $e->getMessage()];
     $response->getBody()->write(json_encode($error));
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    }
});

$app->run();