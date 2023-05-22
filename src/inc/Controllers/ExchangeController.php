<?php
/**
 * @file
 * Classe ExchangeController
 *
 * @category Controllers
 * @package  Back-end challenge
 * @author   Matheus Gimenez <math42gimenez@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 * PHP version 8.1.18
 * 
 * @description Basicamente recebe os dados, chama uma classe Service para fazer a conversão e retorna o resultado
 */
require ROOT_DIR . '/inc/Services/ExchangeService.php';

/**
 * Class ExchangeController
 * @category Controllers
 * @package  Back-end challenge
 * @author   Matheus Gimenez <math42gimenez@gmail.com>
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeController

{
    /**
     * Manipula a requisição de conversão de moeda
     *
     * @param array $params Os parâmetros da requisição
     *
     * @return void
     */
    public static function handleRequest(array $params): void
    {
        try {
            $params = self::sanitizeParams($params);
            $fromCurrency = $params['from'];
            $toCurrency = $params['to'];
            $amount = $params['amount'];
            $rate = $params['rate'];

            $exchangeService = new ExchangeService();
            $convertedAmount = $exchangeService->convertCurrency($fromCurrency, $toCurrency, $amount, $rate);

            if ($convertedAmount) {
                $data = [
                    'simboloMoeda' => $exchangeService->getCurrencySymbol($toCurrency),
                    'valorConvertido' => $convertedAmount
                ];
                jsonResponse($data, 200);
            } else {
                jsonResponse([], 400);
            }
        } catch (Exception $e) {
            jsonResponse([], 400);
        }
    }

    /**
     * @param array $params
     * 
     * Limpa os dados recebidos
     *
     * @return array
     */
    public static function sanitizeParams(array $params): array
    {
        $sanitizedParams = [];
        $exchangeService = new ExchangeService();

        // valida e limpa from
        if (empty($exchangeService->getCurrencySymbol($params['from']))) {
            throw new Exception('{from} inválido');
        }
        if (isset($params['from'])) {
            $sanitizedParams['from'] = (float) filter_var($params['from'], FILTER_SANITIZE_STRING);
        }

        // valida e limpa to
        if (empty($exchangeService->getCurrencySymbol($params['to']))) {
            throw new Exception('{to} inválido');
        }
        if (isset($params['to'])) {
            $sanitizedParams['to'] = filter_var($params['to'], FILTER_SANITIZE_STRING);
        }

        // valida e limpa amount
        if (!is_numeric($params['amount'])) {
            throw new Exception('{amount} não numérico');
        }
        if (isset($params['amount'])) {
            $sanitizedParams['amount'] = filter_var($params['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        }
        if (empty($sanitizedParams['amount']) || $sanitizedParams['amount'] < 0) {
            throw new Exception('{amount} vazio');
        }

        // valida e limpa rate
        if (!is_numeric($params['rate'])) {
            throw new Exception('{rate} não numérico');
        }
        if (isset($params['rate'])) {
            $sanitizedParams['rate'] = filter_var($params['rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        }
        if (empty($sanitizedParams['rate']) || $sanitizedParams['rate'] < 0) {
            throw new Exception('{rate} vazio');
        }

        return $sanitizedParams;
    }
}