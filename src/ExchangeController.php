<?php

/**
 * This file contains the ExchangeController class
 * responsible for handling currency conversion requests.
 *
 * PHP version 8.1
 *
 * @category Controller
 * @package  Exchange
 * @author   Reza Rastegarian <rastgar245@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);
require_once 'utils/CurrencyConverter.php';

/**
 * Handles currency conversion logic.
 *
 * This class provides methods to validate inputs, perform currency conversions using
 * the CurrencyConverter class, and return error responses consistently.
 * 
 * @category Class
 * @package  CurrencyConversion
 * @author   Reza Rastegarian <rastgar245@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeController
{
    // All currencies we support
    private const _SUPPORTED_CURRENCIES = ["EUR", "BRL", "USD"];
    private const _CURRENCY_SYMBOLS = [
        'USD' => '$',
        'BRL' => 'R$',
        'EUR' => '€',
    ];


    /**
     * This method validates the input amount and rate, checks that 
     * the currencies are supported, and uses the CurrencyConverter class
     * to perform the conversion.
     *
     * @param string $amount The amount to convert.
     * @param string $from   The currency to convert from.
     * @param string $to     The currency to convert to.
     * @param string $rate   The exchange rate to apply.
     *
     * @return array Returns the converted amount and the target currency symbol.
     */
    public function convertCurrency($amount, $from, $to, $rate)
    {
        // This condition checks that the amount and rate are numbers and positive
        if (!is_numeric($amount) || !is_numeric($rate) || $amount < 0 || $rate < 0) {
            return $this->_errorResponse(
                400,
                'Amount and rate must be non-negative numbers'
            );
        }

        // This condition checks that the currencies we support are valid
        if (!$this->_isSuppCurrency($from) || !$this->_isSuppCurrency($to)) {
            return $this->_errorResponse(
                400,
                'Invalid currency codes'
            );
        }

        // This is a tool that converts currencies to
        // each other with a specific exchange rate
        $converter = new CurrencyConverter();
        $convertedValue = $converter->convert((float)$amount, (float)$rate);


        return [
            'valorConvertido' => $convertedValue,
            'simboloMoeda' => self::_CURRENCY_SYMBOLS[$to] ?? '',
        ];
    }



    /**
     * Checks if the given currency is supported by the system.
     *
     * @param string $currency currency name.
     * 
     * @return bool Returns the error message
     */
    private function _isSuppCurrency($currency)
    {

        return in_array($currency, self::_SUPPORTED_CURRENCIES, true);
    }


    /**
     * Returns an error response with a specified status code.
     * Implements the DRY principle to avoid repetitive error handling logic.
     *
     * @param int    $statusCode The error status code.
     * @param string $message    The error message.
     * 
     * @return array Returns the error message
     */
    private function _errorResponse($statusCode, $message)
    {

        http_response_code($statusCode);
        return ['error' => $message];
    }
}
