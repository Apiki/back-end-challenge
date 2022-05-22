<?php

namespace App\Services;

class ConvertMoney
{
    /**
     * Seta as conversões permitidas
     */
    public function configConversion($from, $to): bool
    {
        $validConversions = ["BRL-USD", "USD-BRL", "BRL-EUR", "EUR-BRL"];
        if (!in_array("{$from}-{$to}", $validConversions)) {
            return false;
        }

        return true;
    }
    public function convert($amount, $from, $to, $rate)
    {
        if (!$this->configConversion($from, $to)) {
            return false;
        }

        $class = "App\\Entity\\Money\\{$to}";
        $money = new $class();
        $rate = str_replace(",", ".", $rate);
        return [
            "value" => $amount * $rate,
            "symbol" => $money->getSymbol()
        ];
    }
}
