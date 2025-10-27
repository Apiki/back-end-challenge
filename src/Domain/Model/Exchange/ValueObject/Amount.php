<?php

/**
 * Amount value object.
 *
 * PHP version 7.4+
 *
 * Represents a monetary amount with validation.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\ValueObject
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Domain\Model\Exchange\ValueObject;

use App\Domain\Model\Exchange\Exception\InvalidAmountException;

/**
 * Amount class.
 *
 * Immutable value object representing a monetary amount.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\ValueObject
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Amount
{
    private float $_value;

    /**
     * Constructor.
     *
     * @param float $value The amount value.
     *
     * @throws InvalidAmountException When amount is invalid.
     */
    public function __construct(float $value)
    {
        if ($value <= 0) {
            throw new InvalidAmountException('Amount must be positive');
        }

        $this->_value = $value;
    }

    /**
     * Get the amount value.
     *
     * @return float The amount value.
     */
    public function getValue(): float
    {
        return $this->_value;
    }

    /**
     * Multiply amount by a factor.
     *
     * @param float $factor The multiplication factor.
     *
     * @return float The result of multiplication.
     */
    public function multiply(float $factor): float
    {
        return $this->_value * $factor;
    }
}
