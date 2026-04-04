<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.1
 *
 * @category Challenge
 * @package  Back-end
 * @author   Hahuma <firminopetterson@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App;

/**
 * Request parameter validator.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Hahuma <firminopetterson@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
final class Validator
{
    /**
     * Validate URI segments and return parsed parameters.
     *
     * @param array<int, string> $segments URI path segments.
     *
     * @return array{amount: float, from: Currency, to: Currency, rate: float}
     *
     * @throws ValidationException When input is invalid.
     */
    public static function validate(array $segments): array
    {
        if (count($segments) !== 4) {
            throw new ValidationException(
                'Missing required parameters.'
            );
        }

        [$rawAmount, $rawFrom, $rawTo, $rawRate] = $segments;

        if (!is_numeric($rawAmount) || (float) $rawAmount <= 0) {
            throw new ValidationException('Invalid amount.');
        }

        if (!is_numeric($rawRate) || (float) $rawRate <= 0) {
            throw new ValidationException('Invalid rate.');
        }

        $from = self::_parseCurrency($rawFrom);
        $to = self::_parseCurrency($rawTo);

        return [
            'amount' => (float) $rawAmount,
            'from' => $from,
            'to' => $to,
            'rate' => (float) $rawRate,
        ];
    }

    /**
     * Parse and validate a currency code.
     *
     * @param string $code Raw currency code.
     *
     * @return Currency
     *
     * @throws ValidationException When currency code is invalid.
     */
    private static function _parseCurrency(string $code): Currency
    {
        if (preg_match('/^[A-Z]{3}$/', $code) !== 1) {
            throw new ValidationException(
                'Invalid currency code.'
            );
        }

        $currency = Currency::tryFrom($code);

        if ($currency === null) {
            throw new ValidationException(
                'Unsupported currency.'
            );
        }

        return $currency;
    }
}
