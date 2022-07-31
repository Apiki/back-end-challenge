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
 * @author   Seu Nome <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Application;
use App\Request;
use App\Response;
use App\Router;
use App\Exchange;

$app = new Application(dirname(__DIR__));


$app->run(
/**
 * @param Request $request
 * @param Response $response
 * @param Router $router
 * @return false|string
 */ function (Request $request, Response $response, Router $router) {
    if (
        $router->checkIsParamNull(['qty', 'from', 'to', 'rate'])
        || $router->checkIsParamNull(['from', 'to', 'rate'])
        || $router->checkIsParamNull(['to', 'rate'])
        || $router->checkIsParamNull(['rate'])
    ) {
        $response->setStatusCode(400);
        $response->json(['message' => 'como en las favelas']);
    }

    $qtyParam = $router->routeParams['qty'];
    $rateParam = $router->routeParams['rate'];

    if (!is_numeric($qtyParam) || !is_numeric($rateParam)) {
        $response->setStatusCode(400);
        return $response->json(['message' => 'BAD REQUEST']);
    }

    $qty = (float)$qtyParam;
    $rate = (float)$rateParam;

    if ($qty < 0 || $rate < 0) {
        $response->setStatusCode(400);
        return $response->json(['message' => 'BAD REQUEST']);
    }

    $from = $router->routeParams['from'];
    $to = $router->routeParams['to'];

    $exchange = new Exchange($qty, $from);

    if (!$exchange->isValidCurrency($from) || !$exchange->isValidCurrency($to)) {
        $response->setStatusCode(400);
        return $response->json(['message' => 'BAD REQUEST']);
    }

    $responseData = [
        'valorConvertido' => (string)$exchange->convert($to, $rate),
        'simboloMoeda' => $exchange->getCurrencySymbol($to)
    ];

    return $response->json($responseData);
}
);
