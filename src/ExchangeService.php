<?php
/**
 * Service responsible for performing currency conversion.
 *
 * PHP version 7.4+
 *
 * @category Service
 * @package  App
 * @author   Andre Ruegger <rueggertec@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App;

/**
 * ExchangeService class
 *
 * Handles the calculation of converted values and returns currency symbols.
 *
 * @category Service
 * @package  App
 * @author   Andre Ruegger <rueggertec@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeService
{
    /**
     * Converts a value from one currency to another using a given rate.
     *
     * @param float  $amount Value to be converted
     * @param string $from   Source currency
     * @param string $to     Target currency
     * @param float  $rate   Conversion rate
     *
     * @return float Converted value
     */
    public function convert(float $amount, string $from, string $to, float $rate): float
    {
        return $amount * $rate;
    }

    /**
     * Returns the symbol of the given currency.
     *
     * @param string $currency Currency code (BRL, USD, EUR)
     *
     * @return string Currency symbol
     */
    public function getSymbol(string $currency): string
    {
        return [
            'BRL' => 'R$',
            'USD' => '$',
            'EUR' => '€',
        ][$currency];
    }
}