<?php

namespace App\Service\Exchange;

use App\Service\Exchange\Coin\AbstractCoin;
use App\Service\Exchange\Coin\CoinBuilder;

class ConverterService
{
    public function convert(AbstractCoin $coin, string $initial, string $rate): AbstractCoin
    {
        if(!is_numeric($rate)) {
            throw new \Exception("Invalid rate", 1);
        }

        $rate = (float) $rate;
        $coinBuilder = new CoinBuilder;
        $coin = $coinBuilder->build($initial, $coin->getAmount() * $rate);
        return $coin;
    }
}
