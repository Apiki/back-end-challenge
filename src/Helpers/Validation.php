<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Lucas Felype Fonseca Santos <lucasfelypeqw@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App\Helpers;

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Lucas Felype Fonseca Santos <lucasfelypeqw@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Validation
{
    /**
     * Validate request data.
     *
     * @param array $data Request data.
     *
     * @return void
     */
    public static function validate($data)
    {
        $errors =  [];

        if (empty($data['amount']) || !self::_isPositiveNumber($data['amount'])) {
            $errors['amount'] = 'Amount value is invalid';
        }

        if (empty($data['rate']) || !self::_isPositiveNumber($data['rate'])) {
            $errors['rate'] = 'Rate value is invalid';
        }

        if (empty($data['from'])) {
            $errors['from'] = 'from value is empty';
        }
        if (empty($data['to'])) {
            $errors['to'] = 'to value is empty';
        }

        $montante = $data['from'] . '_' . $data['to'];

        switch ($montante) {
        case 'BRL_USD':
        case 'USD_BRL':
        case 'BRL_EUR':
        case 'EUR_BRL':
            break;

        default:
            $errors['conversion_type'] ='Unsupported conversion format';

        }
        if ($errors) {
            http_response_code(400);
            echo json_encode(['errors' => $errors]);
            exit;
        }
    }

    /**
     * Check if the given value is a positive number.
     *
     * @param mixed $number Value to validate.
     *
     * @return bool
     */
    private static function _isPositiveNumber($number)
    {
        return is_numeric($number) && $number > 0;
    }
}