<?php

/**
 * ICurrencyRepository interface.
 *
 * PHP version 7.4+
 *
 * Contract for currency validation and lookup.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\Repository
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Domain\Model\Exchange\Repository;

use App\Domain\Model\Exchange\Exception\InvalidCurrencyException;

/**
 * ICurrencyRepository interface.
 *
 * Defines contract for currency validation and information lookup.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\Repository
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
interface ICurrencyRepository
{
    /**
     * Check if currency code is valid.
     *
     * @param string $code The currency code.
     *
     * @return bool True if valid, false otherwise.
     */
    public function isValid(string $code): bool;

    /**
     * Get symbol for currency.
     *
     * @param string $code The currency code.
     *
     * @return string The currency symbol.
     *
     * @throws InvalidCurrencyException When currency is not found.
     */
    public function getSymbol(string $code): string;
}
