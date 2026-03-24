<?php

namespace App\Controller;

use App\Service\ExchangeService;

class ExchangeController
{
    private ExchangeService $service;

    public function __construct()
    {
        $this->service = new ExchangeService();
    }

    public function convert(float $amount, string $from, string $to): array
    {
        $result = $this->service->convert($amount, $from, $to);

        return [
            'valorConvertido' => $result,
            'simboloMoeda' => $this->getSymbol($to)
        ];
    }

    private function getSymbol(string $currency): string
    {
        return match ($currency) {
            'USD' => '$',
            'BRL' => 'R$',
            'EUR' => '€',
            default => ''
        };
    }
}