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
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");

$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($uri, '/'));

CONST SIGN_SYMBOL = [
    'BRL' => 'R$',
    'EUR' => '€',
    'USD' => '$'
];

CONST PERMITTED_CURRENCIES = [
    'BRL',
    'EUR',
    'USD'
];

CONST ROUTE = 'exchange';

CONST ERROR_MESSAGES = [
    'INVALID_CURRENCY' => "Moeda invalida. Use: USD, BRL, EUR",
    'INVALID_RATE'     => "Taxa invalida. Use: > 0",
    'INVALID_AMOUNT'   => "Valor invalido. Use: > 0",
    'INVALID_ROUTE'    => "Rota invalida. Use: /exchange/{amount}/{from}/{to}/{rate}"
];

if (count($parts) !== 5) :
    http_response_code(400);
    echo json_encode(["erro" => ERROR_MESSAGES['INVALID_ROUTE']]);
    exit;
endif;

if ($parts[0] !== ROUTE) :
    http_response_code(404);
    echo json_encode(["erro" => ERROR_MESSAGES['INVALID_ROUTE']]);
    exit;
endif;

CONST ROUTE_PARAMS = [
    'AMOUNT' => 1,
    'FROM'   => 2,
    'TO'     => 3,
    'RATE'   => 4
];

if (
    !is_numeric($parts[ROUTE_PARAMS['AMOUNT']])
    || (float) $parts[ROUTE_PARAMS['AMOUNT']] <= 0
) :
    http_response_code(400);
    echo json_encode(["erro" => ERROR_MESSAGES['INVALID_AMOUNT']]);
    exit;
endif;

if (
    !is_numeric($parts[ROUTE_PARAMS['RATE']])
    || (float) $parts[ROUTE_PARAMS['RATE']] <= 0
) :
    http_response_code(400);
    echo json_encode(["erro" => ERROR_MESSAGES['INVALID_RATE']]);
    exit;
endif;

if (
    !in_array($parts[ROUTE_PARAMS['FROM']], PERMITTED_CURRENCIES)
    || !in_array($parts[ROUTE_PARAMS['TO']], PERMITTED_CURRENCIES)
) :
    http_response_code(400);
    echo json_encode(["erro" => ERROR_MESSAGES['INVALID_CURRENCY']]);
    exit;
endif;

if ($parts[ROUTE_PARAMS['RATE']] <= 0) :
    http_response_code(400);
    echo json_encode(["erro" => ERROR_MESSAGES['INVALID_RATE']]);
    exit;
endif;

$amount = (float) trim($parts[ROUTE_PARAMS['AMOUNT']]);
$to     = strtoupper(trim($parts[ROUTE_PARAMS['TO']]));
$rate   = (float) trim($parts[ROUTE_PARAMS['RATE']]);

$result = $amount * $rate;

echo json_encode([
    "valorConvertido" => round($result, 2),
    "simboloMoeda" => SIGN_SYMBOL[$to]
]);
