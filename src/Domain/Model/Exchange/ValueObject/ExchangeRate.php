<?php

/**
 * ExchangeRate value object.
 *
 * PHP version 7.4+
 *
 * Represents an exchange rate between two currencies.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\ValueObject
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Domain\Model\Exchange\ValueObject;

use App\Domain\Model\Exchange\Exception\InvalidRateException;

/**
 * ExchangeRate class.
 *
 * Immutable value object representing an exchange rate.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\ValueObject
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeRate
{
    private float $_value;

    /**
     * Constructor.
     *
     * @param float $value The exchange rate value.
     *
     * @throws InvalidRateException When rate is invalid.
     */
    public function __construct(float $value)
    {
        if ($value <= 0) {
            throw new InvalidRateException('Exchange rate must be positive');
        }

        $this->_value = $value;
    }

    /**
     * Get the rate value.
     *
     * @return float The rate value.
     */
    public function getValue(): float
    {
        return $this->_value;
    }
}
