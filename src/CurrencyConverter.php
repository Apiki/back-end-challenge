<?php

declare(strict_types=1);

namespace App;

class CurrencyConverter
{
    private const CURRENCY_SYMBOLS = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€',
    ];

    public function convert(
        float $amount,
        string $from,
        string $to,
        float $rate
    ): array {
        $validFrom = isset(self::CURRENCY_SYMBOLS[$from]);
        $validTo = isset(self::CURRENCY_SYMBOLS[$to]);

        if (!$validFrom || !$validTo) {
            throw new \InvalidArgumentException(
                'Invalid source or destination currency'
            );
        }

        if ($rate <= 0 || $amount < 0) {
            throw new \InvalidArgumentException('Invalid rate or amount');
        }

        $convertedAmount = $amount * $rate;

        return [
            'valorConvertido' => round($convertedAmount, 2),
            'simboloMoeda' => self::CURRENCY_SYMBOLS[$to],
        ];
    }
}
