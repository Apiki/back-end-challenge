<?php

namespace App\controllers;

use App\models\CoinModel;
use App\services\CurrencyConverterService;
use App\utils\Response;
use Exception;

class ExchangeController
{
    /**
     * Executa a conversão de moedas conforme definido via parametrização na URL.
     * @param string $amount
     * @param string $from
     * @param string $to
     * @param string $rate
     * @return void
     */
    public function conversion(string $amount, string $from, string $to, string $rate): void
    {
        try {
            $coinFrom = new CoinModel($amount, $from);
            $coinTo = new CoinModel('', $to);

            $currecyConverter = new CurrencyConverterService();
            $currecyConverter->setFrom($coinFrom);
            $currecyConverter->setTo($coinTo);
            $currecyConverter->setRate($rate);

            $coinTo = $currecyConverter->converter();
            Response::render($coinTo);

        } catch (Exception $e) {
            Response::renderClientError();
        }
    }
}