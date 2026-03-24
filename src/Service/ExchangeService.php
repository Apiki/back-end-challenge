<?php

namespace App\Service;

class ExchangeService
{
    private ExchangeRateService $rateService;

    public function __construct()
    {
        $this->rateService = new ExchangeRateService();
    }

    public function convert(float $amount, string $from, string $to): float
    {
        try {
            $rate = $this->rateService->getRate($from, $to);
        } catch (\Exception $e) {
            // fallback se API falhar
            $rate = $this->getFallbackRate($from, $to);
        }

        return round($amount * $rate, 2);
    }

    private function getFallbackRate(string $from, string $to): float
    {
        $fallbackRates = [
            'BRL_USD' => 4.5,
            'USD_BRL' => 5.0,
            'BRL_EUR' => 6.0,
            'EUR_BRL' => 6.0,
        ];

        $key = "{$from}_{$to}";

        if (!isset($fallbackRates[$key])) {
            throw new \Exception('Conversão não suportada');
        }

        return $fallbackRates[$key];
    }
}