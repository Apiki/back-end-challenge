<?php
/**
 * Currency Converter.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App;

/**
 * Class CurrencyConverter
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class CurrencyConverter
{
    private const CURRENCY_SYMBOLS = [
        'USD' => '$',
        'BRL' => 'R$',
        'EUR' => '€',
    ];

    private const VALID_CONVERSIONS = [
        'BRL' => ['USD', 'EUR'],
        'USD' => ['BRL'],
        'EUR' => ['BRL'],
    ];

    /**
     * Convert currency.
     *
     * @param float  $amount The amount to convert.
     * @param string $from   The source currency.
     * @param string $to     The target currency.
     * @param float  $rate   The exchange rate.
     *
     * @return array
     */
    public function convert(
        float $amount,
        string $from,
        string $to,
        float $rate
    ): array {
        $this->_validate($amount, $from, $to, $rate);

        $convertedValue = $amount * $rate;

        return [
            'valorConvertido' => $convertedValue,
            'simboloMoeda'    => self::CURRENCY_SYMBOLS[$to],
        ];
    }

    /**
     * Validate conversion parameters.
     *
     * @param float  $amount The amount to convert.
     * @param string $from   The source currency.
     * @param string $to     The target currency.
     * @param float  $rate   The exchange rate.
     *
     * @return void
     *
     * @throws \InvalidArgumentException When parameters are invalid.
     */
    private function _validate(
        float $amount,
        string $from,
        string $to,
        float $rate
    ): void {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Invalid amount.');
        }

        if ($rate <= 0) {
            throw new \InvalidArgumentException('Invalid rate.');
        }

        if (!isset(self::CURRENCY_SYMBOLS[$from])) {
            throw new \InvalidArgumentException('Invalid source currency.');
        }

        if (!isset(self::CURRENCY_SYMBOLS[$to])) {
            throw new \InvalidArgumentException('Invalid target currency.');
        }

        if (!isset(self::VALID_CONVERSIONS[$from])
            || !in_array($to, self::VALID_CONVERSIONS[$from])
        ) {
            throw new \InvalidArgumentException('Invalid conversion.');
        }
    }
}
