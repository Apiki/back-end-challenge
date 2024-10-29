<?php

/**
 * File: ExchangeController.php
 *
 * PHP version 7.4
 * 
 * This file contains the ExchangeController class, which 
 * handles convert with Models methods
 *
 * @category Controller
 * @package  App\Controllers
 * @author   André Nascimento <andreadn0312@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/andrenascimento0312/andre-dedeus
 */

namespace App\Controllers;

use App\Models\Exchange;

/**
 * Class ExchangeController
 *
 * Handles exchange operations and interactions with the Exchange model
 *
 * @category Controller
 * @package  App\Controllers
 * @author   André Nascimento <andreadn0312@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeController
{
    /**
     * Exchange an amount from one currency to another.
     *
     * @param float  $amount Amount to be converted.
     * @param string $from   Currency to convert from.
     * @param string $to     Currency to convert to.
     * @param float  $rate   Conversion rate.
     *
     * @return array An array containing the converted amount and currency symbol.
     *
     * @throws Exception if the parameters are invalid.
     */
    public function exchange(
        float $amount,
        string $from,
        string $to,
        float $rate
    ): array {
        $exchange = new Exchange($amount, $from, $to, $rate);
        $valorConvertido = $exchange->convert();
        $simboloMoeda = $exchange->getSymbol();

        return [
            'valorConvertido' => $valorConvertido,
            'simboloMoeda' => $simboloMoeda,
        ];
    }
}
