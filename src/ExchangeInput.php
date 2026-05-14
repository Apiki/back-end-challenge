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
