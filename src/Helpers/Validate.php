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
 * @link     https://github.com/Apiki/back-end-challenge.
 */

namespace App\Helpers;

/**
 * Validate class.
 *
 * @category Validate.
 * @package  Back-end.
 * @author   Luis Paiva <contato@luispaiva.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/Apiki/back-end-challenge.
 */
final class Validate
{
    /**
     * Validate args.
     *
     * @param array $args Arguments.
     *
     * @return \stdClass|true
     */
    public static function args(array $args)
    {
        $attributes = ['amount', 'from', 'to', 'rate'];
        $error = new \stdClass();

        if (empty($args)) {
            $error->message = 'Missing parameters';
            $error->code = 400;
            return $error;
        }

        foreach ($attributes as $attribute) {
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

        if (! in_array($args['from'], ['EUR', 'USD', 'BRL'])) {
            $error->message = 'Invalid from currency';
            $error->code = 400;

            return $error;
        }

        if (! in_array($args['to'], ['EUR', 'USD', 'BRL'])) {
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
