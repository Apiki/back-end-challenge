<?php
/**
 * Arquivo da classe ConvertCurrency
 * 
 * PHP version 7.4
 * 
 * @category ConvertCurrency
 * @package  Back-end
 * @author   Alan Pardini Sant Ana <alanps2012@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App;

/**
 * Classe que faz a mágica.
 * 
 * PHP version 7.4
 * 
 * @category Class
 * @package  ConvertCurrency
 * @author   Alan Pardini Sant Ana <alanps2012@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ConvertCurrency
{

    private $_amount;
    private $_from;
    private $_to;
    private $_rate;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->_amount = explode("/", $_SERVER['REQUEST_URI'])[2];
        $this->_from = explode("/", $_SERVER['REQUEST_URI'])[3];
        $this->_to = explode("/", $_SERVER['REQUEST_URI'])[4];
        $this->_rate = explode("/", $_SERVER['REQUEST_URI'])[5];
    }

    /**
     * Função para checar se o AMOUNT é um número
     *
     * @param float $amount Número que deseja converter
     *
     * @return null Não retorna nada, somente envia para outra função
     */
    public function checkAmount($amount) :void
    {
        if (!is_numeric($amount)) {
            $this->jsonEncode('O paramêtro AMOUNT não é um número.', 400);
        }
    }

    /**
     * Função para checar se o RATE é um número
     *
     * @param float $rate Rate da moeda de conversão
     *
     * @return null Não retorna nada, somente envia para outra função
     */
    public function checkRate($rate)
    {
        if (!is_numeric($rate)) {
            $this->jsonEncode('O paramêtro RATE não é um número.', 400);
        }
    }

    /**
     * Função para checar se o FROM é BRL, EUR ou USD
     * 
     * @param string $from Moeda original
     *
     * @return null Não retorna nada, somente envia para outra função
     */
    public function checkFrom($from)
    {
        if ($from != "BRL" && $from != "EUR" && $from != "USD") {
            $this->jsonEncode(
                'Não é possível fazer a conversão dessa moeda do paramêtro 
                FROM, somente REAL (BRL), EURO (EUR) ou DÓLAR (USD).',
                400
            );
        }
    }
    /**
     * Função para checar se o TO é BRL, EUR ou USD
     *
     * @param string $to Moeda convertida
     *
     * @return string String da moeda convertida
     */
    public function checkTo($to)
    {
        if ($to != "BRL" && $to != "EUR" && $to != "USD") {
            $this->jsonEncode(
                'Não é possível fazer a conversão dessa moeda do paramêtro 
                TO, somente REAL (BRL), EURO (EUR) ou DÓLAR (USD).',
                400
            );
        } elseif ($to == "BRL") {
            $currency = 'R$';
        } elseif ($to == "EUR") {
            $currency = '€';
        } elseif ($to == "USD") {
            $currency = '$';
        }

        return $currency;
    }

    /**
     * Função que faz a conversão do valor
     *
     * @param float  $amount   Número que deseja converter
     * @param string $currency Simbolo da moeda convertida
     * @param float  $rate     Rate da moeda de conversão
     *
     * @return array Retorno da conversão em json
     */
    private function _convert(float $amount, string $currency, float $rate)
    {
        $convertedValue = $amount * $rate;
        
        if ((float) $convertedValue < 0) {
            $this->jsonEncode('O valor da conversão é negativo.', 400);
        }
        
        $jsonReturn = [
            "valorConvertido" => $convertedValue,
            "simboloMoeda" => $currency
        ];

        return $jsonReturn;
    }

    /**
     * Função para gerar o json de retorno da API
     *
     * @param array   $data       Retorno de sucesso ou erro
     * @param integer $statusCode Status code
     *
     * @return string Retorna o json
     */
    public function jsonEncode($data, $statusCode)
    {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    /**
     * Função principal que faz a mágica
     *
     * @return null Não retorna nada, somente envia para outra função
     */
    public function return()
    {
        //validate amount
        $this->checkAmount($this->_amount);
        //validate rate
        $this->checkRate($this->_rate);
        //validate from
        $this->checkFrom($this->_from);
        //validate to
        $currency = $this->checkTo($this->_to);

        //convert and json return
        $jsonReturn = $this->_convert($this->_amount, $currency, $this->_rate);

        //return echo and exit
        $this->jsonEncode($jsonReturn, 200);
    }

}

?>