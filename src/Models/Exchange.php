<?php

/**
 * File: ExchangeView.php
 *
 * PHP version 7.4
 *
 * This file contains class Exchange Models that 
 * is reponsible for validate and convert 
 *
 * @category Model
 * @package  App\Models
 * @author   André Nascimento <andreadn0312@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App\Models;

use Exception;

/**
 * Class Exchange
 *
 * Handles validate exchange operations.
 *
 * @category Model
 * @package  App\Models
 * @author   André Nascimento <andreadn0312@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/andrenascimento0312/andre-dedeus
 */
class Exchange
{
    private float $_amount;
    private string $_from;
    private string $_to;
    private float $_rate;
    private const VALID_CURRENCIES = ['USD', 'EUR', 'BRL'];

    /**
     * Exchange constructor.
     *
     * @param float  $_amount Amount to be converted.
     * @param string $_from   Currency to convert from.
     * @param string $_to     Currency to convert to.
     * @param float  $_rate   Conversion rate.
     *
     * @throws Exception if the currency is invalid or 
     * if amount/rate are non-positive.
     */
    public function __construct(
        float $_amount,
        string $_from,
        string $_to,
        float $_rate
    ) {

        if (!in_array($_from, self::VALID_CURRENCIES) 
            || !in_array($_to, self::VALID_CURRENCIES)
        ) {
            throw new Exception('Só aceitamos conversão de: BRL, USD e EUR');
        }

        if (!is_numeric($_rate) || $_rate <= 0) {
            throw new Exception('O valor do rate deve ser um número positivo.');
        }

        if (!is_numeric($_amount) || $_amount <= 0) {
            throw new Exception('O valor do amount deve ser um número positivo.');
        }

        $this->_amount = $_amount;
        $this->_from = $_from;
        $this->_to = $_to;
        $this->_rate = $_rate;
    }

    /**
     * Convert the amount from one currency to another.
     *
     * @return float The converted amount.
     */
    public function convert(): float
    {
        return $this->_amount * $this->_rate;
    }

    /**
     * Get the currency symbol for the target currency.
     *
     * @return string The currency symbol.
     */
    public function getSymbol(): string
    {
        if ($this->_to === 'USD') {
            return '$';
        }

        if ($this->_to === 'EUR') {
            return '€';
        }

        return 'R$';
    }
}
