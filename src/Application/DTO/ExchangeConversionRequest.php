<?php

/**
 * ExchangeConversionRequest data transfer object.
 *
 * PHP version 7.4+
 *
 * Represents an exchange conversion request.
 *
 * @category Challenge
 * @package  App\Domain\Model
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Application\DTO;

/**
 * ExchangeConversionRequest class.
 *
 * Data transfer object for exchange conversion requests.
 *
 * @category Challenge
 * @package  App\Domain\Model
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeConversionRequest
{
    /**
     * Constructor.
     *
     * @param float  $amount The amount to exchange.
     * @param string $from   The source currency code.
     * @param string $to     The target currency code.
     * @param float  $rate   The exchange rate.
     */
    public function __construct(
        public float $amount,
        public string $from,
        public string $to,
        public float $rate
    ) {
    }
}
