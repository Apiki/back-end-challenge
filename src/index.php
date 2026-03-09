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
 * @author   Ivana Miranda <ivanagv@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\ExchangeController;

$uri = trim($_SERVER['REQUEST_URI'], '/');
$parts = explode('/', $uri);

if ($parts[0] === 'exchange') {
    $controller = new ExchangeController();

    $response = $controller->handle($parts);

    header('Content-Type: application/json');

    echo json_encode($response);

    exit;
}

http_response_code(400);

echo json_encode([
    'erro' => 'Endpoint inválido'
]);
