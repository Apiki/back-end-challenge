<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.1.2
 *
 * Controlador responsável pela conversão de moedas.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Gustavo Dias <gustavodiasdsc@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App;

use App\Response;

/**
 * Controlador para operações de conversão de moedas.
 * 
 * Esta classe é responsável por processar solicitações de conversão
 * entre diferentes moedas suportadas pela API, validando os parâmetros
 * de entrada e retornando respostas formatadas.
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Gustavo Dias <gustavodiasdsc@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 * @since    1.0.0
 */
class ExchangeController
{
    /**
     * Converte um valor de uma moeda para outra.
     * 
     * Este método processa os parâmetros de conversão, valida se a conversão
     * é suportada entre as moedas especificadas, calcula o valor convertido
     * usando a taxa fornecida e retorna uma resposta JSON formatada.
     * 
     * @param array $params Array com os
     *                      parâmetros: [0=>route,
     *                      1=>amount, 2=>from,
     *                      3=>to, 4=>rate]
     * 
     * @return void
     */
    public static function convert(array $params)
    {

        $amount = floatval($params[1]);
        $from = strtoupper($params[2]);
        $to = strtoupper($params[3]);
        $rate = floatval($params[4]);

        $supportedCurrencies = [
            'BRL' => ['EUR', 'USD'],
            'EUR' => ['BRL'],
            'USD' => ['BRL']
        ];

        $symbols = [
            'BRL' => 'R$',
            'USD' => '$',
            'EUR' => '€'
        ];

        if (!isset($supportedCurrencies[$from])  
            || !in_array($to, $supportedCurrencies[$from])
        ) {
            Response::exchangeNotSupported($from, $supportedCurrencies[$from]);
            return;
        }

        $convertedAmount = $amount * $rate;

        Response::exchangeOk($convertedAmount, $symbols[$to]);
    }
}
