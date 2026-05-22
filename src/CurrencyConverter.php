<?php

declare(strict_types=1);

namespace App;

use InvalidArgumentException;

class CurrencyConverter
{
    /**
     * Supported currency symbols mapping.
     *
     * @var array<string, string>
     */
    private array $currencySymbols = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€'
    ];

    /**
     * Allowed conversion pairs.
     *
     * @var array<string, string[]>
     */
    private array $allowedConversions = [
        'BRL' => ['USD', 'EUR'],
        'USD' => ['BRL'],
        'EUR' => ['BRL']
    ];

    /**
     * Converts a given amount between two currencies using the specified rate.
     *
     * @param float $amount
     * @param string $from
     * @param string $to
     * @param float $rate
     * @return array{valorConvertido: float|int, simboloMoeda: string}
     * @throws InvalidArgumentException If currency is invalid or conversion is not allowed.
     */
    public function convert(float $amount, string $from, string $to, float $rate): array
    {
        // Valida se as moedas de origem e destino são suportadas
        if (!isset($this->currencySymbols[$from]) || !isset($this->currencySymbols[$to])) {
            throw new InvalidArgumentException('Invalid currency code');
        }

        // Valida se a conversão específica é permitida
        if (!in_array($to, $this->allowedConversions[$from], true)) {
            throw new InvalidArgumentException('Conversion not allowed');
        }

        // Calcula o valor convertido
        $convertedValue = $amount * $rate;

        // Arredonda para 2 casas decimais, mantendo tipo int se for inteiro ou float caso contrário
        $roundedValue = round($convertedValue, 2);

        return [
            'valorConvertido' => $roundedValue,
            'simboloMoeda' => $this->currencySymbols[$to]
        ];
    }
}
