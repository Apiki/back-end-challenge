<?php

/**
 * Back-end Challenge.
 *
 * PHP version 8.2.8
 *
 * @category Challenge
 * @package  Back-end
 * @author   Júlio Freitas <jcsr.frts@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
require_once __DIR__ . '/CurrencyConverterController.php';

/**
 * Class Route
 *
 * Lida com as rotas da aplicação
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Júlio Freitas <jcsr.frts@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Router
{
    /**
     * Lida com uma conversão na URI fornecida.
     *
     * Esta função valida a URI fornecida usando expressão regular e
     * processa a solicitação se a URI corresponder ao formato esperado.
     *
     * @param string $uri A URI a ser processada.
     *
     * @return void
     */
    public static function handleExchangeRequest($uri)
    {
        $exchangeRoutePattern = '/^\/exchange\/(\d+(\.\d{1,2})?)' .
            '\/([A-Z]{3})' .
            '\/([A-Z]{3})' .
            '\/(\d+(\.\d{1,2})?)$/';
        if (preg_match($exchangeRoutePattern, $uri, $matches)) {
            $amount = floatval($matches[1]);
            $fromCurrency = strtoupper($matches[3]);
            $toCurrency = strtoupper($matches[4]);
            $rate = floatval($matches[5]);
            CurrencyConverterController::convert(
                $amount,
                $fromCurrency,
                $toCurrency,
                $rate
            );
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Page not found']);
        }
    }
}
