<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este arquivo contém as constantes e mensagens de erro.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Kayo Almondes Tusthler <kayotusthler@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Exchange;

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Esta classe é responsável por configurar as constantes e mensagens de erro.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Kayo Almondes Tusthler <kayotusthler@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeConfig
{
    public const ROUTE = 'exchange';

    public const SIGN_SYMBOL = [
        'BRL' => 'R$',
        'EUR' => '€',
        'USD' => '$'
    ];

    public const PERMITTED_CURRENCIES = [
        'BRL',
        'EUR',
        'USD'
    ];

    public const ERROR_MESSAGES = [
        'INVALID_AMOUNT'   => 'Valor invalido > 0',
        'INVALID_CURRENCY' => 'Moedas validas: USD, BRL, EUR',
        'INVALID_RATE'     => 'Taxa invalida. Use: > 0',
        'INVALID_ROUTE'    => 'Rota válida: /exchange/{amount}/{from}/{to}/{rate}'
    ];
}
