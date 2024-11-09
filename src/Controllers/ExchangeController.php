<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este arquivo contém o controller para conversões entre diferentes moedas
 *
 * @category Exchange
 * @package  Controllers
 * @author   Raphael Ceccato Pauli <raphaelcpauli@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/raphaelceccato/back-end-challenge
 */

namespace App\Controllers;


use App\Utils\ControllerException;


/**
 * Classe ExchangeController
 * 
 * Controller responsável por converter valores entre moedas
 * 
 * @category Exchange
 * @package  Controllers
 * @author   Raphael Ceccato Pauli <raphaelcpauli@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/raphaelceccato/back-end-challenge
 */
class ExchangeController
{
    private $_symbols = [
        "BRL" => "R$",
        "USD" => "$",
        "EUR" => "€"
    ];


    /**
     * Converte um valor de uma moeda para outra
     *
     * @param string|null $value O valor a ser convertido
     * @param string|null $from  A moeda de origem
     * @param string|null $to    A moeda de destino
     * @param string|null $rate  A taxa de câmbio
     * 
     * @return array Resultado da conversão com o valor convertido
     *               e o símbolo da moeda de origem e o símbolo da moeda de destino
     * 
     * @throws ControllerException Se os parâmetros forem inválidos
     */
    public function exchange(
        ?string $value, ?string $from, ?string $to, ?string $rate
    ) {
        if (!is_numeric($value)
            || !is_numeric($rate)
            || !isset($this->_symbols[$from])
            || !isset($this->_symbols[$to])
            || $value < 0
            || $rate < 0
        ) {
            throw new ControllerException(400, "Requisição inválida");
        }

        return [
            "valorConvertido" => floatval($value) * floatval($rate),
            "simboloMoeda" => $this->_symbols[$to]
        ];
    }
}
