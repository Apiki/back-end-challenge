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
 * @author   Leonardo Mazza de Souza <desenvolvedormazza@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App;

/**
 * CurrencyConvertion.
 *
 * PHP version 7.4
 *
 * Classe responsável pela conversão.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Leonardo Mazza de Souza <desenvolvedormazza@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class CurrencyConvertion
{
    public $valorConvertido;
    public $simboloMoeda;

    /**
     * Convert.
     *
     * PHP version 7.4
     *
     * Função responsável pela conversão.
     *
     * @param $amount          double Recebe a quantia
     * @param $from            string De
     * @param $to              string Para
     * @param $rate            double Taxa de Conversão
     * @param $allowedCurrency array  Conversões Permitidas
     * @param $url             string Exchange Url
     *
     * @return int
     */
    public function convert($amount, $from, $to, $rate, $allowedCurrency, $url)
    {
        if ($amount < 0
            || $rate < 0
            || empty($amount)
            || empty($rate)
            || empty($from)
            || empty($to)
            || empty($url)
            || array_key_exists($from, $allowedCurrency) === false
            || array_key_exists($to, $allowedCurrency) === false
        ) {
            return http_response_code(400);
        }

        $this->valorConvertido = $amount * $rate;
        $this->simboloMoeda = $allowedCurrency[$to];
        return http_response_code(200);
    }
}
