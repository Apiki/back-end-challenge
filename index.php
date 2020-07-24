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
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Exchange;

$path = $_SERVER['REQUEST_URI'] ?? '/';
preg_match('/(exchange)\/([\d]+?\.?[\d]{0,2})\/([A-Z]+)\/([A-Z]+)\/([\d]+?\.?[\d]{0,2})/', $path, $matches);


if (!isset($matches[1]) || $matches[1] != 'exchange') {
    echo json_encode(["message" => "Rota não encontrada"]);
    http_response_code(400);
    exit;
}

if ((int) $matches[2] < 0 || (int) $matches[5] < 0) {
    echo json_encode(["message" => "Tipo de dado não permitido"]);
    http_response_code(400);
    exit;
}

$from = 'App\\' . $matches[3];
$to = 'App\\' . $matches[4];

$fromObj = new $from;
$fromObj->setValue($matches[2]);

$toObj = new $to;
$rate = $matches[5];

$exchange = new Exchange($fromObj, $toObj, $rate);
echo json_encode($exchange->run());
