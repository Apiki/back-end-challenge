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

// arquivo com a função para processar a conversão
require_once 'CurrencyConverter.php';

// Função que processa a requisição
function processRequest()
{
    $uri = $_SERVER['REQUEST_URI'];
    $parts = explode('/', trim($uri, '/'));

    if (count($parts) !== 5 || $parts[0] !== 'exchange') {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Formato de requisição inválido']);
        exit;
    }

    [$amount, $from, $to, $rate] = array_slice($parts, 1);

    if (!is_numeric($amount) || !is_numeric($rate)) {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Amount e rate devem ser numéricos']);
        exit;
    }

    $converter = new CurrencyConverter();
    $response = $converter->convert((float)$amount, strtoupper($from), strtoupper($to), (float)$rate);

    header('Content-Type: application/json');
    echo json_encode($response);
}

// Processar a requisição
processRequest();
