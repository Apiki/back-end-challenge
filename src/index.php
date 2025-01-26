<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automatizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Wayne Rocha <dev.waynerocha@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

use App\DTO\ApiErrorDTO;
use App\classes\Exchange;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

$app->setBasePath('/exchange');

$app->get('/', function (Request $request, Response $response) {
    $error = (new ApiErrorDTO("1000", 'missing value'))->value();
    $response->getBody()->write(json_encode($error));

    return $response->withStatus(400);
});

$app->get('/{value}', function (Request $request, Response $response, $args) {
    $error = (new ApiErrorDTO("1001", 'missing currency "from"'))->value();
    $response->getBody()->write(json_encode($error));

    return $response->withStatus(400);
});

$app->get('/{value}/{from}', function (Request $request, Response $response, $args) {
    $error = (new ApiErrorDTO("1002", 'missing currency "to"'))->value();
    $response->getBody()->write(json_encode($error));

    return $response->withStatus(400);
});

$app->get('/{value}/{from}/{to}', function (Request $request, Response $response) {
    $error = (new ApiErrorDTO("1003", 'missing exchange rate'))->value();
    $response->getBody()->write(json_encode($error));

    return $response->withStatus(400);
});

$app->get(
    '/{value}/{from}/{to}/{rate}',
    function (Request $request, Response $response, $args
){
    $value = $args['value'];
    $from = $args['from'];
    $to = $args['to'];
    $rate = $args['rate'];

    if (!is_numeric($value) || $value <= 0) {
        $error = (new ApiErrorDTO("1004", '\'amount\' value invalid'))->value();
        $response->getBody()->write(json_encode($error));

        return $response->withStatus(400);
    }

    if (!is_numeric($rate) || $rate <= 0) {
        $error = (new ApiErrorDTO(
            "1005",
            '\'rate\' value invalid',
            [$value, $from, $to, $rate]
        ))->value();
        $response->getBody()->write(json_encode($error));

        return $response->withStatus(400);
    }

    if (!Exchange::currencyIsValid($from)) {
        $error = (new ApiErrorDTO(
            "1006",
            '\'from currency\' does not match ISO 4217 standard'
        ))->value();
        $response->getBody()->write(json_encode($error));

        return $response->withStatus(400);
    }

    if (!Exchange::currencyIsValid($to)) {
        $error = (new ApiErrorDTO(
            "1008",
            '\'to currency\' does not match ISO 4217 standard'
        ))->value();
        $response->getBody()->write(json_encode($error));

        return $response->withStatus(400);
    }

    $symbol = match (strtoupper($to)) {
        'USD' => '$',
        'BRL' => 'R$',
        'EUR' => '€',
        default => null,
    };

    if (is_null($symbol)) {
        $error = (new ApiErrorDTO("1009", "currency $to not supported"))->value();
        $response->getBody()->write(json_encode($error));

        return $response->withStatus(400);
    }

    $exchange = Exchange::exchange((float) $value, (float) $rate);

    $result = [
        'valorConvertido' => round($exchange, 2),
        'simboloMoeda' => $symbol,
    ];

    $response->getBody()->write(json_encode($result));

    return $response->withStatus(200);
});

$app->run();
