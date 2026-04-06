<?php
/**
 * Exchange request factory.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Eduardo Lopes <eduardo.frlopes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Exchange;

use App\Http\BadRequestException;

/**
 * Build exchange requests from URIs.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Eduardo Lopes <eduardo.frlopes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeRequestFactory
{
    /**
     * Supported currencies.
     *
     * @var string[]
     */
    private array $_supportedCurrencies = ['BRL', 'USD', 'EUR'];

    /**
     * Build a request from a URI.
     *
     * @param string $uri Request URI.
     *
     * @return ExchangeRequest
     * @throws BadRequestException
     */
    public function fromUri(string $uri): ExchangeRequest
    {
        $path = parse_url($uri, PHP_URL_PATH);
        $pattern = '#^/exchange/'
            . '([^/]+)/'
            . '([^/]+)/'
            . '([^/]+)/'
            . '([^/]+)$#';

        if (!is_string($path)) {
            throw new BadRequestException();
        }

        if (preg_match($pattern, $path, $segments) !== 1) {
            throw new BadRequestException();
        }

        [, $amount, $from, $to, $rate] = $segments;

        if (!$this->_isValidNumber($amount) || !$this->_isValidNumber($rate)) {
            throw new BadRequestException();
        }

        if (!$this->_isValidCurrency($from) || !$this->_isValidCurrency($to)) {
            throw new BadRequestException();
        }

        return new ExchangeRequest((float) $amount, $from, $to, (float) $rate);
    }

    /**
     * Validate a numeric input.
     *
     * @param string $value Numeric string.
     *
     * @return bool
     */
    private function _isValidNumber(string $value): bool
    {
        $number = (float) $value;

        return is_numeric($value) && is_finite($number) && $number >= 0;
    }

    /**
     * Validate a supported currency.
     *
     * @param string $currency Currency code.
     *
     * @return bool
     */
    private function _isValidCurrency(string $currency): bool
    {
        return preg_match('/^[A-Z]{3}$/', $currency) === 1
            && in_array($currency, $this->_supportedCurrencies, true);
    }
}
