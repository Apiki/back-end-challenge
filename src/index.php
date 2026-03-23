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
 * @author   Jamerson Wesley <jamersonwesleyoliveira@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';


header('Content-Type: application/json');

$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$uri = explode('?', $requestUri)[0];
$segments = explode('/', trim($uri, '/'));

// 🔥 aceita COM ou SEM /exchange
if ($segments[0] === 'exchange') {
    array_shift($segments);
}

// agora precisa ter 4 partes
if (count($segments) !== 4) {
    http_response_code(400);
    echo json_encode(['error' => 'URL inválida']);
    exit;
}

[$amount, $from, $to, $rate] = $segments;

// valida número
if (!is_numeric($amount)) {
    http_response_code(400);
    echo json_encode(['error' => 'Valor inválido']);
    exit;
}

if (!is_numeric($rate)) {
    http_response_code(400);
    echo json_encode(['error' => 'Taxa inválida']);
    exit;
}

$amount = (float) $amount;
$rate   = (float) $rate;

// valida negativos
if ($amount <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Valor inválido']);
    exit;
}

if ($rate <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Taxa inválida']);
    exit;
}

// 🔥 valida moeda (tem que ser MAIÚSCULA)
if (!preg_match('/^[A-Z]{3}$/', $from)) {
    http_response_code(400);
    echo json_encode(['error' => 'Moeda origem inválida']);
    exit;
}

if (!preg_match('/^[A-Z]{3}$/', $to)) {
    http_response_code(400);
    echo json_encode(['error' => 'Moeda destino inválida']);
    exit;
}

$validCurrencies = ['BRL', 'USD', 'EUR'];

if (!in_array($from, $validCurrencies, true)
    || !in_array($to, $validCurrencies, true)
) {
    http_response_code(400);
    echo json_encode(['error' => 'Moeda inválida']);
    exit;
}

// conversão
$result = 0.0;
$symbol = '';

switch ("{$from}-{$to}") {
case 'BRL-USD':
    $result = $amount * $rate;
    $symbol = '$';
    break;

case 'USD-BRL':
    $result = $amount * $rate;
    $symbol = 'R$';
    break;

case 'BRL-EUR':
    $result = $amount * $rate;
    $symbol = '€';
    break;

case 'EUR-BRL':
    $result = $amount * $rate;
    $symbol = 'R$';
    break;

default:
    http_response_code(400);
    echo json_encode(['error' => 'Conversão não suportada']);
    exit;
}

// resposta final
echo json_encode(
    [
        'valorConvertido' => round($result, 2),
        'simboloMoeda' => $symbol,
    ],
    JSON_UNESCAPED_UNICODE
);