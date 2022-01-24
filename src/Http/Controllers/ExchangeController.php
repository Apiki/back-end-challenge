<?php

namespace App\Http\Controllers;

use App\Repositories\CurrenciesRepository;
use App\Services\ExchangeService;

class ExchangeController extends Controller
{
    private $currenciesRepository;
    private $exchangeService;

    public function __construct()
    {
        $this->currenciesRepository = new CurrenciesRepository();
        $this->exchangeService = new ExchangeService();
    }

    /**
     * Convert an amount from a currency to another by a fixed rate.
     * @param string $amount
     * @param string $from
     * @param string $to
     * @param string $rate
     * @return array
     * @throws \Exception
     */
    public function convert(string $amount, string $from, string $to, string $rate)
    {
        $fromCurrency = $this->currenciesRepository->getByCode($from);
        if (is_null($fromCurrency))
            throw new \Exception("Could not find source currency");

        $toCurrency = $this->currenciesRepository->getByCode($to);
        if (is_null($toCurrency))
            throw new \Exception("Could not find destination currency");

        $value = $this->exchangeService->convert($fromCurrency, $toCurrency, $amount, $rate);
        return ['valorConvertido' => $value,  'simboloMoeda' => $toCurrency->getSymbol()];
    }
}
