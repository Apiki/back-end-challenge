<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   João Paulin <ppaulin23@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/joaopaulin/back-end-challenge
 */
declare(strict_types=1);

namespace App\Classes;

/**
 * Classe CurrencyConverter.
 *
 * PHP version 7.4
 *
 * Gerencia a lógica de conversão de moedas e o mapeamento de símbolos.
 *
 * @category Challenge
 * @package  Back-end
 * @author   João Paulin <ppaulin23@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/joaopaulin/back-end-challenge
 */
class CurrencyConverter
{
    private const SYMBOLS = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€'
    ];

    /**
     * Converte um valor com base em uma taxa fornecida.
     * 
     * @param float $amount Valor a ser convertido.
     * @param float $rate   Taxa de conversão.
     *
     * @return float
     */
    public function convert(float $amount, float $rate): float
    {
        return $amount * $rate;
    }

    /**
     * Retorna o símbolo para um determinado código de moeda.
     * 
     * @param string $currencyCode Código da moeda (BRL, USD, EUR).
     *
     * @return string
     */
    public function getSymbol(string $currencyCode): string
    {
        return self::SYMBOLS[$currencyCode] ?? '';
    }

    /**
     * Valida se o código da moeda é suportado e está em letras maiúsculas.
     * 
     * @param string $currencyCode Código da moeda.
     *
     * @return bool
     */
    public function isValidCurrency(string $currencyCode): bool
    {
        return isset(self::SYMBOLS[$currencyCode]);
    }
}
