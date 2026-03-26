<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este arquivo lida com a requisição
 * e retorna o resultado da conversão de moedas.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Kayo Almondes Tusthler <kayotusthler@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Exchange;

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Esta classe lida com a requisição
 * e retorna o resultado da conversão de moedas.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Kayo Almondes Tusthler <kayotusthler@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeHandler
{
    private const PARAM_AMOUNT = 1;
    private const PARAM_FROM   = 2;
    private const PARAM_TO     = 3;
    private const PARAM_RATE   = 4;

    /**
     * Lida com a requisição
     * e retorna o resultado da conversão de moedas.
     *
     * @param string $requestUri URL da requisição
     *
     * @return void
     */
    public function handle(string $requestUri): void
    {
        $parts = $this->_parsePath($requestUri);

        if (count($parts) !== 5) :
            $this->_respondError(
                400,
                ExchangeConfig::ERROR_MESSAGES['INVALID_ROUTE']
            );
        endif;

        if ($parts[0] !== ExchangeConfig::ROUTE) :
            $this->_respondError(
                404,
                ExchangeConfig::ERROR_MESSAGES['INVALID_ROUTE']
            );
        endif;

        if (!is_numeric($parts[self::PARAM_AMOUNT])
            || (float) $parts[self::PARAM_AMOUNT] <= 0
        ) :
            $this->_respondError(
                400,
                ExchangeConfig::ERROR_MESSAGES['INVALID_AMOUNT']
            );
        endif;

        if (!is_numeric($parts[self::PARAM_RATE])
            || (float) $parts[self::PARAM_RATE] <= 0
        ) :
            $this->_respondError(
                400,
                ExchangeConfig::ERROR_MESSAGES['INVALID_RATE']
            );
        endif;

        $from = trim($parts[self::PARAM_FROM]);
        $to   = trim($parts[self::PARAM_TO]);

        if (!in_array($from, ExchangeConfig::PERMITTED_CURRENCIES, true)
            || !in_array($to, ExchangeConfig::PERMITTED_CURRENCIES, true)
        ) :
            $this->_respondError(
                400,
                ExchangeConfig::ERROR_MESSAGES['INVALID_CURRENCY']
            );
        endif;

        $amount = (float) trim($parts[self::PARAM_AMOUNT]);
        $rate   = (float) trim($parts[self::PARAM_RATE]);
        $result = $amount * $rate;

        $this->_respondSuccess(
            [
            'valorConvertido' => round($result, 2),
            'simboloMoeda' => ExchangeConfig::SIGN_SYMBOL[$to],
            ]
        );
    }

    /**
     * Analisa a URL da requisição
     * e retorna os parâmetros.
     *
     * @param string $requestUri URL da requisição
     *
     * @return array
     */
    private function _parsePath(string $requestUri): array
    {
        $path = parse_url($requestUri, PHP_URL_PATH);

        if (!is_string($path)) :
            return [];
        endif;

        return explode('/', trim($path, '/'));
    }

    /**
     * Função que envia a resposta de erro.
     *
     * @param int    $statusCode Código de status da resposta
     * @param string $message    Mensagem de erro
     *
     * @return void
     */
    private function _respondError(int $statusCode, string $message): void
    {
        http_response_code($statusCode);
        echo json_encode(['erro' => $message]);
        exit;
    }

    /**
     * Função que envia a resposta de sucesso.
     *
     * @param array $payload Payload da resposta
     *
     * @return void
     */
    private function _respondSuccess(array $payload): void
    {
        echo json_encode($payload);
    }
}
