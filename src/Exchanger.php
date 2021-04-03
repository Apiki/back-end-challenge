<?php
/**
 * API REST para conversão de moedas.
 *
 * PHP version 7.2
 *
 * @category Challenge
 * @package  Back-end
 * @author   Rodrigo Nascimento <me@rcnascimento.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App;

/**
 * Conversos básico de algumas moedas.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Rodrigo Nascimento <me@rcnascimento.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Exchanger
{
    protected $requiredParams = [
        'amount',
        'from',
        'to',
        'rate',
    ];

    protected $responseKeys = [
        'valorConvertido',
        'simboloMoeda',
    ];

    protected $knownCurrencies = [
        'BRL' => 'R$',
        'EUR' => '€',
        'USD' => '$',
    ];

    protected $requestParams = [];

    public function __construct()
    {
        $this->parseRequestParams();
    }

    protected function parseRequestParams()
    {
        $rawRequestParams = preg_replace(
            '/^\/([a-z]+\/)?/', '', $_SERVER['REQUEST_URI'] ?? ''
        );
        $requestParams    = explode('/', $rawRequestParams);

        if (count($this->requiredParams) === count($requestParams)) {
            $this->requestParams = array_combine(
                $this->requiredParams, $requestParams
            );
        } else {
            $this->requestParams = false;
        }
    }

    protected function buildResponse(string ...$responseValues)
    {
        $response = [];

        if (count($this->responseKeys) === count($responseValues)) {
            $response = array_combine($this->responseKeys, $responseValues);
        } else {
            http_response_code(400);
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    /**
     * Entrypoint da aplicação.
     *
     * @return void
     */
    public function exchange()
    {
        if ($this->requestParams) {
            $amount       = (float) $this->requestParams['amount'];
            $rate         = (float) $this->requestParams['rate'];
            $fromCurrency = $this->requestParams['from'];
            $toCurrency   = $this->requestParams['to'];

            $finalAmount    = $amount * $rate;
            $validFrom      = $this->knownCurrencies[$fromCurrency];
            $currencySymbol = $this->knownCurrencies[$toCurrency];

            if ($finalAmount > 0 && $validFrom && $currencySymbol) {
                $this->buildResponse($finalAmount, $currencySymbol);
            }
        }

        $this->buildResponse();
    }
}
