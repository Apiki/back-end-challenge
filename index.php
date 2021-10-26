<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.2
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Henrique Ferreira henrique-ferreira20@hotmail.com
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\CurrencyConverter;

// Define Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$uri = $_SERVER['REQUEST_URI'];

// Validate uri
if (!isset($uri) || !is_valid($uri)) {
    send_error_response();
}

$params = explode('/', $uri);
$params = filter_var_array($params, FILTER_SANITIZE_URL);

if (count($params) < 6) {
    send_error_response();
}

$currencyConverter = new CurrencyConverter([
    'BRL' => 'R$',
    'USD' => '$',
    'EUR' => '€'
]);

$amount = $params[2];
$to = $params[4];
$rate = $params[5];

$result = $currencyConverter->exchange($amount, $to, $rate);

if (!$result) {
    send_error_response();
}

echo json_encode($result);

function send_error_response() {
    http_response_code(400);
    echo json_encode([]);
    die();
}

function is_valid($params)
{
    $start = '/^\/exchange\/';
    $only_number = '(?:\d*|\d*\.\d*)';
    $only_currencies = '(?:BRL|USD|EUR)\/(?:BRL|USD|EUR)';
    $end = '$/';

    // Matches URL in the format: /exchange/{amount}/{from}/{to}/{rate}
    $pattern = $start . $only_number . '\/'  . $only_currencies . '\/' . $only_number . $end;

    return preg_match($pattern, $params) === 1 ? true : false;
}