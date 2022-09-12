<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Arquivo de conversão de moedas
 *
 * @category Challenge
 * @package  Back-end
 * @author   Pedro Henrique da Silva <pedrohenriquedasilva100@yahoo.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App\Controller;

/**
 * Essa classe controla faz a conversão de moedas
 * 
 * @category Challenge
 * @package  Api
 * @author   Pedro Henrique da Silva <pedrohenriquedasilva100@yahoo.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Api
{
    /**
     * Esse método recebe os dados da url e faz a conversão das moedas
     * 
     * @param float $amount  recebe o valor a ser convertido
     * @param string $from   recebe a moeda de origem da conversão
     * @param string $to     recebe a moeda a ser convertida
     * @param float $rate    recebe o valor base para conversão
     * 
     * @return json
     */
    public function conversion(float $amount, string $from, string $to, float $rate)
    {
        $moedas = array(
            "BRL" => "R$",
            "USD" => "$",
            "EUR" => "€",
        );

        if ($this->tipos($from, $to)) {
            $convert = $amount * $rate;

            $data["valorConvertido"] = $convert;
            $data["simboloMoeda"] = @$moedas[$to];
        } else {
            $data["response"] = false;
        }

        return json_encode($data);
    }

    /**
     * Esse método verifica se o tipo passado na url é um tipo válido
     * 
     * @param string $from recebe a moeda de origem da conversão
     * @param string $to   recebe a moeda a ser convertida
     * 
     * @return bool
     */
    public function tipos(string $from, string $to)
    {
        $tipos = array(
            "BRL" => ["USD", "EUR"],
            "USD" => ["BRL"],
            "EUR" => ["BRL"],
        );

        if (in_array($to, @$tipos[$from])) {
            return true;
        } else {
            return false;
        }
    }
}
