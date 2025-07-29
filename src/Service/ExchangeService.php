<?php

/**
 * PHP version 8.1
 *
 * @category Service
 * @package  CurrencyExchange
 * @author   Gustavo de Almeida Oliveira <almdgusta@gmail.com>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     https://github.com/almdgustadev/back-end-challenge
 */

namespace Service;

require_once __DIR__ . '/../Util/CurrencySymbol.php';

use Util\CurrencySymbol;

/**
 * Serviço responsável pela lógica de conversão de moedas.
 * 
 * @category Service
 * @package  CurrencyExchange
 * @author   Gustavo de Almeida Oliveira <almdgusta@gmail.com>
 * @license  MIT <https://opensource.org/licenses/MIT>
 * @link     https://github.com/almdgustadev/back-end-challenge
 */

class ExchangeService
{
    /**
     * Converte o valor da moeda para outra utilizando a taxa de câmbio fornecida.
     *
     * @param float  $amount Valor a ser convertido.
     * @param string $from   Moeda de origem.
     * @param string $to     Moeda de destino.
     * @param float  $rate   Taxa de câmbio.
     * 
     * @return array Resultado da conversão com valor convertido e símbolo da moeda.
     */
    public function convertCurrency(
        float $amount,
        string $from,
        string $to,
        float $rate
    ): array {
        if ($rate <= 0) {
            throw new \InvalidArgumentException('A taxa de câmbio deve ser maior que zero.');
        }
        $converted = $amount * $rate;

        $symbol = CurrencySymbol::getSymbol($to);

        return [
            'valorConvertido' => $converted,
            'simboloMoeda'    => $symbol,
            ];
    }
}
