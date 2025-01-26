<?php

namespace App\classes;

/**
 * Class Exchange
 *
 * This class provides utility methods for currency validation and conversion.
 */
class Exchange
{
    /**
     * Validates if the provided currency code is valid.
     *
     * A valid currency code consists of 2 or 3 uppercase alphabetic characters.
     *
     * @param string $currencyCode The currency code to validate.
     * @return bool True if the currency code is valid, false otherwise.
     */
    public static function currencyIsValid(string $currencyCode): bool
    {
        return preg_match('/^[A-Z]{2,3}$/', $currencyCode);
    }

    /**
     * Converts a value using the provided exchange rate.
     *
     * @param float $value The amount to convert.
     * @param float $rate The exchange rate to apply.
     * @return float The converted value.
     */
    public static function exchange(float $value, float $rate): float
    {
        return $value * $rate;
    }
}