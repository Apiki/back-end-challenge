<?php

/**
 * Back-end Challenge.
 *
 * PHP version 8.1.2
 *
 * Este é o arquivo para respostas http em json.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Gustavo Dias <gustavodiasdsc@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App;

/**
 * Classe utilitária para gerenciar respostas HTTP em formato JSON.
 * 
 * Esta classe fornece métodos estáticos para padronizar as respostas
 * da API, incluindo códigos de status HTTP apropriados e formatação
 * consistente das mensagens de resposta.
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Gustavo Dias <gustavodiasdsc@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 * @since    1.0.0
 */
class Response
{
    /**
     * Envia uma resposta JSON com código de status HTTP.
     * 
     * @param array $data   Os dados a serem retornados em formato JSON
     * @param int   $status O código de status HTTP (padrão: 200)
     * 
     * @return void
     */
    public static function json(array $data, int $status = 200)
    {
        http_response_code($status);

        header("Content-type: application/json");

        echo json_encode($data);
    }

    /**
     * Retorna uma resposta JSON para rota não encontrada.
     * 
     * @return void
     */
    public static function routeNotFound()
    {
        self::json(['message' => 'Rota não encontrada!'], 400);
    }

    /**
     * Retorna uma resposta JSON quando uma moeda não é suportada.
     * 
     * @param string $from                A moeda de origem
     * @param array  $supportedCurrencies Array com as moedas suportadas
     * 
     * @return void
     */
    public static function exchangeNotSupported($from, $supportedCurrencies)
    {
        $formattedCurrencies = implode(', ', $supportedCurrencies);
        self::json(
            [
                'message' => "Moedas suportadas para $from : $formattedCurrencies"
            ],
            400
        );
    }

    /**
     * Retorna uma resposta JSON de sucesso para conversão de moeda.
     * 
     * @param float  $convertedAmount O valor convertido
     * @param string $symbol          O símbolo da moeda de destino
     * 
     * @return void
     */
    public static function exchangeOk($convertedAmount, $symbol)
    {
        self::json(
            [
                'valorConvertido' => $convertedAmount,
                'simboloMoeda' => $symbol
            ],
            200
        );
    }
}
