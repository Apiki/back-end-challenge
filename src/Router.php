<?php

namespace App;

class Router
{
    public function route(string $url): array
    {
        $urlParts = explode('/', trim($url, '/'));
        $action = array_shift($urlParts);

        if ($action !== 'exchange') {
            throw new \InvalidArgumentException("Invalid action.");
        }

        if (count($urlParts) !== 4) {
            throw new \InvalidArgumentException("Invalid number of parameters.");
        }

        list($amount, $fromCurrency, $toCurrency, $rate) = $urlParts;

        if (!is_numeric($amount) || !is_numeric($rate)) {
            throw new \InvalidArgumentException("Invalid amount or rate.");
        }

        return [
            'amount' => (float) $amount,
            'fromCurrency' => strtoupper($fromCurrency),
            'toCurrency' => strtoupper($toCurrency),
            'rate' => (float) $rate,
        ];
    }
}
