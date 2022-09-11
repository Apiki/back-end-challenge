<?php
/**
 * Template File Doc Comment
 * 
 * PHP version 7.4
 *
 * @category Template_Class
 * @package  Template_Class
 * @author   Jhone Bering <jhonebering@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */

 /**
  * Template Class Doc Comment
  *
  * PHP version 7.4
  *
  * Este arquivo tem o propósito de realizar as covnersões de moedas.
  *
  * @category Challenge
  * @package  Back-end
  * @author   Jhone Bering <jhonebering@gmail.com>
  * @license  http://opensource.org/licenses/MIT MIT
  * @link     https://github.com/apiki/back-end-challenge
  */

class Exchange
{
    /**
     * ExchangeValue faz a conversão de uma moeda para outra 
     * conforme parametros indicados
     * 
     * @param string $from amount moeda que será convertida
     * @param string $to   rate moeda para qual deve ser convertida
     * 
     * @return array 
     */
    public function exchangeValue($from, $to)
    {
        $result = $from['value'] * $to['value'];

        return array(
        'valorConvertido' => $result,
        'simboloMoeda' => $to['simbol'],
        );
    }
}

?>