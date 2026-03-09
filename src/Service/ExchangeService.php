<?php

/**
 * Arquivo da classe ExchangeService
 *
 * @category Service
 * @package  App
 * @author   Ivana Miranda <ivanagv@gmail.com>
 * @license  MIT https://opensource.org
 * @link     http://localhost:8000
 */

namespace App\Service;

/**
 * Classe ExchangeService
 *
 * @category Service
 * @package  App
 * @author   Ivana Miranda <ivanagv@gmail.com>
 * @license  MIT https://opensource.org
 * @link     http://localhost:8000
 */
class ExchangeService
{
    /**
     * Converte o valor baseado na taxa.
     *
     * @param float  $amount Valor original
     * @param string $rate   Taxa de cambio
     * @param string $to     Moeda destino
     *
     * @return array
     */
    public function convert(float $amount, float $rate, string $to): array
    {
        $valorConvertido = $amount * $rate;

        $symbols = [
            'USD' => '$',
            'BRL' => 'R$',
            'EUR' => '€'
        ];

        return [
            'valorConvertido' => $valorConvertido,
            'simboloMoeda' => $symbols[$to] ?? ''
        ];
    }
}
