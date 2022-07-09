<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Luis Paiva <contato@luispaiva.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/luispaiva/back-end-challenge/tree/luis-paiva
 */

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Helpers\Validate;

/**
 * Exchange class.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Luis Paiva <contato@luispaiva.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/luispaiva/back-end-challenge/tree/luis-paiva
 */
final class Exchange
{
    /**
     * Currency Symbols.
     *
     * @var array
     */
    public $currencySymbol = [
        'EUR' => '€',
        'USD' => '$',
        'BRL' => 'R$',
    ];

    /**
     * Init.
     *
     * @param Request  $request  Request object.
     * @param Response $response Response object.
     * @param array    $args     Arguments.
     *
     * @return Response
     */
    public function init(Request $request, Response $response, array $args): Response
    {
        $validate = Validate::args($args);

        if ($validate !== true) {
            return $response->withJson($validate, $validate->code);
        }

        $data = [
            'valorConvertido' => $this->convert($args['amount'], $args['rate']),
            'simboloMoeda' => $this->currencySymbol[$args['to']],
        ];

        return $response->withJson($data, 200);
    }

    /**
     * Convert.
     *
     * @param int|float $amount Amount.
     * @param int|float $rate   Rate.
     *
     * @return float
     */
    public function convert($amount, $rate): float
    {
        return floatval(number_format($amount * $rate, 2, '.', ''));
    }
}
