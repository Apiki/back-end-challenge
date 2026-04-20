<?php
/**
 * Currency conversion for supported pairs.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Leonardo Silva <leonardosilvadelima534@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
namespace App\Services;

/**
 * Currency conversion for supported pairs.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Leonardo Silva <leonardosilvadelima534@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
final class CurrencyConverter
{
    private array $_symbolsByCurrency = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€',
    ];

    /**
     * Allowed from:to conversion keys.
     *
     * @var array
     */
    private array $_allowedConversions = [
        'BRL:USD' => true,
        'USD:BRL' => true,
        'BRL:EUR' => true,
        'EUR:BRL' => true,
    ];

    /**
     * Whether the pair is supported.
     *
     * @param string $from Source currency code.
     * @param string $to   Target currency code.
     *
     * @return bool
     */
    public function canConvert(string $from, string $to): bool
    {
        return isset($this->_allowedConversions[$from . ':' . $to]);
    }

    /**
     * Convert amount using rate; symbol matches target currency.
     *
     * @param float  $amount Amount in source currency.
     * @param string $to     Target currency code.
     * @param float  $rate   Rate applied to amount.
     *
     * @return array
     */
    public function convert(float $amount, string $to, float $rate): array
    {
        return [
            'valorConvertido' => round($amount * $rate, 2),
            'simboloMoeda' => $this->_symbolsByCurrency[$to],
        ];
    }
}
