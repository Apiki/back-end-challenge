<?php

use App\ui\api\CurrencyExchangeController;

use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

$container = new \DI\Container();
AppFactory::setContainer($container);

$app = AppFactory::create();
$app->setBasePath(BASEPATH);
$app->addRoutingMiddleware();

$container = $app->getContainer();
$container->set('CurrencyExchangeController', function (ContainerInterface $c) {
    $currencyExchangeService = $c->get('currencyExchangeService');
    return new CurrencyExchangeController($currencyExchangeService);
});

$app->get('/exchange/[{amount}[/{from}[/{to}[/{rate}]]]]', CurrencyExchangeController::class . ':calculateCurrencyValue');

try {
    $app->run();
} catch (Exception $e) {
    header('Content-Type: application/json');
    http_response_code(404);
    echo json_encode(["status" => 404, "message" => "Resource not found",]);
}
