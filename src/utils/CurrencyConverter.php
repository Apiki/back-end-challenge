<?php

/**
 * This file contains the CurrencyConverter class
 * responsible for handling currency conversion logic as a utility.
 *
 * PHP version 8.1
 *
 * @category Util
 * @package  ExchangeUtil
 * @author   Reza Rastegarian <rastgar245@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);
/**
 * Handles currency conversion logic.
 *
 * This class provides a method to convert an amount from one currency to another
 * using a specific exchange rate.
 * 
 * @category Tool
 * @package  CurrencyConversionTool
 * @author   Reza Rastegarian <rastgar245@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class CurrencyConverter
{
    /**
     * Converts the given amount from one currency to another.
     *
     * @param float $amount The amount to convert.
     * @param float $rate   The exchange rate to apply.
     * 
     * @return float Returns the converted amount.
     */
    public function convert($amount, $rate)
    {
        return round($amount * $rate, 2);
    }
}
