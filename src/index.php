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


use App\CurrencyConverter;

// Parse the request URI
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$path = parse_url($requestUri, PHP_URL_PATH);

// Check if path starts with /exchange/
if (strpos($path, '/exchange/') === 0) {
    $parts = explode('/', trim($path, '/'));
    // parts[0] = 'exchange', [1]=amount, [2]=from, [3]=to, [4]=rate
    if (count($parts) !== 5) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo '{}';
        exit;
    }

    $amountStr = $parts[1];
    $from = $parts[2];
    $to = $parts[3];
    $rateStr = $parts[4];

    // Validate amount
    if (!is_numeric($amountStr) || ($amount = (float)$amountStr) <= 0) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo '{}';
        exit;
    }

    // Validate rate
    if (!is_numeric($rateStr) || ($rate = (float)$rateStr) <= 0) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo '{}';
        exit;
    }

    $converter = new CurrencyConverter();
    $result = $converter->convert($amount, $from, $to, $rate);

    if ($result === null) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo '{}';
        exit;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    // For other paths, perhaps 404, but tests don't cover
    http_response_code(404);
    header('Content-Type: application/json');
    echo '{}';
}

