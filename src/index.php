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

require __DIR__ . '/../vendor/autoload.php';
// Inclui o controlador ConversorMoedas
require __DIR__ . '/../src/ControleDeCambio.php';

// Configuração básica do servidor PHP
header('Content-Type: application/json');
// Roteamento simples
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uriSegments = explode('/', trim($uri, '/'));
// Verifica se a rota é /exchange
if ($uriSegments[0] === 'exchange' && count($uriSegments) === 5) {
    $controller = new ControleDeCambio();
    $controller->convert(
        $uriSegments[1], // amount
        strtoupper($uriSegments[2]), // from
        strtoupper($uriSegments[3]), // to
        $uriSegments[4]  // rate
    );
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint não encontrado']);
}
