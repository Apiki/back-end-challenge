<?php

namespace App\Helpers;

use App\Helpers\ExchangeValidator;

class CurrencyConverter
{
    public static function transformValue($request, $response)
    {
        $validate = ExchangeValidator::validate($request, $response);

        if ($validate->getStatusCode() === 200) {
            $amount = $request->getAttribute('amount');
            $from   = $request->getAttribute('from');
            $to     = $request->getAttribute('to');
            $rate   = $request->getAttribute('rate');

            switch ($from):
                case 'BRL':
                    if (strpos($amount, ',')) {
                        $amount = str_replace('.', '', $amount);
                        $amount = str_replace(',', '.', $amount);
                    }
                    $newAmount = $amount * $rate;
                    $fmt = numfmt_create('en_US', \NumberFormatter::DECIMAL);
                    $value = $fmt->formatCurrency($newAmount, $to);
                    $symbol = \Symfony\Component\Intl\Currencies::getSymbol($to);
                    break;
                case 'EUR':
                    if (strpos($rate, ',')) {
                        $rate = str_replace('.', '', $rate);
                        $rate = str_replace(',', '.', $rate);
                    }
                    $newAmount = $amount * $rate;
                    $fmt = numfmt_create('en_US', \NumberFormatter::DECIMAL);
                    $value = $fmt->formatCurrency($newAmount, $from);
                    $symbol = \Symfony\Component\Intl\Currencies::getSymbol($to);
                    break;
                case 'USD':
                    if (strpos($rate, ',')) {
                        $rate = str_replace('.', '', $rate);
                        $rate = str_replace(',', '.', $rate);
                    }
                    $newAmount = $amount * $rate;
                    $fmt = numfmt_create('en_US', \NumberFormatter::DECIMAL);
                    $value = $fmt->formatCurrency($newAmount, $from);
                    $symbol = \Symfony\Component\Intl\Currencies::getSymbol($to);
                    break;
            endswitch;

            return json_encode([
                'valorConvertido' => $value,
                'simboloMoeda' => $symbol,
            ]);
        }
    }
}
