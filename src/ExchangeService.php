<?php

namespace App;

class ExchangeService
{
    public function convert(float $amount, string $from, string $to, float $rate): float
    {
        return $amount * $rate;
    }

    public function getSymbol(string $currency): string
    {
        return [
            'USD' => '$',
            'BRL' => 'R$',
            'EUR' => '€',
        ][$currency] ?? '';
    }
}