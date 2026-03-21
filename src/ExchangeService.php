<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Willian <willian@apiki.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App;

/**
 * Service class for handling currency exchange operations.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Willian <willian@apiki.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeService
{
    /**
     * Supported currency codes and symbols.
     *
     * @var array<string,string>
     */
    private const SUPPORTED_CURRENCIES = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€',
    ];

    /**
     * Valid currency conversion pairs.
     *
     * @var array<string>
     */
    private const VALID_CONVERSIONS = [
        'BRL_USD',
        'USD_BRL',
        'BRL_EUR',
        'EUR_BRL',
    ];

    /**
     * Get currency symbol.
     *
     * @param string $currency Currency code
     *
     * @return string Currency symbol
     */
    public function getSymbol(string $currency): string
    {
        return self::SUPPORTED_CURRENCIES[$currency] ?? '';
    }

    /**
     * Check if conversion is valid.
     *
     * @param string $from Source currency
     * @param string $to   Target currency
     *
     * @return bool True if valid conversion
     */
    public function isValidConversion(string $from, string $to): bool
    {
        $conversion = "{$from}_{$to}";

        return in_array($conversion, self::VALID_CONVERSIONS, true);
    }

    /**
     * Convert amount between currencies.
     *
     * @param float  $amount Amount to convert
     * @param float  $rate   Exchange rate
     * @param string $to     Target currency
     *
     * @return float Converted amount
     */
    public function convert(float $amount, float $rate, string $to): float
    {
        $convertedAmount = $amount * $rate;
        $symbol = $this->getSymbol($to);

        if ($symbol === '€') {
            return $convertedAmount;
        }

        return round($convertedAmount, 1);
    }
}
