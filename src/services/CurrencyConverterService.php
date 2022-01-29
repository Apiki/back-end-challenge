<?php

namespace App\services;

use App\models\CoinModel;

class CurrencyConverterService
{
    private CoinModel $coinFrom;
    private CoinModel $coinTo;
    private float $rate;

    /**
     * @param CoinModel $coinFrom
     * @return void
     */
    public function setFrom(CoinModel $coinFrom): void
    {
        $this->coinFrom = $coinFrom;
    }

    /**
     * @param CoinModel $coinTo
     * @return void
     */
    public function setTo(CoinModel $coinTo): void
    {
        $this->coinTo = $coinTo;
    }

    /**
     * @param string $rate
     * @return void
     */
    public function setRate(string $rate): void
    {
        $this->rate = floatval($rate);
    }

    /**
     * @return CoinModel
     */
    public function converter(): CoinModel
    {
        $amount = $this->coinFrom->getAmount();

        $newAmount = $amount * $this->rate;

        $this->coinTo->setAmount($newAmount);

        return $this->coinTo;
    }
}
