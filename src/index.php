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
 * @author   Andre Ruegger <rueggertec@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\ExchangeService;

// Routing to the built-in PHP server
if (php_sapi_name() === 'cli-server') {
    $path = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($path)) {
        return false;
    }
}

// Reads the URL
$uri = strtok($_SERVER['REQUEST_URI'], '?');

// Divide into parts
$parts = array_values(array_filter(explode('/', $uri)));

// If the route starts with "exchange", remove
if (isset($parts[0]) && $parts[0] === 'exchange') {
    array_shift($parts);
}

// To ensure that we have 4 parameters
if (count($parts) !== 4) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid parameters']);
    exit;
}

[$amount, $from, $to, $rate] = $parts;

// Valida amount
if (!is_numeric($amount) || (float)$amount <= 0) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid amount']);
    exit;
}

// Validates currencies
$validCurrencies = ['BRL', 'USD', 'EUR'];

if (!in_array($from, $validCurrencies, true) || !in_array($to, $validCurrencies, true)) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid currency']);
    exit;
}

// Validates rate
if (!is_numeric($rate) || (float)$rate <= 0) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid rate']);
    exit;
}

// Process conversion
$service = new ExchangeService();
$converted = $service->convert((float)$amount, $from, $to, (float)$rate);
$symbol = $service->getSymbol($to);

// Returns JSON
http_response_code(200);
header('Content-Type: application/json');
echo json_encode(
    [
    'valorConvertido' => $converted,
    'simboloMoeda' => $symbol,
    ]
);
