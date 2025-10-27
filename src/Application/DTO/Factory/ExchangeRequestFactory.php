<?php

/**
 * ExchangeRequestFactory.
 *
 * PHP version 7.4+
 *
 * Factory for creating ExchangeConversionRequest from HTTP Request.
 *
 * @category Challenge
 * @package  App\Application\DTO\Factory
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Application\DTO\Factory;

use App\Application\DTO\ExchangeConversionRequest;
use App\Domain\Model\Exchange\Exception\InvalidAmountException;
use App\Domain\Model\Exchange\Exception\InvalidRateException;
use Symfony\Component\HttpFoundation\Request;

/**
 * ExchangeRequestFactory class.
 *
 * Creates ExchangeConversionRequest DTOs from HTTP requests with validation.
 *
 * @category Challenge
 * @package  App\Application\DTO\Factory
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeRequestFactory
{
    /**
     * Create an ExchangeConversionRequest from HTTP Request attributes.
     *
     * @param Request $request The HTTP request.
     *
     * @return ExchangeConversionRequest The created DTO.
     *
     * @throws InvalidAmountException When amount is invalid.
     * @throws InvalidRateException   When rate is invalid.
     */
    public static function fromRequest(Request $request): ExchangeConversionRequest
    {
        $amount = $request->attributes->get("amount");
        $from = $request->attributes->get("from");
        $to = $request->attributes->get("to");
        $rate = $request->attributes->get("rate");

        // Validate and convert amount
        if (!is_numeric($amount) || ($amountFloat = (float)$amount) <= 0) {
            throw new InvalidAmountException('Invalid amount');
        }

        // Validate and convert rate
        if (!is_numeric($rate) || ($rateFloat = (float)$rate) <= 0) {
            throw new InvalidRateException('Invalid exchange rate');
        }

        return new ExchangeConversionRequest($amountFloat, $from, $to, $rateFloat);
    }
}
