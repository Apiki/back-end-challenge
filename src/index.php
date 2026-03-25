<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\CurrencyConverter;

header('Content-Type: application/json');

$requestUri = $_SERVER['REQUEST_URI'];
$path = (string) parse_url($requestUri, PHP_URL_PATH);

$pattern = '/^\/exchange\/([0-9.]+)\/([A-Z]{3})\/([A-Z]{3})\/([0-9.]+)$/';
if (preg_match($pattern, $path, $matches)) {
    $amount = (float) $matches[1];
    $from = $matches[2];
    $to = $matches[3];
    $rate = (float) $matches[4];

    try {
        $converter = new CurrencyConverter();
        $result = $converter->convert($amount, $from, $to, $rate);
        echo json_encode($result);
        http_response_code(200);
    } catch (\InvalidArgumentException $e) {
        http_response_code(400);
        echo json_encode(['error' => $e->getMessage()]);
    } catch (\Throwable $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Internal Server Error']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid URL or missing parameters']);
}
