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
 * @author   Itamar Silva <itamarsilvacc@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();
$currencyConverter = new CurrencyConverter();

try {
    // Obter os dados da requisição através do roteamento
    $requestData = $router->route($_SERVER['REQUEST_URI']);

    // Realizar a conversão de moedas utilizando o CurrencyConverter
    $convertedAmount = $currencyConverter->convert(
        $requestData['amount'],
        $requestData['fromCurrency'],
        $requestData['toCurrency'],
        $requestData['rate']
    );

    // Retornar a resposta em formato JSON
    $response = [
        'valorConvertido' => $convertedAmount,
        'simboloMoeda' => $requestData['toCurrency'] === CurrencyConverter::CURRENCY_USD ? '$' : 'R$',
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
} catch (\InvalidArgumentException $e) {
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(['error' => $e->getMessage()]);
}
