<?php

namespace App\Service\Exchange\Coin;

class CoinBuilder
{
    private $coins = [
        'BRL' => BRL::class,
        'USD' => USD::class,
        'EUR' => EUR::class
    ];

    public function build($initial, $amount): AbstractCoin
    {
        $coinName = $this->coins[$initial] ?? null;
        if(is_null($coinName)) {
            throw new \Exception("Coin not exist", 1);
        }

        $coin = new $coinName($amount);
        return $coin;
    }
}
