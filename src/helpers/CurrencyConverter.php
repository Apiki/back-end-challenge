<?php

namespace App\Helpers;

use App\Helpers\ExchangeValidator;

class CurrencyConverter
{
    public static function transformValue($amount, $from, $to, $rate)
    {
        switch ($from):
            case 'BRL':
                if (strpos($amount, ',')) {
                    $amount = str_replace('.', '', $amount);
                    $amount = str_replace(',', '.', $amount);
                }
                $newAmount = $amount * $rate;
                $fmt = numfmt_create('pt_BR', \NumberFormatter::DECIMAL);
                $value = $fmt->formatCurrency($newAmount, $to);
                $symbol = \Symfony\Component\Intl\Currencies::getSymbol($to);
                break;
            case 'EUR':
                if (strpos($rate, ',')) {
                    $rate = str_replace('.', '', $rate);
                    $rate = str_replace(',', '.', $rate);
                }
                $newAmount = $amount * $rate;
                $fmt = numfmt_create('pt_BR', \NumberFormatter::DECIMAL);
                $value = $fmt->formatCurrency($newAmount, $from);
                $symbol = \Symfony\Component\Intl\Currencies::getSymbol($to);
                break;
            case 'USD':
                if (strpos($rate, ',')) {
                    $rate = str_replace('.', '', $rate);
                    $rate = str_replace(',', '.', $rate);
                }
                $newAmount = $amount * $rate;
                $fmt = numfmt_create('pt_BR', \NumberFormatter::DECIMAL);
                $value = $fmt->formatCurrency($newAmount, $from);
                $symbol = \Symfony\Component\Intl\Currencies::getSymbol($to);
                break;
        endswitch;

        return array(
            'valorConvertido' => $value,
            'simboloMoeda' => $symbol,
        );
    }
}
