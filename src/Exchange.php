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
 * @author   Seu Nome <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */

namespace App;

/**
 * Classe responsável pelo cálculo e validações de conversão de moeda.
 *
 * @category Exchange
 * @package  Back-end
 * @author   Seu Nome <internickbr@gmail.com>
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
    public string $from;
    /**
     * Valor a trocar
     *
     * @var float
     */
    public float $qty;

    /**
     * Moedas aceitas
     *
     * @var array|array[]
     */
    public array $currencies = [
        'USD' => [
            'symbol' => '$',
            'conversionRelation' => [
                'BRL' => 'm',
                'EUR' => 'd',
            ]
        ],
        'BRL' => [
            'symbol' => 'R$',
            'conversionRelation' => [
                'USD' => 'd',
                'EUR' => 'd',
            ]
        ],
        'EUR' => [
            'symbol' => '€',
            'conversionRelation' => [
                'BRL' => 'm',
                'USD' => 'm',
            ]
        ],
    ];

    /**
     * Função que recibe os parâmetros principais da class Exchange
     *
     * @param float  $qty  Valor a trocar.
     * @param string $from Moeda original.
     */
    public function __construct(float $qty, string $from)
    {
        $this->qty = $qty;
        $this->from = $from;
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
        return array_key_exists($currency, $this->currencies);
    }


    /**
     * Função com a lógica para converter a moeda
     *
     * @param string $to   Nova moeda
     * @param float  $rate Taxa de câmbio para operação
     *
     * @return float|int|string
     */
    public function convert(string $to, float $rate)
    {
        $operation = $this->currencies[$this->from]['conversionRelation'][$to];
        if ($rate > 0 && $rate < 1) {
            return $this->qty * $rate;
        }
        $result = $operation === 'm' ? $this->qty * $rate : $this->qty / $rate;
        return number_format($result);
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
        return $this->currencies[$currency]['symbol'];
    }


}