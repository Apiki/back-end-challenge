<?php

namespace App;

use App\Coin;

class EUR implements Coin
{
 
    use CoinTrait;

    const SYMBOL = '€';
    const CODE = 'EUR';

    public function getSymbol()
    {
        return self::SYMBOL;
    }

}

