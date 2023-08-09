<?php

/**
 * Back-end Challenge.
 *
 * PHP version 8.2.8
 *
 * @category Challenge
 * @package  Back-end
 * @author   Júlio Freitas <jcsr.frts@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

/**
 * Class CurrencyConverter
 *
 * Classe responsável por realizar a operação de conversão.
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Júlio Freitas <jcsr.frts@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class CurrencyConverter
{
    /**
     * Realiza a conversão de moeda com base nos parâmetros fornecidos.
     *
     * @param float  $amount Valor a ser convertido.
     * @param string $from   Moeda de origem.
     * @param string $to     Moeda de destino.
     * @param float  $rate   Taxa de conversão.
     * 
     * @return array  
     * Resultado da conversão, incluindo valor convertido e símbolo da moeda.
     */
    public static function convert(
        float $amount,
        string $from,
        string $to,
        float $rate
    ): array {
        if (!self::_validateConvertion($from, $to)) {
            return [
                "error" => 
                "Conversion from " . $from . " to " . $to . " is not allowed."
            ];
        }
        $symbol = self::_getCurrencySymbol($to);
        if (isset($symbol["error"])) {
            return $symbol;
        }
        $convertedAmount = ($amount * $rate);
        $conversionResult = array_merge(
            ["valorConvertido" => $convertedAmount],
            $symbol
        );
        return $conversionResult;
    }

    /**
     * Obtém o símbolo da moeda com base na moeda fornecida.
     *
     * @param string $currency sigla da moeda para obtenção do símbolo.
     * 
     * @return array Array contendo o símbolo da moeda ou mensagem de erro.
     */
    private static function _getCurrencySymbol($currency): array
    {
        switch ($currency) {
        case CurrencySymbol::BRL->name:
            return ["simboloMoeda" => CurrencySymbol::BRL->value];
        case CurrencySymbol::EUR->name:
            return ["simboloMoeda" => CurrencySymbol::EUR->value];
        case CurrencySymbol::USD->name:
            return ["simboloMoeda" => CurrencySymbol::USD->value];
        default:
            return ["error" => "Currency not recognized: " . $currency];
        }
    }

    /**
     * Valida se a conversão entre as moedas especificadas é permitida.
     *
     * @param string $fromCurrency Moeda de origem.
     * @param string $toCurrency   Moeda de destino.
     * 
     * @return bool 
     * Retorna true se a conversão é permitida, caso contrário, false.
     */
    private static function _validateConvertion($fromCurrency, $toCurrency): bool
    {
        $validConversions = [
            ['from' => CurrencySymbol::BRL->name, 'to' => CurrencySymbol::USD->name],
            ['from' => CurrencySymbol::USD->name, 'to' => CurrencySymbol::BRL->name],
            ['from' => CurrencySymbol::BRL->name, 'to' => CurrencySymbol::EUR->name],
            ['from' => CurrencySymbol::EUR->name, 'to' => CurrencySymbol::BRL->name]
        ];
        foreach ($validConversions as $conversion) {
            if ($fromCurrency === $conversion['from']
                && $toCurrency === $conversion['to']
            ) {
                return true;
            }
        }
        return false;
    }
}

/**
 * Enumeração que define os símbolos das moedas disponíveis.
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Júlio Freitas <jcsr.frts@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
enum CurrencySymbol: string
{
    /**
     * Símbolo da moeda brasileira (Real).
     */
    case BRL = 'R$';
    /**
     * Símbolo da moeda estadunidense (Dólar).
     */
    case USD = '$';
    /**
     * Símbolo da moeda da união europeia (Euro).
     */
    case EUR = '€';
}
