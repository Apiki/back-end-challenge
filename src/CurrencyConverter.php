<?php

declare(strict_types=1);

class CurrencyConverter
{
    private const CURRENCY_SYMBOLS = [
        'USD' => '$',
        'BRL' => 'R$',
        'EUR' => '€',
    ];

    public function convert(float $amount, string $from, string $to, float $rate): array
    {
        if (!$this->isValidConversion($from, $to)) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'Conversão não suportada']);
            exit;
        }

        $convertedAmount = $amount * $rate;
        $symbol = self::CURRENCY_SYMBOLS[$to] ?? '';

        return [
            'valorConvertido' => round($convertedAmount, 2),
            'simboloMoeda' => $symbol
        ];
    }

    private function isValidConversion(string $from, string $to): bool
    {
        $validConversions = [
            'BRL' => ['USD', 'EUR'],
            'USD' => ['BRL'],
            'EUR' => ['BRL'],
        ];

        return isset($validConversions[$from]) && in_array($to, $validConversions[$from], true);
    }
}

