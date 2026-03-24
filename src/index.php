<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\ExchangeController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

// Só aceita GET
if ($method !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// Rota: /exchange/valor/de/para
$pattern = '#^/exchange/(\d+(?:\.\d+)?)/(BRL|USD|EUR)/(BRL|USD|EUR)$#';

if (preg_match($pattern, $uri, $matches)) {

    $controller = new ExchangeController();

    $result = $controller->convert(
        (float)$matches[1],
        $matches[2],
        $matches[3]
    );

    echo json_encode([
        'amount' => $matches[1],
        'from' => $matches[2],
        'to' => $matches[3],
        'result' => $result
    ]);

} else {
    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
}