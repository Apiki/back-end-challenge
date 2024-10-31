<?php

require_once 'ExchangeController.php';

use App\ExchangeController;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathComponents = explode('/', trim((string) $path, '/'));  // Cast para string

if (count($pathComponents) !== 5 || $pathComponents[0] !== 'exchange') {
    http_response_code(400);
    echo json_encode(["error" => "Formato de URL inválido"], JSON_UNESCAPED_UNICODE);
    exit;
}

list(, $amount, $from, $to, $rate) = $pathComponents;

try {
    $controller = new ExchangeController();
    $result = $controller->convert((float)$amount, strtoupper($from), strtoupper($to), (float)$rate);

    header('Content-Type: application/json');
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
