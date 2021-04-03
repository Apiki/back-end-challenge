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
 * Conversor básico de algumas moedas.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Rodrigo Nascimento <me@rcnascimento.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class Exchanger
{
    /**
     * Parâmetros requeridos para realização de uma conversão.
     *
     * @var array
     */
    protected $requiredParams = [
        'amount',
        'from',
        'to',
        'rate',
    ];

    /**
     * Campos a serem exibidos na resposta.
     *
     * @var array
     */
    protected $responseKeys = [
        'valorConvertido',
        'simboloMoeda',
    ];

    /**
     * Siglas das moedas conhecidas com seus respectivos símbolos.
     *
     * @var array
     */
    protected $knownCurrencies = [
        'BRL' => 'R$',
        'EUR' => '€',
        'USD' => '$',
    ];

    /**
     * Parâmetros recebidos na requisição.
     *
     * @var array|false
     */
    protected $requestParams = [];

    /**
     * Setup da classe.
     */
    public function __construct()
    {
        $this->parseRequestParams();
    }

    /**
     * Faz parsing da URI de requisição e separa em parâmetros.
     *
     * @return void
     */
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

    /**
     * Monta uma resposta JSON a partir dos valores recebidos.
     *
     * @param array ...$responseValues Valores para os respectivos campos de
     *                                 $this->responseKeys.
     *
     * @return void
     */
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
