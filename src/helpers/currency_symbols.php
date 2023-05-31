<?php

/**
 * Function for return the currency symbols
 *
 * PHP version 7.4
 *
 * This file is responsible for return the currency symbols.
 *
 * @category Currency Symbols
 * @package  CurrencySymbols\Symbols
 * @author   Juliano Firme <julianofirme23@gmail.com>
 * @license  MIT License
 * @link     https://github.com/jfirme-sys/back-end-challenge
 */
declare(strict_types=1);

namespace CurrencySymbols;

function getCurrencySymbol($currency)
{
    $symbols = [
        'USD' => '$',
        'BRL' => 'R$',
        'EUR' => '€',
    ];

    return $symbols[$currency] ?? '';
}
