<?php

namespace Currency;

/**
 * Class for currency conversion
 *
 * @category Currency
 * @package  Currency\Converter
 * @author   Juliano Firme <julianofirme23@gmail.com>
 * @license  MIT License
 * @link     http://localhost:8000
 */
class Converter
{
    private $_exchangeRates = [
        'USD' => [
            'BRL' => 5,
            'EUR' => 0.93
        ],
        'BRL' => [
            'USD' => 0.2,
            'EUR' => 0.18
        ],
        'EUR' => [
            'BRL' => 5.41,
            'USD' => 1.07
        ]
    ];
}
