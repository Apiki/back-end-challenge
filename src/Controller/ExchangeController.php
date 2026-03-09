<?php

/**
 * Arquivo da classe ExchangeController
 *
 * @category Controller
 * @package  App
 * @author   Seu Nome <seuemail@exemplo.com>
 * @license  MIT https://opensource.org
 * @link     http://localhost:8000
 */

namespace App\Controller;

use App\Service\ExchangeService;

/**
 * Classe ExchangeController
 *
 * @category Controller
 * @package  App
 * @author   Seu Nome <seuemail@exemplo.com>
 * @license  MIT https://opensource.org
 * @link     http://localhost:8000
 */
class ExchangeController
{
    /**
     * Servico de cambio
     *
     * @var object
     */
    private ExchangeService $service;
      /**
       * Construtor
       *
       * @param object $service Instancia do servico
       */
    public function __construct()
    {
        $this->service = new ExchangeService();
    }
      /**
       * Lida com a requisicao
       *
       * @param array $params Parametros da URL
       *
       * @return void
       */
    public function handle(array $params): array
    {
        if (count($params) < 5) {
            http_response_code(400);
            return ['erro' => 'Parâmetros inválidos'];
        }

        $amount = (float) $params[1];
        $from   = ($params[2]);
        $to     = ($params[3]);
        $rate   = (float) $params[4];

         $validCurrencies = ['USD','BRL','EUR'];

        if (
            !is_numeric($amount) || $amount <= 0 ||
            !is_numeric($rate) || $rate <= 0 ||
            !in_array($from, $validCurrencies) ||
            !in_array($to, $validCurrencies)
        ) {
            http_response_code(400);
            return ['erro' => 'Parâmetros inválidos'];
        }

        return $this->service->convert(
            (float)$amount,
            (float)$rate,
            $to
        );
    }
}
