<?php

namespace App\core\components\currencyExchange\domain;

use App\core\components\currencyExchange\application\exceptions\MoneyAmountIsNotValid;

final class Money
{

    /**
     * currency
     *
     * @var Currency
     */
    private $currency;

    /**
     * amount
     *
     * @var float
     */
    private $amount;

    public function __construct($amount, Currency $currency)
    {
        $this->validateAmount($amount);

        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function convertTo(Currency $currency, $rate = 1): self
    {
        return new self(round($this->amount * $rate, 2), $currency);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    private function validateAmount($amount)
    {
        if (!is_numeric($amount) or ((float) $amount) < 0) {
            throw new MoneyAmountIsNotValid();
        }
    }
}
