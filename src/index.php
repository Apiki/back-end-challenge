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

/**
 * Currency symbols mapping.
 */
define(
    'CURRENCY_SYMBOLS',
    [
        'USD' => '$',
        'EUR' => '€',
        'BRL' => 'R$',
    ]
);

/**
 * Allowed currency conversions.
 */
define(
    'ALLOWED_CONVERSIONS',
    [
        'BRL-USD',
        'USD-BRL',
        'BRL-EUR',
        'EUR-BRL',
    ]
);

/**
 * Sends a JSON response with the given data and HTTP status code.
 *
 * @param array $data   The data to be encoded as JSON.
 * @param int   $status The HTTP status code.
 *
 * @return void
 */
function jsonResponse(array $data, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

/**
 * Parses the request URI and extracts the exchange parameters.
 *
 * @return array|null Returns an array with parameters or null if invalid.
 */
function parseExchangeParams(): ?array
{
    $uri = $_SERVER['REQUEST_URI'];
    $path = parse_url($uri, PHP_URL_PATH);

    // Match /exchange/{amount}/{from}/{to}/{rate}
    $pattern = '#^/exchange/([^/]+)/([^/]+)/([^/]+)/([^/]+)$#';
    if (preg_match($pattern, $path, $matches)) {
        return [
            'amount' => $matches[1],
            'from' => $matches[2],
            'to' => $matches[3],
            'rate' => $matches[4],
        ];
    }

    return null;
}

/**
 * Validates the exchange parameters.
 *
 * @param array $params The parameters to validate.
 *
 * @return bool True if valid, false otherwise.
 */
function validateParams(array $params): bool
{
    // Check if amount is a valid positive number
    if (!is_numeric($params['amount']) || (float)$params['amount'] <= 0) {
        return false;
    }

    // Check if rate is a valid positive number
    if (!is_numeric($params['rate']) || (float)$params['rate'] <= 0) {
        return false;
    }

    // Check if 'from' currency is uppercase
    if (strtoupper($params['from']) !== $params['from']) {
        return false;
    }

    // Check if 'to' currency is uppercase
    if (strtoupper($params['to']) !== $params['to']) {
        return false;
    }

    // Check if currencies are valid
    $validCurrencies = ['BRL', 'USD', 'EUR'];
    if (!in_array($params['from'], $validCurrencies)
        || !in_array($params['to'], $validCurrencies)
    ) {
        return false;
    }

    // Check if conversion is allowed
    $conversion = $params['from'] . '-' . $params['to'];
    if (!in_array($conversion, ALLOWED_CONVERSIONS)) {
        return false;
    }

    return true;
}

/**
 * Calculates the converted amount.
 *
 * @param float $amount The amount to convert.
 * @param float $rate   The exchange rate.
 *
 * @return float The converted amount.
 */
function calculateConversion(float $amount, float $rate): float
{
    return $amount * $rate;
}

// Main execution
$params = parseExchangeParams();

if ($params === null) {
    jsonResponse(['error' => 'Invalid request'], 400);
}

if (!validateParams($params)) {
    jsonResponse(['error' => 'Invalid parameters'], 400);
}

$amount = (float)$params['amount'];
$rate = (float)$params['rate'];
$toCurrency = $params['to'];

$convertedValue = calculateConversion($amount, $rate);
$currencySymbol = CURRENCY_SYMBOLS[$toCurrency];

jsonResponse(
    [
        'valorConvertido' => $convertedValue,
        'simboloMoeda' => $currencySymbol,
    ],
    200
);
