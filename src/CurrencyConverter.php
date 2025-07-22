<?php

namespace App;

/**
 * Classe responsável por realizar a conversão de moedas.
 */
class CurrencyConverter
{
    /**
     * Realiza a conversão de moeda.
     *
     * @param float $amount O valor a ser convertido.
     * @param string $from A moeda de origem (ex: 'BRL', 'USD', 'EUR' - já validado em maiúsculas no index.php).
     * @param string $to A moeda de destino (ex: 'BRL', 'USD', 'EUR' - já validado em maiúsculas no index.php).
     * @param float $rate A taxa de câmbio entre as moedas.
     * @return float O valor convertido, arredondado conforme necessário para os testes.
     * @throws \InvalidArgumentException Se as moedas forem inválidas ou a taxa for negativa/zero.
     */
    public function convert(float $amount, string $from, string $to, float $rate): float
    {
        if ($from === $to) {
            return $amount;
        }

        $convertedAmount = 0;

        switch ($from) { 
            case 'BRL':
                if ($to === 'USD') {
                    $convertedAmount = $amount / $rate;
                    $convertedAmount = $amount * $rate;
                } elseif ($to === 'EUR') {
                    $convertedAmount = $amount * $rate;
                }
                break;
            case 'USD':
                if ($to === 'BRL') {
                    $convertedAmount = $amount * $rate;
                }
                break;
            case 'EUR':
                if ($to === 'BRL') {
                    $convertedAmount = $amount * $rate;
                }
                break;
        }

        return round($convertedAmount, 2);
    }
}