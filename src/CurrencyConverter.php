<?php
/**
 * CurrencyConverter class for back-end challenge.
 *
 * Handles currency conversion logic.
 *
 * @category Challenge
 * @package  App
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
declare(strict_types=1);

namespace App;

class CurrencyConverter
{
    private const SUPPORTED_CURRENCIES = ['BRL', 'USD', 'EUR'];
    private const SYMBOLS = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€',
    ];

    /**
     * Convert currency amount.
     *
     * @param  float  $amount
     * @param  string $from
     * @param  string $to
     * @param  float  $rate
     * @return array|null
     */
    public function convert(float $amount, string $from, string $to, float $rate): ?array
    {
        if (!$this->validateAmount($amount)) {
            return null;
        }
        if (!$this->validateCurrency($from) || !$this->validateCurrency($to)) {
            return null;
        }
        if (!$this->validateRate($rate)) {
            return null;
        }

        $converted = $amount * $rate;
        $symbol = self::SYMBOLS[strtoupper($to)];

        return [
            'valorConvertido' => $converted,
            'simboloMoeda' => $symbol,
        ];
    }

    private function validateAmount(float $amount): bool
    {
        return $amount > 0;
    }

    private function validateCurrency(string $currency): bool
    {
        return in_array(strtoupper($currency), self::SUPPORTED_CURRENCIES, true) && $currency === strtoupper($currency);
    }

    private function validateRate(float $rate): bool
    {
        return $rate > 0;
    }
}
