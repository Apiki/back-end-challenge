<?php

namespace App;

class CurrencyConverter
{
    const CURRENCY_BRL = 'BRL';
    const CURRENCY_USD = 'USD';
    const CURRENCY_EUR = 'EUR';

    public function convert(float $amount, string $fromCurrency, string $toCurrency, float $rate): float
    {
        if ($amount <= 0 || $rate <= 0) {
            throw new \InvalidArgumentException("Invalid amount or rate.");
        }

        if (!in_array($fromCurrency, [self::CURRENCY_BRL, self::CURRENCY_USD, self::CURRENCY_EUR]) ||
            !in_array($toCurrency, [self::CURRENCY_BRL, self::CURRENCY_USD, self::CURRENCY_EUR])) {
            throw new \InvalidArgumentException("Invalid currency.");
        }

        $convertedAmount = $amount * $rate;

        return round($convertedAmount, 2);
    }
}

