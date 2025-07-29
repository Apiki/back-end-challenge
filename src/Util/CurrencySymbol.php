<?php

/**
 * PHP version 8.1
 *
 * @category Util
 * @package  CurrencyExchange
 * @author   Gustavo de Almeida Oliveira <almdgusta@gmail.com>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     https://github.com/almdgustadev/back-end-challenge
 */

namespace Util;

/**
 * Utilitário para obter o símbolo de uma moeda.
 * 
 * @category Util
 * @package  CurrencyExchange
 * @author   Gustavo de Almeida Oliveira <almdgusta@gmail.com>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     https://github.com/almdgustadev/back-end-challenge
 */

class CurrencySymbol
{
    /**
     * Retorna o símbolo da moeda correspondente ao código fornecido.
     *
     * @param string $currency Código da moeda.
     * 
     * @return string Símbolo da moeda ou uma string vazia se não encontrado.
     */
    public static function getSymbol(string $currency): string
    {
        $symbols = [
            'USD' => '$',
            'BRL' => 'R$',
            'EUR' => '€',
        ];

        return $symbols[$currency] ?? '';
    }
}
