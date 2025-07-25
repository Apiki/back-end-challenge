<?php
/**
 * Exchange Service.
 *
 * PHP version 8.3
 *
 * @category Challenge
 * @package  Back-end
 * @author   Lucas Sens <lucassousase@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App;

/**
 * Currency exchange service.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Lucas Sens <lucassousase@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeService
{
    private const SUPPORTED_CURRENCIES = ['BRL', 'USD', 'EUR'];
    private const CURRENCY_SYMBOLS = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€'
    ];

    /**
     * Convert value from one currency to another.
     *
     * @param string $amount Amount to convert
     * @param string $from   Source currency
     * @param string $to     Target currency
     * @param string $rate   Exchange rate
     *
     * @return array
     */
    public function convert(
        string $amount,
        string $from,
        string $to,
        string $rate
    ): array {
        $this->_validateAmount($amount);
        $this->_validateCurrency($from, 'source currency');
        $this->_validateCurrency($to, 'target currency');
        $this->_validateRate($rate);

        $amountFloat = (float) $amount;
        $rateFloat = (float) $rate;

        $convertedValue = $amountFloat * $rateFloat;

        return [
            'valorConvertido' => $convertedValue,
            'simboloMoeda' => self::CURRENCY_SYMBOLS[$to]
        ];
    }

    /**
     * Validate amount.
     *
     * @param string $amount Amount to validate
     *
     * @return void
     */
    private function _validateAmount(string $amount): void
    {
        if (!is_numeric($amount)) {
            throw new \InvalidArgumentException('Amount must be numeric');
        }

        $amountFloat = (float) $amount;
        if ($amountFloat <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than zero');
        }
    }

    /**
     * Validate currency.
     *
     * @param string $currency Currency to validate
     * @param string $context  Context for error message
     *
     * @return void
     */
    private function _validateCurrency(string $currency, string $context): void
    {
        if (!in_array($currency, self::SUPPORTED_CURRENCIES, true)) {
            throw new \InvalidArgumentException("{$context} not supported");
        }
    }

    /**
     * Validate exchange rate.
     *
     * @param string $rate Rate to validate
     *
     * @return void
     */
    private function _validateRate(string $rate): void
    {
        if (!is_numeric($rate)) {
            throw new \InvalidArgumentException('Exchange rate must be numeric');
        }

        $rateFloat = (float) $rate;
        if ($rateFloat <= 0) {
            throw new \InvalidArgumentException(
                'Exchange rate must be greater than zero'
            );
        }
    }
} 
