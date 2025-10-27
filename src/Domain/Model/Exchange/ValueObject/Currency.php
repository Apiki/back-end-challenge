<?php

/**
 * Currency value object.
 *
 * PHP version 7.4+
 *
 * Represents a currency code.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\ValueObject
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Domain\Model\Exchange\ValueObject;

/**
 * Currency class.
 *
 * Immutable value object representing a currency code.
 *
 * @category Challenge
 * @package  App\Domain\Model\Exchange\ValueObject
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Currency
{
    private string $_code;

    /**
     * Constructor.
     *
     * @param string $code The currency code.
     */
    public function __construct(string $code)
    {
        $this->_code = strtoupper($code);
    }

    /**
     * Get the currency code.
     *
     * @return string The currency code.
     */
    public function getCode(): string
    {
        return $this->_code;
    }

    /**
     * Convert to string.
     *
     * @return string The currency code.
     */
    public function __toString(): string
    {
        return $this->_code;
    }
}

