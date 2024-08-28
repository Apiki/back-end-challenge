<?php

namespace App;

/**
 * Class CurrencyConverter
 *
 * Classe responsável por converter valores entre diferentes moedas.
 *
 * @package App
 */
class CurrencyConverter
{
    const CURRENCY_BRL = 'BRL';
    const CURRENCY_USD = 'USD';
    const CURRENCY_EUR = 'EUR';

    /**
     * Converte o valor de uma moeda para outra com base na taxa de conversão.
     *
     * @param float  $amount       Valor a ser convertido.
     * @param string $fromCurrency Moeda de origem.
     * @param string $toCurrency   Moeda de destino.
     * @param float  $rate         Taxa de conversão.
     *
     * @return float Valor convertido.
     * @throws \InvalidArgumentException
     */
    public function convert(float $amount, string $fromCurrency, string $toCurrency, float $rate): float
    {
        if ($amount <= 0 || $rate <= 0) {
            throw new \InvalidArgumentException("Invalid amount or rate.");
        }

        if (!in_array($fromCurrency, [self::CURRENCY_BRL, self::CURRENCY_USD, self::CURRENCY_EUR], true) ||
            !in_array($toCurrency, [self::CURRENCY_BRL, self::CURRENCY_USD, self::CURRENCY_EUR], true)) {
            throw new \InvalidArgumentException("Invalid currency.");
        }

        $convertedAmount = $amount * $rate;

        return round($convertedAmount, 2);
    }
}
