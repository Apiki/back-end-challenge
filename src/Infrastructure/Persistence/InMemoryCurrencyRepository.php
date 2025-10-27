<?php

/**
 * InMemoryCurrencyRepository.
 *
 * PHP version 7.4+
 *
 * In-memory implementation of currency repository.
 *
 * @category Challenge
 * @package  App\Infrastructure\Persistence
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Model\Exchange\Exception\InvalidCurrencyException;
use App\Domain\Model\Exchange\Repository\ICurrencyRepository;

/**
 * InMemoryCurrencyRepository class.
 *
 * Stores currency data in memory.
 *
 * @category Challenge
 * @package  App\Infrastructure\Persistence
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class InMemoryCurrencyRepository implements ICurrencyRepository
{
    private const CURRENCIES = [
        "BRL" => "R$",
        "USD" => "$",
        "EUR" => "€",
    ];

    /**
     * Check if currency code is valid.
     *
     * @param string $code The currency code.
     *
     * @return bool True if valid, false otherwise.
     */
    public function isValid(string $code): bool
    {
        $upper = strtoupper($code);
        return isset(self::CURRENCIES[$upper]) && $code === $upper;
    }

    /**
     * Get symbol for currency.
     *
     * @param string $code The currency code.
     *
     * @return string The currency symbol.
     *
     * @throws InvalidCurrencyException When currency is not found.
     */
    public function getSymbol(string $code): string
    {
        if (!isset(self::CURRENCIES[$code])) {
            throw new InvalidCurrencyException(
                "Unsupported currency: {$code}"
            );
        }

        return self::CURRENCIES[$code];
    }
}
