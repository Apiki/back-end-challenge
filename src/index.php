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
 * @author   André Nascimento <andreadn0312@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ExchangeController;
use App\Views\ExchangeView;

try {
    $requestUri = $_SERVER['REQUEST_URI'];
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    if ($requestMethod !== 'GET') {
        http_response_code(405);
        throw new Exception('Método errado');
    }

    $parts = explode('/', trim($requestUri, '/'));
    if (count($parts) !== 5 || $parts[0] !== 'exchange') {
        http_response_code(404);
        throw new Exception('Endpoint não encontrado');
    }

    list(, $amount, $from, $to, $rate) = $parts;

    $controller = new ExchangeController();
    $response = $controller->exchange((float)$amount, $from, $to, (float)$rate);
    ExchangeView::returnJson($response);
    
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 400);
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
