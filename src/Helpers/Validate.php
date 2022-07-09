<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * @category Validate.
 * @package  Back-end.
 * @author   Luis Paiva <contato@luispaiva.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/luispaiva/back-end-challenge/tree/luis-paiva.
 */

namespace App\Helpers;

/**
 * Validate class.
 *
 * @category Validate.
 * @package  Back-end.
 * @author   Luis Paiva <contato@luispaiva.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/luispaiva/back-end-challenge/tree/luis-paiva.
 */
final class Validate
{
    /**
     * Parameter names.
     *
     * @var array
     */
    private static $_parameterNames = ['amount', 'from', 'to', 'rate'];

    /**
     * From currency.
     *
     * @var array
     */
    private static $_fromCurrency = ['EUR', 'USD', 'BRL'];

    /**
     * To currency.
     *
     * @var array
     */
    private static $_toCurrency = ['EUR', 'USD', 'BRL'];

    /**
     * Validate args.
     *
     * @param array $args Arguments.
     *
     * @return \stdClass|true
     */
    public static function args(array $args)
    {
        $error = new \stdClass();

        if (empty($args)) {
            $error->message = 'Missing parameters';
            $error->code = 400;

            return $error;
        }

        foreach (self::$_parameterNames as $parameter) {
            if (! isset($args[$parameter])) {
                $error->message = "Missing {$parameter} parameter";
                $error->code = 400;

                return $error;
            }
        }

        if (! is_numeric($args['amount'])) {
            $error->message = 'Invalid amount';
            $error->code = 400;

            return $error;
        }

        if ($args['amount'] < 0) {
            $error->message = 'Amount must be greater than 0';
            $error->code = 400;

            return $error;
        }

        if (! in_array($args['from'], self::$_fromCurrency)) {
            $error->message = 'Invalid from currency';
            $error->code = 400;

            return $error;
        }

        if (! in_array($args['to'], self::$_toCurrency)) {
            $error->message = 'Invalid to currency';
            $error->code = 400;

            return $error;
        }

        if (! is_numeric($args['rate'])) {
            $error->message = 'Invalid rate';
            $error->code = 400;

            return $error;
        }

        if ($args['rate'] < 0) {
            $error->message = 'Rate must be greater than 0';
            $error->code = 400;

            return $error;
        }

        return true;
    }
}
