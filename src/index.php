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

use App\ExchangeService;
use App\ExchangeValidator;

header('Content-Type: application/json');

$uri = $_SERVER['REQUEST_URI'];
$basePath = '/exchange';

if (strpos($uri, $basePath) !== 0) {
    http_response_code(404);
    echo json_encode(['error' => 'Not found']);
    exit;
}

$path = substr($uri, strlen($basePath));
$parts = explode('/', trim($path, '/'));

$amount = $parts[0] ?? null;
$from = $parts[1] ?? null;
$to = $parts[2] ?? null;
$rate = $parts[3] ?? null;

$validator = new ExchangeValidator();

$amountValidation = $validator->validateAmount($amount);
if (!$amountValidation['valid']) {
    http_response_code(400);
    echo json_encode(['error' => $amountValidation['error']]);
    exit;
}

$fromValidation = $validator->validateCurrency($from, 'from');
if (!$fromValidation['valid']) {
    http_response_code(400);
    echo json_encode(['error' => $fromValidation['error']]);
    exit;
}

$toValidation = $validator->validateCurrency($to, 'to');
if (!$toValidation['valid']) {
    http_response_code(400);
    echo json_encode(['error' => $toValidation['error']]);
    exit;
}

$rateValidation = $validator->validateRate($rate);
if (!$rateValidation['valid']) {
    http_response_code(400);
    echo json_encode(['error' => $rateValidation['error']]);
    exit;
}

$exchangeService = new ExchangeService();

$isValidConversion = $exchangeService->isValidConversion(
    $fromValidation['value'],
    $toValidation['value']
);
if (!$isValidConversion) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid currency conversion']);
    exit;
}

$convertedValue = $exchangeService->convert(
    $amountValidation['value'],
    $rateValidation['value'],
    $toValidation['value']
);

$symbol = $exchangeService->getSymbol($toValidation['value']);

http_response_code(200);
echo json_encode(
    [
        'valorConvertido' => $convertedValue,
        'simboloMoeda' => $symbol,
    ]
);
