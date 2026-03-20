<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App;

/**
 * Classe que faz conversão de moedas.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Conversor
{
    /**
     * Símbolos das moedas suportadas.
     *
     * @var array
     */
    private array $_simbolos = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€',
    ];

    /**
     * Pares de conversão suportados.
     *
     * @var array
     */
    private array $_conversoesSuportadas = [
        'BRL' => ['USD', 'EUR'],
        'USD' => ['BRL'],
        'EUR' => ['BRL'],
    ];

    /**
     * Realiza a conversão entre moedas.
     *
     * @param float  $valor valor a ser convertido
     * @param string $de    moeda de origem
     * @param string $para  moeda de destino
     * @param float  $taxa  taxa de conversão
     *
     * @return array
     */
    public function converter(
        float $valor,
        string $de,
        string $para,
        float $taxa
    ): array {
        $valorConvertido = round($valor * $taxa, 2);

        return [
            'valorConvertido' => $valorConvertido,
            'simboloMoeda'    => $this->_simbolos[$para],
        ];
    }

    /**
     * Verifica se a moeda é válida.
     *
     * @param string $moeda sigla da moeda
     *
     * @return bool
     */
    public function moedaValida(string $moeda): bool
    {
        return array_key_exists($moeda, $this->_simbolos);
    }

    /**
     * Verifica se o par de conversão é suportado.
     *
     * @param string $de   moeda de origem
     * @param string $para moeda de destino
     *
     * @return bool
     */
    public function conversaoSuportada(string $de, string $para): bool
    {
        return isset($this->_conversoesSuportadas[$de])
            && in_array($para, $this->_conversoesSuportadas[$de], true);
    }
}