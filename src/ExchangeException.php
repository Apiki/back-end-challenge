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

use RuntimeException;

/**
 * Domain exception for business-rule violations during exchange processing.
 */
final class ExchangeException extends RuntimeException
{
    public static function invalidRequest(string $reason): self
    {
        return new self('Invalid request: ' . $reason, 400);
    }
}
