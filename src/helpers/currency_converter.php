<?php
/**
 * Currency Converter file
 *
 * PHP version 7.4
 *
 * This file is responsible for the conversion methods.
 *
 * @category Converter
 * @package  Currency\Converter
 * @author   Juliano Firme <julianofirme23@gmail.com>
 * @license  MIT License
 * @link     https://github.com/jfirme-sys/back-end-challenge
 */
declare(strict_types=1);

namespace Currency;
/**
 * Class for currency conversion
 *
 * PHP version 7.4
 *
 * This file is responsible for the conversion methods.
 *
 * @category Converter
 * @package  Converter
 * @author   Juliano Firme <julianofirme23@gmail.com>
 * @license  MIT License
 * @link     https://github.com/jfirme-sys/back-end-challenge
 */
class Converter
{
    /**
     * Converts from Brazilian Real to US Dollar
     *
     * @param float      $amount Value in Brazilian Real
     * @param float|null $rate   Currency exchange rate
     * 
     * @return float Value in US Dollar
     */
    public function fromRealToDollar($amount, $rate)
    {
        return $amount * $rate;
    }

    /**
     * Converts from US Dollar to Brazilian Real
     *
     * @param float      $amount Value in US Dollar
     * @param float|null $rate   Currency exchange rate
     * 
     * @return float Value in Brazilian Real
     */
    public function fromDollarToReal($amount, $rate)
    {
        return $amount * $rate;
    }

    /**
     * Converts from Brazilian Real to Euro
     *
     * @param float      $amount Value in Brazilian Real
     * @param float|null $rate   Currency exchange rate
     * 
     * @return float Value in Euro
     */
    public function fromRealToEuro($amount, $rate)
    {
        return $amount * $rate;
    }

    /**
     * Converts from Euro to Brazilian Real
     *
     * @param float      $amount Value in Euro
     * @param float|null $rate   Currency exchange rate
     * 
     * @return float Value in Brazilian Real
     */
    public function fromEuroToReal($amount, $rate)
    {
        return $amount * $rate;
    }
}
