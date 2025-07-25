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
 * @author   Pedro Marcusso <pedromarcusso@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/PedroMarcusso09/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

const SUPPORTED_CURRENCIES = ['BRL', 'USD', 'EUR'];
const CURRENCY_SYMBOLS = [
    'USD' => '$',
    'BRL' => 'R$',
    'EUR' => '€',
];

/**
 * Envia uma resposta JSON de erro com o código HTTP apropriado e encerra a execução.
 *
 * @param string $message Mensagem de erro a ser retornada
 * @param int    $code    Código HTTP da resposta
 *
 * @return void
 */
function jsonErrorResponse(string $message, int $code): void
{
    (new JsonResponse(['error' => $message], $code))->send();
    exit;
}

/**
 * Verifica se os parâmetros fornecidos para conversão de moeda são válidos.
 *
 * @param mixed  $amount Valor a ser convertido
 * @param string $from   Moeda de origem
 * @param string $to     Moeda de destino
 * @param mixed  $rate   Taxa de câmbio
 *
 * @return bool Retorna true se os parâmetros forem válidos, false caso contrário.
 */
function isValidExchangeParams($amount, $from, $to, $rate): bool
{
    return is_numeric($amount) && (float)$amount >= 0
        && in_array($from, SUPPORTED_CURRENCIES)
        && in_array($to, SUPPORTED_CURRENCIES)
        && is_numeric($rate) && (float)$rate > 0;
}

$request = Request::createFromGlobals();
$path = rtrim($request->getPathInfo(), '/');

if ($path === '') {
    jsonErrorResponse('Parâmetros inválidos', 400);
}

$pattern = '#^/exchange(?:/([^/]+))?(?:/([^/]+))?(?:/([^/]+))?(?:/([^/]+))?$#';

if (preg_match($pattern, $path, $matches)) {
    $amount = $matches[1] ?? null;
    $from   = $matches[2] ?? null;
    $to     = $matches[3] ?? null;
    $rate   = $matches[4] ?? null;

    if (is_null($amount) || is_null($from) || is_null($to) || is_null($rate)) {
        jsonErrorResponse('Parâmetros inválidos', 400);
    }

    if (!isValidExchangeParams($amount, $from, $to, $rate)) {
        jsonErrorResponse('Parâmetros inválidos', 400);
    }

    $converted = round((float)$amount * (float)$rate, 2);
    $symbol = CURRENCY_SYMBOLS[$to] ?? '';

    (new JsonResponse(
        [
        'valorConvertido' => $converted,
        'simboloMoeda' => $symbol,
        ]
    ))->send();
    return;
}

jsonErrorResponse('Rota inválida', 404);
