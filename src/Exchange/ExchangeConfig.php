<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App\Exchange;

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
        'INVALID_AMOUNT'   => 'Valor invalido. Use: > 0',
        'INVALID_CURRENCY' => 'Moeda invalida. Use: USD, BRL, EUR',
        'INVALID_RATE'     => 'Taxa invalida. Use: > 0',
        'INVALID_ROUTE'    => 'Rota invalida. Use: /exchange/{amount}/{from}/{to}/{rate}'
    ];
}
