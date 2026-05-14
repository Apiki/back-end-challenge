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
 * Parses and validates the incoming URI.
 *
 * Expected URI format (per challenge spec):
 *   /exchange/{amount}/{from}/{to}/{rate}
 *
 * Returns a typed ExchangeInput on success, or throws ExchangeException
 * with HTTP 400 on any malformed input.
 */
final class Request
{
    private const ROUTE_PREFIX     = 'exchange';
    private const EXPECTED_SEGMENTS = 4;

    public function __construct(private readonly string $uri)
    {
    }

    /**
     * Parses the URI and returns a validated ExchangeInput.
     *
     * @throws ExchangeException if the URI is malformed.
     */
    public function parse(): ExchangeInput
    {
        $path = $this->stripQueryString($this->uri);
        $segments = $this->splitPath($path);

        if (
            count($segments) !== self::EXPECTED_SEGMENTS + 1
            || $segments[0] !== self::ROUTE_PREFIX
        ) {
            throw ExchangeException::invalidRequest(
                'Usage: /exchange/{amount}/{from}/{to}/{rate}'
            );
        }

        [, $rawAmount, $rawFrom, $rawTo, $rawRate] = $segments;

        $amount = $this->parsePositiveNumber($rawAmount, 'amount');
        $rate   = $this->parsePositiveNumber($rawRate, 'rate');
        $from   = $this->parseCurrency($rawFrom, 'from');
        $to     = $this->parseCurrency($rawTo, 'to');

        return new ExchangeInput($amount, $from, $to, $rate);
    }

    /**
     * Removes a query string (?key=value) if present.
     */
    private function stripQueryString(string $uri): string
    {
        $pos = strpos($uri, '?');
        return $pos === false ? $uri : substr($uri, 0, $pos);
    }

    /**
     * Splits a URI path on '/', preserving zero-valued segments.
     *
     * Avoids array_filter() without a callback, which would
     * incorrectly drop the literal string "0".
     *
     * @return list<string>
     */
    private function splitPath(string $path): array
    {
        $trimmed = trim($path, '/');
        if ($trimmed === '') {
            return [];
        }
        return explode('/', $trimmed);
    }

    /**
     * Parses a string as a positive (> 0) decimal number.
     *
     * @throws ExchangeException if the value is not a valid positive number.
     */
    private function parsePositiveNumber(string $value, string $field): float
    {
        if (!preg_match('/^\d+(\.\d+)?$/', $value)) {
            throw ExchangeException::invalidRequest(
                "'{$field}' must be a positive number, got '{$value}'"
            );
        }

        $number = (float) $value;

        if ($number <= 0.0) {
            throw ExchangeException::invalidRequest(
                "'{$field}' must be greater than zero"
            );
        }

        return $number;
    }

    /**
     * Parses a string as a supported Currency.
     *
     * @throws ExchangeException if the code is not supported.
     */
    private function parseCurrency(string $value, string $field): Currency
    {
        $currency = Currency::fromCode($value);

        if ($currency === null) {
            $supported = implode(', ', array_column(Currency::cases(), 'value'));
            throw ExchangeException::invalidRequest(
                "'{$field}' must be one of: {$supported}. Got '{$value}'"
            );
        }

        return $currency;
    }
}
