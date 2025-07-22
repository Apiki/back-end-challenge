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
 * @author   Marcelo Tomaz <celo.willyan@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/config.php';

use App\CurrencyConverter;

header('Content-Type: application/json');

$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);
$segments = explode('/', trim($path, '/'));

$amount_str = null;
$from = null;
$to = null;
$rate_str = null;

$is_exchange_route = false;
if (isset($segments[0]) && $segments[0] === 'exchange') {
    if (count($segments) === 5) {
        $amount_str = $segments[1];
        $from = $segments[2];
        $to = $segments[3];
        $rate_str = $segments[4];
        $is_exchange_route = true;
    }
} elseif (count($segments) === 4) {
    $amount_str = $segments[0];
    $from = $segments[1];
    $to = $segments[2];
    $rate_str = $segments[3];
    $is_exchange_route = true; 
}

$response = [];
try {
    if (!$is_exchange_route || $amount_str === null || $from === null || $to === null || $rate_str === null) {
        throw new \InvalidArgumentException('Parâmetros da requisição inválidos ou ausentes.');
    }

    if (!is_numeric($amount_str) || (float)$amount_str < 0) { 
        throw new \InvalidArgumentException('O valor a ser convertido (amount) deve ser um número positivo ou zero.');
    }
    $amount = (float) $amount_str;

    $valid_currencies_case_sensitive = ['BRL', 'USD', 'EUR'];
    if (!in_array($from, $valid_currencies_case_sensitive)) { 
        throw new \InvalidArgumentException('Moeda de origem (from) inválida. Use BRL, USD ou EUR em maiúsculas.');
    }
    if (!in_array($to, $valid_currencies_case_sensitive)) { 
        throw new \InvalidArgumentException('Moeda de destino (to) inválida. Use BRL, USD ou EUR em maiúsculas.');
    }

    if (!is_numeric($rate_str) || (float)$rate_str <= 0) {
        throw new \InvalidArgumentException('A taxa de câmbio (rate) deve ser um valor positivo.');
    }
    $rate = (float) $rate_str;

    $converter = new CurrencyConverter();
    $convertedValue = $converter->convert($amount, $from, $to, $rate);

    $symbol = $config['currency_symbols'][$to] ?? '';

    $response = [
        'valorConvertido' => $convertedValue,
        'simboloMoeda'    => $symbol,
    ];

    http_response_code(200);
} catch (\InvalidArgumentException $e) {
    http_response_code(400);
    $response = [
        'error' => $e->getMessage(),
    ];
} catch (\Throwable $e) {
    http_response_code(500);
    $response = [
        'error' => 'Ocorreu um erro interno: ' . $e->getMessage(),
    ];
}

echo json_encode($response);