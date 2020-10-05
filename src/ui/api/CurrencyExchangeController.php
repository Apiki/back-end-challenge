<?php

namespace App\ui\api;

use App\core\components\currencyExchange\application\services\CurrencyExchangeService;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class CurrencyExchangeController
{
    /**
     * currencyExchangeService
     *
     * @var CurrencyExchangeService
     */
    private $currencyExchangeService;

    public function __construct(CurrencyExchangeService $currencyExchangeService)
    {
        $this->currencyExchangeService = $currencyExchangeService;
    }

    public function calculateCurrencyValue(Request $request, Response $response, $args): Response
    {
        $httpMethod = $request->getMethod();

        if ($httpMethod !== 'GET') {
            return $this->returnJsonStatus($response, 'Method Not Allowed', 405);
        }

        try {
            $amount = array_key_exists('amount', $args) ? $args['amount'] : '';
            $fromCurrency = array_key_exists('from', $args) ? $args['from'] : '';
            $toCurrency = array_key_exists('to', $args) ? $args['to'] : '';
            $rate = array_key_exists('rate', $args) ? $args['rate'] : '';
            $money = $this->currencyExchangeService->convertAmountToCurrency($amount, $fromCurrency, $toCurrency, $rate);
        } catch (\Exception $ex) {
            return $this->returnJsonStatus($response, $ex->getMessage(), 400);
        }

        $responseBody = [
            'valorConvertido' => $money->getAmount(),
            'simboloMoeda' => $money->getCurrency()->getSymbol(),
        ];

        $response->getBody()->write(json_encode($responseBody));

        return $response->withHeader('Content-Type', 'application/json');
    }

    private function returnJsonStatus(Response $response, string $message = 'Bad Request', int $status = 400): Response
    {
        $responseBody = [
            'status' => $status,
            'message' => $message,
        ];

        $response->getBody()->write(json_encode($responseBody));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}
