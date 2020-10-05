<?php

namespace App\core\components\currencyExchange\application\services;

use App\core\components\currencyExchange\application\exceptions\CurrencyExchangeRateIsNotValid;
use App\core\components\currencyExchange\domain\Currency;
use App\core\components\currencyExchange\domain\Money;

final class CurrencyExchangeService
{
    public function convertAmountToCurrency($amount, string $fromCurrency, string $toCurrency, $rate): Money
    {
        $currency = new Currency($fromCurrency);
        $money = new Money($amount, $currency);

        $this->checkIfCurrencyExchangeRateIsValid($rate);

        return $money->convertTo(new Currency($toCurrency), $rate);
    }

    private function checkIfCurrencyExchangeRateIsValid($rate)
    {
        if (!$this->validateRate($rate)) {
            throw new CurrencyExchangeRateIsNotValid();
        }
    }

    private function validateRate($rate): bool
    {
        return is_numeric($rate) && ((float) $rate) > 0;
    }
}
