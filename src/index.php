<?php

require 'vendor/autoload.php';

use App\CurrencyConverter;

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (preg_match('/^\/exchange\/(\d+(\.\d+)?)\/(BRL|USD|EUR)\/(BRL|USD|EUR)\/(\d+(\.\d+)?)/', $requestUri, $matches)) {
    $amount = (float)$matches[1];
    $from = strtoupper($matches[3]);
    $to = strtoupper($matches[4]);
    $rate = (float)$matches[5];

    $result = CurrencyConverter::convert($amount, $from, $to, $rate);

    if ($result) {
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Conversão não suportada']);
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Rota não encontrada']);
}