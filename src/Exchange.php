<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo model Exchange para efetuar as operações de Intercâmbio.
 *
 * @category Exchange
 * @package  Back-end
 * @author   Nick Granados <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */

namespace App;

/**
 * Classe responsável pelo cálculo e validações de conversão de moeda.
 *
 * @category Exchange
 * @package  Back-end
 * @author   Nick Granados <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */
class Exchange
{
    /**
     * Moeda Original
     *
     * @var string
     */
    private string $_from;
    /**
     * Valor a trocar
     *
     * @var float
     */
    private float $_amount;

    /**
     * Moedas aceitas
     *
     * @var array|array[]
     */
    private array $_currencies = [
        'USD' => '$',
        'BRL' => 'R$',
        'EUR' => '€',
    ];

    /**
     * Função que recibe os parâmetros principais da class Exchange
     *
     * @param float  $amount Valor a trocar.
     * @param string $from   Moeda original.
     */
    public function __construct(float $amount, string $from)
    {
        $this->_amount = $amount;
        $this->_from = $from;
    }


    /**
     * Função para validar a moeda
     *
     * @param string $currency Moeda para validar
     *
     * @return bool
     */
    public function isValidCurrency(string $currency): bool
    {
        return array_key_exists($currency, $this->_currencies);
    }


    /**
     * Função com a lógica para converter a moeda
     *
     * @param float $rate Taxa de câmbio para operação
     *
     * @return float|int
     */
    public function convert(float $rate)
    {
        return $this->_amount * $rate;
    }

    /**
     * Função para obter o símbolo da moeda nova
     *
     * @param string $currency Moeda
     *
     * @return mixed
     */
    public function getCurrencySymbol(string $currency)
    {
        return $this->_currencies[$currency];
    }


}