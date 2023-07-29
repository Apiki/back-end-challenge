<?php

namespace App;

class CurrencyConverter
{
    public function convert(float $amount, string $fromCurrency, string $toCurrency, float $rate): float
    {
        if ($amount <= 0 || $rate <= 0) {
            throw new \InvalidArgumentException("Invalid amount or rate.");
        }

        $convertedAmount = $amount * $rate;

        return round($convertedAmount, 2);
    }
}
