<?php

namespace App;

class CurrencyConverter
{
    private $currencies;

    /**
     * Initializes a new instance of the CurrencyConverter class.
     * @param array $currencies An array with the following structure:
     *     $currencies = [
     *         'currencyName' => 'currencySymbol'
     *     ];
     */
    public function __construct(array $currencies)
    {
        $this->currencies = $currencies;
    }
    
    public function exchange($amount, $to, $rate)
    {
        $currencySymbol = $this->currencies[$to];

        // Validate args
        if ($currencySymbol == null || !is_numeric($amount) || !is_numeric($rate)) {
            return false;
        }

        return [
            'valorConvertido' => $amount * $rate,
            'simboloMoeda' => $currencySymbol
        ];
    }
}