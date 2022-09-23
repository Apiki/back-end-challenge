<?php

/**
 * Este será o arquivo de Controller.
 * 
 * PHP version 8.0.0
 *
 * @category Controller
 * @package  Controller
 * @author   Diego de Sousa Dias <diasdsdiego@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/Dias-D/Apiki-Challenge
 */

namespace App\Controller;

use App\Exception\BadRequestException;
use stdClass;

/**
 * Este será o arquivo de uma classe de erro.
 * 
 * PHP version 8.0.0
 *
 * @category Convert_Controller_Class
 * @package  Convert_Controller_Class
 * @author   Diego de Sousa Dias <diasdsdiego@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/Dias-D/Apiki-Challenge
 */

class ConvertController
{
    private array $_coinSignals = ['BRL' => 'R$', 'USD' => '$', 'EUR' => '€'];

    /**
     * Função
     * 
     * @param float  $amount valores inteiros e flultuantes 
     * @param string $from   Sigla de moeda original 
     * @param string $to     Sigla de moeda do valor convertido
     * @param float  $rate   valores inteiros e flultuantes 
     *
     * @return json_enconde response
     */
    public function convert(string $amount, string $from, string $to, string $rate)
    {
        $validation = $this->_validate($amount, $from, $to, $rate);

        if (!$validation->isValid) {
            throw new BadRequestException();
        }

        echo json_encode(
            [
                "valorConvertido" => $validation->amount * $validation->rate,
                "simboloMoeda" => $this->_coinSignals[$validation->to]
            ]
        );

        exit;
    }

    /**
     * Basic function to return a bad request
     * 
     * @param float  $amount valores inteiros e flultuantes 
     * @param string $from   Sigla de moeda original 
     * @param string $to     Sigla de moeda do valor convertido
     * @param float  $rate   valores inteiros e flultuantes 
     *
     * @return object
     */
    private function _validate($amount, $from, $to, $rate): object
    {
        $validsCurrencies = array_keys($this->_coinSignals);
        $validated = new stdClass();
        $validated->isValid = true;
        $options = ['options' => ['min_range' => 0]];

        $amount = filter_var($amount, FILTER_VALIDATE_FLOAT, $options);
        $rate = filter_var($rate, FILTER_VALIDATE_FLOAT, $options);
        $from = in_array($from, $validsCurrencies) ? $from : false;
        $to = in_array($to, $validsCurrencies) ? $to : false;

        if (!$amount || !$rate || !$from || !$to || $from == $to) {
            $validated->isValid = false;
            return $validated;
        }

        $validated->amount  = $amount;
        $validated->rate    = $rate;
        $validated->$from   = $from;
        $validated->to      = $to;

        return $validated;
    }
}
