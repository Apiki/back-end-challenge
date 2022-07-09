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
     * Attributes names.
     *
     * @var array
     */
    private static $_attributes = ['amount', 'from', 'to', 'rate'];

    /**
     * From currency.
     *
     * @var array
     */
    private static $_from = ['EUR', 'USD', 'BRL'];

    /**
     * To currency.
     *
     * @var array
     */
    private static $_to = ['EUR', 'USD', 'BRL'];

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

        foreach (self::$_attributes as $attribute) {
            if (! isset($args[$attribute])) {
                $error->message = "Missing {$attribute} parameter";
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

        if (! in_array($args['from'], self::$_from)) {
            $error->message = 'Invalid from currency';
            $error->code = 400;

            return $error;
        }

        if (! in_array($args['to'], self::$_to)) {
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
