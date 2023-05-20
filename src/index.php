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
 * @author   IGOR GABRIEL DE SOUSA SILVA <dev.igorsousa@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);
$parameters = explode('/', $_SERVER['REQUEST_URI']);
if(count($parameters) == 6) {
    $amount = $parameters[2];
    $from = $parameters[3];
    $to = $parameters[4];
    $rate = $parameters[5];
    $currency_enabled = ['BRL', 'USD', 'EUR'];
    $currency_symbol = '';
    if(in_array($from, $currency_enabled) && in_array($to, $currency_enabled) && $rate > 0 && $amount > 0) {
        if ($from == 'BRL' && $to == 'USD') {
            $valueCurrency = $amount * $rate;
            $currency_symbol = '$';
        } elseif ($from == 'USD' && $to == 'BRL') {
            $valueCurrency = $amount * $rate;
            $currency_symbol = 'R$';
        } elseif ($from == 'BRL' && $to == 'EUR') {
            $valueCurrency = $amount * $rate;
            $currency_symbol = '€';
        } elseif ($from == 'EUR' && $to == 'BRL') {
            $valueCurrency = $amount * $rate;
            $currency_symbol = 'R$';
        } else {
            $response = [
                'success' => false,
                'message' => 'A conversão solicitada não foi autorizada.'
            ];
            http_response_code(400);
        }
        if ($currency_symbol != '' && $valueCurrency != null) {
            $response = [
                "valorConvertido" => $valueCurrency,
                'simboloMoeda' => $currency_symbol
            ];
            http_response_code(200);
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'A conversão solicitada não foi autorizada.'
        ];
        http_response_code(400);
    }
} else {
    $response = [
      'success' => false,
      'message' => 'Os parâmetros passados não foram aceitos.'
    ];
    http_response_code(400);
}
echo json_encode($response);
require __DIR__ . '/../vendor/autoload.php';