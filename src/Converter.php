<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.1
 *
 * @category Challenge
 * @package  Back-end
 * @author   Hahuma <firminopetterson@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App;

/**
 * Currency converter.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Hahuma <firminopetterson@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
final class Converter
{
    /**
     * Convert an amount using the given rate.
     *
     * @param float    $amount Target amount.
     * @param Currency $to     Target currency.
     * @param float    $rate   Exchange rate.
     *
     * @return array{valorConvertido: float, simboloMoeda: string}
     */
    public static function convert(float $amount, Currency $to, float $rate): array
    {
        return [
            'valorConvertido' => $amount * $rate,
            'simboloMoeda' => $to->symbol(),
        ];
    }
}
