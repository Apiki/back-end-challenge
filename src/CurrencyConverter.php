<?php
/**
 * CurrencyConverter class.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Claude AI <claude@anthropic.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App;

/**
 * CurrencyConverter class to handle currency conversions.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Claude AI <claude@anthropic.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class CurrencyConverter
{
    private const VALID_CURRENCIES = ['BRL', 'USD', 'EUR'];

    private const CURRENCY_SYMBOLS = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€',
    ];

    /**
     * Validate the input parameters.
     *
     * @param string $amount Amount to convert
     * @param string $from   Source currency
     * @param string $to     Target currency
     * @param string $rate   Conversion rate
     *
     * @return array Validation result
     */
    public function validate(
        string $amount,
        string $from,
        string $to,
        string $rate
    ): array {
        // Validate amount
        if (!is_numeric($amount) || (float) $amount < 0) {
            return ['valid' => false, 'error' => 'Invalid amount'];
        }

        // Validate from currency
        if (!in_array($from, self::VALID_CURRENCIES)) {
            return ['valid' => false, 'error' => 'Invalid source currency'];
        }

        // Validate to currency
        if (!in_array($to, self::VALID_CURRENCIES)) {
            return ['valid' => false, 'error' => 'Invalid target currency'];
        }

        // Validate rate
        if (!is_numeric($rate) || (float) $rate < 0) {
            return ['valid' => false, 'error' => 'Invalid rate'];
        }

        return ['valid' => true];
    }

    /**
     * Convert currency.
     *
     * @param float  $amount Amount to convert
     * @param string $from   Source currency
     * @param string $to     Target currency
     * @param float  $rate   Conversion rate
     *
     * @return array Conversion result with value and symbol
     */
    public function convert(
        float $amount,
        string $from,
        string $to,
        float $rate
    ): array {
        $convertedValue = $amount * $rate;
        $symbol = self::CURRENCY_SYMBOLS[$to];

        return [
            'valorConvertido' => $convertedValue,
            'simboloMoeda' => $symbol,
        ];
    }
}
