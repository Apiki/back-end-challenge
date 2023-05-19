<?php

namespace Currency;

use InvalidArgumentException;

class CurrencyConverter
{
    private $amount;
    private $from;
    private $to;
    private $rate;

    private $currencySymbols = [
        'USD' => '$',
        'EUR' => '€',
        'BRL' => 'R$'
    ];

    public function __construct($amount, $from, $to, $rate)
    {
        $this->amount = $amount;
        $this->from = $from;
        $this->to = $to;
        $this->rate = $rate;
    }

    public function isValidCurrency($currency)
    {
        return array_key_exists($currency, $this->currencySymbols);
    }

    public function isValidRate($rate)
    {
        return is_numeric($rate) && $rate > 0;
    }

    public function validate()
    {
        if (!$this->isValidCurrency($this->from) || !$this->isValidCurrency($this->to)) {
            throw new InvalidArgumentException("Unsupported currency provided.");
        }

        if (!$this->isValidRate($this->rate)) {
            throw new InvalidArgumentException("Invalid exchange rate provided.");
        }
    }

    public function convert()
    {
        $this->validate();

        $convertedAmount = $this->amount * $this->rate;
        $currencySymbol = $this->currencySymbols[$this->to];

        return [
            'valorConvertido' => $convertedAmount,
            'simboloMoeda' => $currencySymbol
        ];
    }
}
