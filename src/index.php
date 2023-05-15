<?php

// Pega o caminho da requisição
$path = $_SERVER['REQUEST_URI'];
$path = ltrim($path, '/');
$pathParts = explode('/', $path);

// Verifica se o caminho está certo
if (count($pathParts) !== 5 || $pathParts[0] !== 'exchange') {
    http_response_code(404);
    exit(json_encode(['error' => 'Endpoint não encontrado']));
}

// Pega os parâmetros da URL
$amount = $pathParts[1];
$from = $pathParts[2];
$to = $pathParts[3];
$rate = $pathParts[4];

// Verifica os valores exigidos
$conversions = [
    'BRL-USD' => '$',
    'USD-BRL' => 'R$',
    'BRL-EUR' => '€',
    'EUR-BRL' => 'R$'
];

// Verifica se a conversão é suportada
$conversionKey = $from . '-' . $to;
if (!array_key_exists($conversionKey, $conversions)) {
    http_response_code(400);
    exit(json_encode(['error' => 'Conversão não suportada']));
}

// Calcula o valor convertido
$convertedValue = $amount * $rate;

// Prepara a resposta em formato JSON
$response = [
    'valorConvertido' => $convertedValue,
    'simboloMoeda' => $conversions[$conversionKey]
];

// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');

// Retorna a resposta em JSON
echo json_encode($response);