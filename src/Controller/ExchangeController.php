<?php

/**
 * PHP version 8.1
 *
 * @category Controller
 * @package  CurrencyExchange
 * @author   Gustavo de Almeida Oliveira <almdgusta@gmail.com>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     https://github.com/almdgustadev/back-end-challenge
 */

namespace Controller;

require_once __DIR__ . '/../Service/ExchangeService.php';

use Service\ExchangeService;

/**
 *  Controlador responsável por receber requisições e chamar o serviço de conversão.
 * 
 * @category Controller
 * @package  CurrencyExchange
 * @author   Gustavo de Almeida Oliveira <almdgusta@gmail.com>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     https://github.com/almdgustadev/back-end-challenge
 */

class ExchangeController
{
    /**
     * Converte um valor de uma moeda para outra.
     *
     * @param float  $amount Valor a ser convertido
     * @param string $from   Moeda de origem (ex: BRL)
     * @param string $to     Moeda de destino (ex: USD)
     * @param float  $rate   Taxa de conversão
     * 
     * @return array Retorno com valor convertido e símbolo
     */
    public function convert(
        float $amount,
        string $from,
        string $to,
        float $rate
    ): array {
        $service = new ExchangeService();
        return $service->convertCurrency($amount, $from, $to, $rate);
    }
}
