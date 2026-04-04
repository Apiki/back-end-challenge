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
 * Currency enum with supported currencies and their symbols.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Hahuma <firminopetterson@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
enum Currency: string
{
    case BRL = 'BRL';
    case USD = 'USD';
    case EUR = 'EUR';

    /**
     * Get the currency symbol.
     *
     * @return string
     */
    public function symbol(): string
    {
        return match ($this) {
            self::BRL => 'R$',
            self::USD => '$',
            self::EUR => '€',
        };
    }
}
