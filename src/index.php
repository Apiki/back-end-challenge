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
 * @author   Claude AI <claude@anthropic.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\CurrencyConverter;
use App\Response;

// Initialize components
$router = new Router();
$converter = new CurrencyConverter();
$response = new Response();

// Parse request
$params = $router->parseRequest();

// Check if there was an error parsing the request
if (isset($params['error'])) {
    $response->error($params['error'], 400);
    exit;
}

// Extract parameters
$amount = $params['amount'];
$from = $params['from'];
$to = $params['to'];
$rate = $params['rate'];

// Validate parameters
$validation = $converter->validate($amount, $from, $to, $rate);
if (!$validation['valid']) {
    $response->error($validation['error'], 400);
    exit;
}

// Convert currency
$result = $converter->convert((float) $amount, $from, $to, (float) $rate);

// Send response
$response->json($result, 200);
