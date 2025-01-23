<?php

/**
 * Back-end Challenge.
 *
 * PHP version 8.1
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Reza Rastegarian <rastgar245@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';
require_once 'ExchangeController.php';
header('Content-Type: application/json');

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$params = explode('/', trim($url, '/'));


// Checks if the incoming route is 'exchange'; 
// Otherwise, the backend won't attempt to work with the currency system
$isRouteExchange = $params[0] === 'exchange';


// To attempt working with the currency system,
// we need five path variables (parameters)
$paramsLengthValid = count($params) === 5;

if (!$isRouteExchange || !$paramsLengthValid) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$amount = $params[1];
$from = $params[2];
$to = $params[3];
$rate = $params[4];

// This class belongs to the currency system
$controller = new ExchangeController();

// This function converts one currency to another
$response = $controller->convertCurrency($amount, $from, $to, $rate);

echo json_encode($response);
