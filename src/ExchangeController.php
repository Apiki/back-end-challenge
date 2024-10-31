<?php

namespace App;

use Exception;

class ExchangeController
{
    /** @var array<string, string> */
    private array $currencySymbols = [
        'USD' => '$',
        'BRL' => 'R$',
        'EUR' => '€'
    ];

    /**
     * Converte o valor com base na taxa de câmbio
     *
     * @param float $amount Quantidade a ser convertida
     * @param string $from Moeda de origem
     * @param string $to Moeda de destino
     * @param float $rate Taxa de câmbio
     * @return array<string, float|string> Valor convertido e símbolo da moeda
     */
    public function convert(float $amount, string $from, string $to, float $rate): array
    {
        $convertedValue = $amount * $rate;

        if (!isset($this->currencySymbols[$to])) {
            throw new Exception("Moeda destino inválida: $to");
        }

        return [
            "valorConvertido" => round($convertedValue, 2),
            "simboloMoeda" => $this->currencySymbols[$to]
        ];
    }
}
