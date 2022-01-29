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
     * @param float $rate
     * @return void
     */
    public function setRate(float $rate): void
    {
        $this->rate = $rate;
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
