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
require __DIR__ . "/CurrencyConverter.php";

/**
 * Class CurrencyConverterController
 *
 * Lida com as requisições de conversão.
 * Valida a entrada de dados e devolve resposta em JSON.
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Júlio Freitas <jcsr.frts@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class CurrencyConverterController
{
    /**
     * Converte valores de moedas com base nos parâmetros recebidos.
     *
     * @param float  $amount       Quantia a ser convertida.
     * @param string $fromCurrency A moeda de origem.
     * @param string $toCurrency   A moeda de destino.
     * @param float  $rate         A taxa de conversão.
     *
     * @return void
     */
    public static function convert(
        float $amount,
        string $fromCurrency,
        string $toCurrency,
        float $rate
    ): void {
        if (!is_numeric($amount) || !is_numeric($rate)) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => 'Amount and rate must be a number.']);
            return;
        }
        $converted = CurrencyConverter::convert(
            $amount,
            $fromCurrency,
            $toCurrency,
            $rate
        );
        header('Content-Type: application/json');
        if (isset($converted['error'])) {
            http_response_code(400);
        }
        echo json_encode($converted);
    }
}
