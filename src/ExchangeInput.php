<?php

declare(strict_types=1);

namespace App;

/**
 * Immutable value object representing a validated exchange request.
 */
final class ExchangeInput
{
    public function __construct(
        public readonly float $amount,
        public readonly Currency $from,
        public readonly Currency $to,
        public readonly float $rate,
    ) {
    }
}
