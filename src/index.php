<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.2
 *
 * @category Challenge
 * @package  Back-end
 * @author   Guilherme Pontes <jgmarinhopontes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();
$currencyConverter = new CurrencyConverter();

try {
    $requestData = $router->route($_SERVER['REQUEST_URI']);

    // Validação adicional pode ser adicionada aqui, se necessário
    if (!isset($requestData['amount'], $requestData['fromCurrency'], $requestData['toCurrency'], $requestData['rate'])) {
        throw new \InvalidArgumentException("Missing required parameters.");
    }

    $convertedAmount = $currencyConverter->convert(
        $requestData['amount'],
        $requestData['fromCurrency'],
        $requestData['toCurrency'],
        $requestData['rate']
    );
    
    $response = [
        'valorConvertido' => $convertedAmount,
        'simboloMoeda' => 
            $requestData['toCurrency'] === CurrencyConverter::CURRENCY_USD
            ? '$'
            : 'R$',
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
} catch (\InvalidArgumentException $e) {
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(['error' => $e->getMessage()]);
}
