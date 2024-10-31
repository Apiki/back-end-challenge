<?php

namespace App;

class CurrencyConverter
{
    public static function convert($amount, $from, $to, $rate)
    {
        $convertedValue = 0;
        $symbol = '';

        
        if ($from === 'BRL' && $to === 'USD') {
            $convertedValue = $amount / $rate;
            $symbol = '$';
        } elseif ($from === 'USD' && $to === 'BRL') {
            $convertedValue = $amount * $rate;
            $symbol = 'R$';
        } elseif ($from === 'BRL' && $to === 'EUR') {
            $convertedValue = $amount / $rate;
            $symbol = '€';
        } elseif ($from === 'EUR' && $to === 'BRL') {
            $convertedValue = $amount * $rate;
            $symbol = 'R$';
        } elseif ($from === 'EUR' && $to === 'USD') {
            $convertedValue = $amount * $rate;
            $symbol = '$';
        } elseif ($from === 'USD' && $to === 'EUR') {
            $convertedValue = $amount / $rate;
            $symbol = '€';
        } else {
            return null;
        }

        return [
            'valorConvertido' => round($convertedValue, 2),
            'simboloMoeda' => $symbol
        ];
    }
}