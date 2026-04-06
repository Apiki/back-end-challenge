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

namespace App\Service;

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
class ConverterService
{
    /**
     * Convert amount to target currency.
     *
     * @param float  $amount Amount to convert.
     * @param string $to     Target currency (BRL, USD, EUR).
     * @param float  $rate   Exchange rate.
     *
     * @return array
     */
    public function convert($amount, $to, $rate): array
    {
        $simbolo = '';

        switch ($to) {
        case 'BRL':
            $simbolo = 'R$';
            break;

        case 'USD':
            $simbolo = '$';
            break;

        case 'EUR':
            $simbolo = '€';
            break;
        }

        return [
            'valorConvertido' => $amount * $rate,
            'simboloMoeda' => $simbolo,

        ];
    }
}