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

    /**
     * Converts from Brazilian Real to US Dollar
     *
     * @param float $amount Value in Brazilian Real
     * 
     * @return float Value in US Dollar
     */
    public function fromRealToDollar($amount)
    {
        $rate = $this->_exchangeRates['BRL']['USD'];
        return $amount * $rate;
    }

    /**
     * Converts from US Dollar to Brazilian Real
     *
     * @param float $amount Value in US Dollar
     * 
     * @return float Value in Brazilian Real
     */
    public function fromDollarToReal($amount)
    {
        $rate = $this->_exchangeRates['USD']['BRL'];
        return $amount * $rate;
    }

    /**
     * Converts from Brazilian Real to Euro
     *
     * @param float $amount Value in Brazilian Real
     * 
     * @return float Value in Euro
     */
    public function fromRealToEuro($amount) 
    {
        $rate = $this->_exchangeRates['BRL']['EUR'];
        return $amount * $rate;
    }
}
