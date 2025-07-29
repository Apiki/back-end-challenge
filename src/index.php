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
 * @author   Gustavo de Almeida Oliveira <almdgusta@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/almdgustadev/back-end-challenge
 *
 * Ponto de entrada para a aplicação
 * Roteia a requisição para o controlador de conversão de moedas
 */

require_once __DIR__ . '/Controller/ExchangeController.php';

use Controller\ExchangeController;

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$pattern = '#^/exchange/(-?[\d.]+)/([A-Z]{3})/([A-Z]{3})/(-?[\d.]+)$#';

try {
    if ($method === 'GET' && preg_match($pattern, $uri, $matches)) {
        $amount = (float) $matches[1];
        $from   = $matches[2];
        $to     = $matches[3];
        $rate   = (float) $matches[4];

        $controller = new ExchangeController();
        $response   = $controller->convert($amount, $from, $to, $rate);

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Rota não encontrada ou inválida']);
    }
} catch (\InvalidArgumentException $e) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Erro interno no servidor']);
}