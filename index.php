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
 * @author   Nick Granados <internickbr@gmail.com>
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
    if ($router->isValidRoute()) {
        $response->setStatusCode(400);
        $response->json(['mensagem' => 'a rota é inválida deve ser assim: /exchange/{amount}/{from}/{to}/{rate}']);
    }

    $amountParam = $router->routeParams['amount'];
    $rateParam = $router->routeParams['rate'];

    if (!is_numeric($amountParam) || !is_numeric($rateParam)) {
        $response->setStatusCode(400);
        return $response->json(['mensagem' => 'os valores devem ser numéricos', 'erros' => ["'$amountParam' e '$rateParam' deve ser números"]]);
    }

    $amount = (float)$amountParam;
    $rate = (float)$rateParam;

    if ($amount < 0 || $rate < 0) {
        $response->setStatusCode(400);
        return $response->json(['mensagem' => 'os valores devem ser maiores que 0', 'erros' => ["'$amount' e '$rate' deve ser maior que 0"]]);
    }

    $from = $router->routeParams['from'];
    $to = $router->routeParams['to'];

    $exchange = new Exchange($amount, $from);

    if (!$exchange->isValidCurrency($from) || !$exchange->isValidCurrency($to)) {
        $response->setStatusCode(400);
        return $response->json(['mensagem' => 'moedas inválidas', 'erros' => ["'$from' e '$to' deve ser de USD, BRL ou EUR"]]);
    }

    $responseData = [
        'valorConvertido' => (string)$exchange->convert($rate),
        'simboloMoeda' => $exchange->getCurrencySymbol($to)
    ];

    return $response->json($responseData);
}
);
