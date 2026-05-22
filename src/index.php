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

use App\ExchangeController;

require __DIR__ . '/../vendor/autoload.php';

// Configuração básica do servidor PHP
header('Content-Type: application/json');

// Roteamento robusto
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '';
$path = trim($uri, '/');
$segments = explode('/', $path);

// Verifica se o endpoint principal é "exchange"
if (isset($segments[0]) && $segments[0] === 'exchange') {
    // Uma requisição válida para /exchange deve conter exatamente 5 segmentos:
    // [0] exchange, [1] amount, [2] from, [3] to, [4] rate
    if (count($segments) !== 5) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Bad Request: Missing or invalid parameters. '
                . 'Expected format: /exchange/{amount}/{from}/{to}/{rate}'
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    $controller = new ExchangeController();
    $controller->convert(
        $segments[1], // amount
        $segments[2], // from
        $segments[3], // to
        $segments[4]  // rate
    );
} else {
    http_response_code(404);
    echo json_encode([
        'error' => 'Endpoint not found'
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
