<?php

namespace App;

use App\Coin;

class USD implements Coin
{

    const SYMBOL = '$';
    const CODE = 'USD';

    use CoinTrait;

    public function getSymbol()
    {
        return self::SYMBOL;
    }
}
