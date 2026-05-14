<?php

/**
 * Back-end Challenge.
 *
 * PHP version 8.1
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
 * Supported currencies and their display symbols.
 *
 * Using a backed enum guarantees only valid codes flow through
 * the system — invalid input is rejected at the type level.
 */
enum Currency: string
{
    case BRL = 'BRL';
    case USD = 'USD';
    case EUR = 'EUR';

    /**
     * Returns the currency display symbol.
     */
    public function symbol(): string
    {
        return match ($this) {
            Currency::BRL => 'R$',
            Currency::USD => '$',
            Currency::EUR => '€',
        };
    }

    /**
     * Returns the matching Currency for the given code, or null
     * if the code is not supported. Case-sensitive on purpose:
     * the spec defines the codes in upper case.
     */
    public static function fromCode(string $code): ?self
    {
        return self::tryFrom($code);
    }
}
