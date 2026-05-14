<?php

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
