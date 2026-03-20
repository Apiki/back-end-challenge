<?php
declare(strict_types=1);

namespace App\Domain;

class Currency
{
    public const string BRL = 'BRL';
    public const string USD = 'USD';
    public const string EUR = 'EUR';

    private const array SYMBOLS = [
        self::BRL => 'R$',
        self::USD => '$',
        self::EUR => '€',
    ];

    public static function isSupported(string $currency): bool
    {
        return in_array($currency, self::supported(), true);
    }

    public static function supported(): array
    {
        return [
            self::BRL,
            self::USD,
            self::EUR,
        ];
    }

    public static function getSymbol(string $currency): string
    {
        return self::SYMBOLS[$currency] ?? '';
    }
}